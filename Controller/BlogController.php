<?php
namespace imag\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Symfony\Component\HttpFoundation\RedirectResponse,
  Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
  imag\BlogBundle\Form\BlogForm,
  imag\BlogBundle\Form\CommentForm,
  imag\BlogBundle\Entity\Blog,
  imag\BlogBundle\Entity\BlogComment;
 
class BlogController extends Controller
{
    public function indexAction()
    {
      $blogs = $this->get('doctrine.orm.entity_manager')
        ->getRepository('BlogBundle:Blog')
        ->getBlogs();
      
      return $this->render('BlogBundle:Blog:index.html.twig', array('blogs' => $blogs));
    }

    public function showAction($blog_id)
    {
      if(!$blog_id)
        throw new NotFoundHttpException('$blog_id is mandatory');
      
      $em = $this->get('doctrine.orm.entity_manager');
      $blog = $em->getRepository('BlogBundle:Blog')
        ->getComments($blog_id);

      $blogComment = new BlogComment();
      $blogComment->setBlog($em->getReference('BlogBundle:Blog', $blog_id));

      $form = CommentForm::create($this->get('form.context'), 'commentForm');
      $form->bind($this->get('request'), $blogComment);

      if($form->isValid())
        {
          $em->persist($form->getData());
          $em->flush();
          return new RedirectResponse($this->get('router')->generate('blog_show', array('blog_id' => $blog_id)));
        }

      return $this->render('BlogBundle:Blog:show.html.twig', array('blog' => $blog, 'form' => $form));
    }

    public function createAction()
    {
      $em = $this->get('doctrine.orm.entity_manager');
      $form = BlogForm::create($this->get('form.context'), 'blogForm');
      $form->bind($this->get('request'), new Blog());
      
      if($form->isValid())
        {
          $em->persist($form->getData());
          $em->flush();
          return new RedirectResponse($this->get('router')->generate('blog_show', array('blog_id' => $form->getData()->getId())));
        }
      
      return $this->render('BlogBundle:Blog:new.html.twig', array('form' => $form));
    }

    public function updateAction($blog_id)
    {
      if(!$blog_id)
        throw new NotFoundHttpException('$blog_id is mandatory');

      $em = $this->get('doctrine.orm.entity_manager');
      $blog = $em->getReference('BlogBundle:Blog', $blog_id);

      $form = BlogForm::create($this->get('form.context'), 'blogForm');
      $form->bind($this->get('request'), $blog);
      
      if($form->isValid())
        {
          $em->persist($blog);
          $em->flush();
          return new RedirectResponse($this->get('router')->generate('blog_show', array('blog_id' => $blog_id)));
        }

      return $this->render('BlogBundle:Blog:new.html.twig', array('form' => $form, 'notNew' => true));
    }
    
}
