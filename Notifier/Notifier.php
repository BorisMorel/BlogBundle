<?php
namespace IMAG\BlogBundle\Notifier;

use IMAG\BlogBundle\Notifier\NotifierInterface,
  \Symfony\Bundle\TwigBundle\TwigEngine,
  \Swift_Mailer;

class Notifier implements NotifierInterface
{
  private 
    $mailer,
    $params = array(),
    $templating,
    $template;

  public function __construct(Swift_Mailer $mailer, array $params, TwigEngine $templating)
  {
    $this->mailer = $mailer;
    $this->params = $params;
    $this->templating = $templating;
  }
  
  public function set($name, $data)
  {
    $this->params[$name] = $data;

    return $this;
  }
  
  public function send()
  {
    $this->checkMandatoryFields();
    $this->checkValidTemplate();

    $message = \Swift_Message::newInstance()
      ->setSubject($this->params['subject'])
      ->setbody($this->templating->render($this->template, array('data' => $this->params)))
      ->setFrom($this->params['from'])
      ->setTo($this->params['to'])
      ;

    if(!$mailer = $this->mailer->send($message))
      throw new \Exception('Send Error');

    return $mailer;
  }

  public function setTemplate($template)
  {
    $this->template = $template;

    return $this;
  }

  private function checkMandatoryFields()
  {
    foreach(array('subject', 'from', 'to') as $field)
      {
        if(!array_key_exists($field, $this->params))
          throw new \Exception('Mandatory fields are subject, from and to');
      }
  }
  
  private function checkValidTemplate()
  {
    if(!$this->templating->exists($this->template))
      throw new \Exception(sprintf('Template "%s" does not exist', $template));
  }
}