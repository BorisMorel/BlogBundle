<?php

namespace IMAG\BlogBundle\EventListener;

use IMAG\BlogBundle\EventListener\ListenerInterface,
  \IMAG\BlogBundle\Notifier\NotifierInterface,
  \IMAG\BlogBundle\Event\CommentEvent;

class BlogListener implements ListenerInterface
{
  private
    $notifier;

  public function __construct(NotifierInterface $containerNotifier)
  {
    $this->notifier = $containerNotifier;
  }

  public function onNewComment(CommentEvent $event)
  {
    $this->notifier
      ->set('pseudo', $event->getComment()->getPseudo())
      ->set('body', $event->getComment()->getBody())
      ->send();
  }
}