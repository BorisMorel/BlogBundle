<?php

namespace IMAG\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Symfony\Component\Form\Exception\FormException,
  Symfony\Component\HttpFoundation\RedirectResponse,
  Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
  IMAG\BlogBundle\Form\CommentForm,
  IMAG\BlogBundle\Form\BlogForm,
  IMAG\BlogBundle\Entity\BlogComment;

class BlogController extends Controller
{
  public function indexAction()
  {
    $blogs = $this->get('doctrine.orm.entity_manager')
      ->getRepository('BlogBundle:Blog')
      ->getBlogs();
    
    $token = $this->get('form.csrf_provider')->generateCsrfToken(__NAMESPACE__."\\".__CLASS__);
    
    return $this->render('BlogBundle:Blog:index.html.twig', array('blogs' => $blogs, 'token' => $token));
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
    
    $form = $this->get('form.factory')
      ->create(new CommentForm(), $blogComment);
    
    if($this->get('request')->getMethod() == "PUT")
      {
        $form->bindRequest($this->get('request'));
        
        if($form->isValid())
          {
            $em->persist($blogComment);
            $em->flush();
            $this->get('imag.blog.notifier')->newComment($form);
            //return $this->redirect($this->generateUrl('blog_show', array('blog_id' => $blog_id)));
          }
      }
    
    return $this->render('BlogBundle:Blog:show.html.twig', array('blog' => $blog, 'form' => $form->createView()));
  }

  public function createAction()
  {
    $em = $this->get('doctrine.orm.entity_manager');

    $form = $this->get('form.factory')
      ->create(new BlogForm);

    if($this->get('request')->getMethod() == "PUT")
      {
        $form->bindRequest($this->get('request'));
        
        if($form->isValid())
          {
            $em->persist($form->getData());
            $em->flush();
            return $this->redirect($this->generateUrl('blog_show', array('blog_id' => $form->getData()->getId())));
          }
      }
      
    return $this->render('BlogBundle:Blog:new.html.twig', array('form' => $form->createView(), 'new' => true));
  }

  public function updateAction($blog_id)
  {
    if(!$blog_id)
      throw new NotFoundHttpException('$blog_id is mandatory');

    $em = $this->get('doctrine.orm.entity_manager');
    $blog = $em->getReference('BlogBundle:Blog', $blog_id);

    $form = $this->get('form.factory')
      ->create(new BlogForm, $blog);

    if($this->get('request')->getMethod() == "POST")
      {
        $form->bindRequest($this->get('request'));
        if($form->isValid())
          {
            $em->persist($blog);
            $em->flush();
            return $this->redirect($this->generateUrl('blog_show', array('blog_id' => $blog_id)));
          }
      }

    return $this->render('BlogBundle:Blog:new.html.twig', array('form' => $form->createView(), 'new' => false));
  }

  public function deleteAction($blog_id)
  {
    if(!$this->get('form.csrf_provider')->isCsrfTokenValid(__NAMESPACE__."\\".__CLASS__, $this->get('request')->get('_token')))
      throw new FormException('Csrf token invalid');
      
    $em = $this->get('doctrine.orm.entity_manager');
    $blog = $em->getRepository('BlogBundle:Blog')
      ->getComments($blog_id);
   
    $em->remove($blog);
    $em->flush();

    return new RedirectResponse($this->get('router')->generate('blog'));
  }
}

