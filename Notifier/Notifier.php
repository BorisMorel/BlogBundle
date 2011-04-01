<?php
namespace imag\BlogBundle\Notifier;

class Notifier
{
  private $mailer,
    $params = array(),
    $templating;

  public function __construct(\Swift_Mailer $mailer, array $params)
  {
    $this->mailer = $mailer;
    $this->params = $params;
  }

  public function newComment(\imag\BlogBundle\Form\CommentForm $form)
  {
    $message = \Swift_Message::newInstance()
      ->setSubject($this->params['subject'])
      ->setbody($this->templating->render($this->params['body_template'], array('form' => $form)))
      ->setFrom($this->params['from'])
      ->setTo($this->params['to'])
      ;
    
    $this->mailer->send($message);
  }

  public function setTemplating(\Symfony\Bundle\TwigBundle\TwigEngine $templating = null)
  {
    $this->templating = $templating;
  }

}