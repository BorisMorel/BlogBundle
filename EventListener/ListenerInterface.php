<?php

namespace IMAG\BlogBundle\EventListener;

use \IMAG\BlogBundle\Notifier\NotifierInterface,
  \IMAG\BlogBundle\Event\CommentEvent;

interface ListenerInterface
{
  public function __construct(NotifierInterface $notifierContainer);

  public function onNewComment(CommentEvent $event);
}