<?php
namespace imag\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Symfony\Component\HttpFoundation\RedirectResponse,
  Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
  imag\BlogBundle\Form\BlogForm,
  imag\BlogBundle\Entity\Blog;
 
class BlogController extends Controller
{
    public function indexAction()
    {
      $em = $this->get('doctrine.orm.entity_manager');
      $qb = $em->createQueryBuilder()
        ->select('b, bc')
        ->from('BlogBundle:Blog', 'b')
        ->leftJoin('b.blogComments', 'bc');
        
      $res = $qb->getQuery()->getResult();
      
      return $this->render('BlogBundle:Blog:index.html.twig', array('res' => $res));
    }

    public function showAction($blog_id)
    {
      if(!$blog_id)
        throw new NotFoundHttpException('$blog_id is mandatory');
      
      $comments = $this->get('doctrine.orm.entity_manager')
        ->getRepository('BlogBundle:BlogComment')
        ->getComments($blog_id);
     
      return $this->render('BlogBundle:Blog:show.html.twig', array('comments' => $comments));
    }

    public function newAction()
    {
      $form = BlogForm::create($this->get('form.context'), 'blogForm');

      return $this->render('BlogBundle:Blog:new.html.twig', array('form' => $form));
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

    public function editAction($blog_id)
    {
      if(!$blog_id)
        throw new NotFoundHttpException('$blog_id is mandatory');

      $em = $this->get('doctrine.orm.entity_manager');

      $form = BlogForm::create($this->get('form.context'), 'blogForm');
      $form->setData($em->getReference('BlogBundle:Blog', $blog_id));
      
      return $this->render('BlogBundle:Blog:new.html.twig', array('form' => $form, 'notNew' => true));
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
        }

      return $this->render('BlogBundle:Blog:new.html.twig', array('form' => $form, 'notNew' => true));
    }
}
