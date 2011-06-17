<?php

namespace IMAG\BlogBundle\EventListener;

interface ListenerInterface
{
  public function __construct(\IMAG\BlogBundle\Notifier\Notifier $notifierContainer);

  public function onNewComment(\IMAG\BlogBundle\Event\CommentEvent $event);
}