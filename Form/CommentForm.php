<?php
namespace imag\BlogBundle\Form;

use Symfony\Component\Form\Form,
  Symfony\Component\Form\TextField,
  Symfony\Component\Form\TextareaField;

class AddCommentForm extends Form
{
  protected function configure()
  {
    $this->setDataClass('imag\\BlogBundle\\Entity\\BlogComment');
    $this->add(new TextareaField('body'));
    $this->add('pseudo');
  }

}