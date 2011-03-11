<?php
namespace imag\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Symfony\Component\HttpFoundation\RedirectResponse,
  Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
 
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

      return $this->render('BlogBundle:Blog:newBlog.html.twig', array('form' => $form));
    }

    public function createAction()
    {
      
    }

    public function editAction()
    {

    }

    public function updateAction()
    {

    }


}
