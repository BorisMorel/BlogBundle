<?php

namespace IMAG\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
  /**
   * @Assert\NotBlank
   */
  protected $pseudo;

  /**
   * @Assert\NotBlank
   * @Assert\Email
   */
  protected $mail;

  /**
   * @Assert\Choice
   */
  protected $who;  
  
  /**
   * Getter
   */
  public function getPseudo()
  {
    return $this->pseudo;
  }

  public function getMail()
  {
    return $this->mail;
  }

  public function getWho()
  {
    return $this->who;
  }

  public function setPseudo($str)
  {
    $this->pseudo = $str;

    return $this;
  }

  public function setMail($str)
  {
    $this->mail = $str;

    return $this;
  }

  public function setWho($str)
  {
    $this->who = $str;

    return $this;
  }
  
}