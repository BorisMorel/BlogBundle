<?php
namespace imag\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Symfony\Component\HttpFoundation\RedirectResponse,
  Symfony\Component\DependencyInjection\Exception\InvalidArgumentException,
  imag\BlogBundle\Form\AddCommentForm,
  imag\BlogBundle\Entity\BlogComment;

class DefaultController extends Controller
{
    public function indexAction()
    {
      $em = $this->get('doctrine.orm.entity_manager');
      $qb = $em->createQueryBuilder()
        ->select('b, bc')
        ->from('BlogBundle:Blog', 'b')
        ->leftJoin('b.blogComments', 'bc');
        
      $res = $qb->getQuery()->getResult();
      
      return $this->render('BlogBundle:Default:index.html.twig', array('res' => $res));
    }

    public function showAction($blog_id)
    {
      if(!$blog_id)
        throw new InvalidArgumentException('$blog_id is mandatory');
      
      $comments = $this->get('doctrine.orm.entity_manager')
        ->getRepository('BlogBundle:BlogComment')
        ->getComments($blog_id);
     
      return $this->render('BlogBundle:Default:show.html.twig', array('comments' => $comments));
    }

    public function commentNewAction()
    {
      $form = AddCommentForm::create($this->get('form.context'), 'addComment');

      return $this->render('BlogBundle:Default:addComment.html.twig', array('form' => $form));
    }

    public function commentCreateAction($blog_id)
    {
      if(!$blog_id)
        throw new InvalidArgumentException('$blog_id is mandatory');
      
      $em = $this->get('doctrine.orm.entity_manager');

      $request = new BlogComment();
      $request->setBlog($em->getReference('BlogBundle:Blog', $blog_id));

      $form = AddCommentForm::create($this->get('form.context'), 'addComment');
      $form->bind($this->get('request'), $request);
     
      if($form->isValid())
        {
          $em->persist($request);
          $em->flush();
          return new RedirectResponse($this->get('router')->generate('blog'));
        }
 
      return $this->render('BlogBundle:Default:addComment.html.twig', array('form' => $form));
    }

    public function commentEditAction($comment_id)
    {
      $em = $this->get('doctrine.orm.entity_manager');

      $form = AddCommentForm::create($this->get('form.context'), 'editComment');
      $form->setData($em->getReference('BlogBundle:BlogComment', $comment_id));

      return $this->render('BlogBundle:Default:addComment.html.twig', array('form' => $form, 'notNew' => true));
    }

    public function commentUpdateAction($blog_id, $comment_id)
    {
      $em = $this->get('doctrine.orm.entity_manager');
      $comment = $em->getReference('BlogBundle:BlogComment', $comment_id);
      $form = AddCommentForm::create($this->get('form.context'), 'editComment');

      $form->setData($comment);
      $form->bind($this->get('request'), $comment);

      if($form->isValid())
        {
          $em->persist($form->getData());
          $em->flush();
        }
      
      return $this->render('BlogBundle:Default:addComment.html.twig', array('form' => $form, 'notNew' => true));
    }
}
