<?php

namespace IMAG\BlogBundle\EventListener;

use IMAG\BlogBundle\EventListener\ListenerInterface;

class BlogListener implements ListenerInterface
{
  private
    $notifier;

  public function __construct(\IMAG\BlogBundle\Notifier\Notifier $containerNotifier)
  {
    $this->notifier = $containerNotifier;
  }

  public function onNewComment(\IMAG\BlogBundle\Event\CommentEvent $event)
  {
    $this->notifier
      ->set('pseudo', $event->getComment()->getPseudo())
      ->set('body', $event->getComment()->getBody())
      ->send();
  }
}