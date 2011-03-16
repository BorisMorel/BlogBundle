<?php
namespace imag\BlogBundle\Form;

use Symfony\Component\Form\Form,
  Symfony\Component\Form\TextField,
  Symfony\Component\Form\TextareaField;

class CommentForm extends Form
{
  protected function configure()
  {
    $this->setDataClass('imag\\BlogBundle\\Entity\\BlogComment');
    $this->add('pseudo');
    $this->add(new TextareaField('body'));
  }

}