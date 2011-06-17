<?php

namespace IMAG\BlogBundle\Event;

use Symfony\Component\EventDispatcher\Event;


class CommentEvent extends Event
{
  private
    $comment;

  public function __construct(\IMAG\BlogBundle\Entity\BlogComment $comment)
  {
    $this->comment = $comment;
  }

  public function getComment()
  {
    return $this->comment;
  }

  public function setComment(\IMAG\BlogBundle\Entity\BlogComment $comment)
  {
    $this->comment = $comment;

    return $this;
  }
}