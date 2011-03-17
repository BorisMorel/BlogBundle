<?php
namespace imag\BlogBundle\Form;

use Symfony\Component\Form\Form,
  Symfony\Component\Form\TextField,
  Symfony\Component\Form\TextareaField;


class BlogForm extends Form
{
  protected function configure()
  {
    $this->setDataClass('imag\\BlogBundle\\Entity\\Blog');
    $this->add(new TextField('title'));
    $this->add('body');
  }

}