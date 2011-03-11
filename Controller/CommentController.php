<?php
namespace imag\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Symfony\Component\HttpFoundation\RedirectResponse,
  Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
  imag\BlogBundle\Form\CommentForm,
  imag\BlogBundle\Entity\BlogComment;

class CommentController extends Controller
{
  
  public function commentNewAction()
  {
    $form = CommentForm::create($this->get('form.context'), 'addComment');

    return $this->render('BlogBundle:Comment:new.html.twig', array('form' => $form));
  }

  public function commentCreateAction($blog_id)
  {
    if(!$blog_id)
      throw new NotFoundHttpException('$blog_id is mandatory');
      
    $em = $this->get('doctrine.orm.entity_manager');

    $request = new BlogComment();
    $request->setBlog($em->getReference('BlogBundle:Blog', $blog_id));

    $form = CommentForm::create($this->get('form.context'), 'addComment');
    $form->bind($this->get('request'), $request);
     
    if($form->isValid())
      {
        $em->persist($request);
        $em->flush();
        return new RedirectResponse($this->get('router')->generate('blog_show', array('blog_id' => $blog_id)));
      }
 
    return $this->render('BlogBundle:Comment:new.html.twig', array('form' => $form));
  }

  public function commentEditAction($comment_id)
  {
    if(!$comment_id)
      throw new NotFoundHttpException('$comment_id is mandatory');

    $em = $this->get('doctrine.orm.entity_manager');

    $form = CommentForm::create($this->get('form.context'), 'editComment');
    $form->setData($em->getReference('BlogBundle:BlogComment', $comment_id));

    return $this->render('BlogBundle:Comment:new.html.twig', array('form' => $form, 'notNew' => true));
  }

  public function commentUpdateAction($blog_id, $comment_id)
  {
    if(!$blog_id || !$comment_id)
      throw new NotFoundHttpException('$blog_id and $comment_id are mandatories');

    $em = $this->get('doctrine.orm.entity_manager');
    $comment = $em->getReference('BlogBundle:BlogComment', $comment_id);
    $form = CommentForm::create($this->get('form.context'), 'editComment');

    $form->setData($comment);
    $form->bind($this->get('request'), $comment);

    if($form->isValid())
      {
        $em->persist($form->getData());
        $em->flush();
      }
      
    return $this->render('BlogBundle:Comment:new.html.twig', array('form' => $form, 'notNew' => true));
  }
}