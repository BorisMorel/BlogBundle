<?php

namespace IMAG\BlogBundle\Notifier;

use \Symfony\Bundle\TwigBundle\TwigEngine,
  \Swift_Mailer;

interface NotifierInterface
{
  function __construct(Swift_Mailer $mailer, array $params, TwigEngine $templating);

  function set($name, $data);

  function send();

  function setTemplate($tpl);
}