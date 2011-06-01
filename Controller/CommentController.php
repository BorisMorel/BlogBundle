<?php 

namespace IMAG\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Symfony\Component\Form\Exception\FormException;

class CommentController extends Controller
{

  public function deleteAction($blog_id, $comment_id)
  {
    if(!$this->get('form.csrf_provider')->isCsrfTokenValid(BlogController::getSalt(), $this->get('request')->get('_token')))
      throw new FormException('Csrf token invalid');

    $em = $this->get('doctrine.orm.entity_manager');
    $comment = $em->getReference('BlogBundle:BlogComment', $comment_id);
    
    $em->remove($comment);
    $em->flush();

    return $this->redirect($this->generateUrl('blog_show', array('blog_id' => $blog_id)));
  }

}