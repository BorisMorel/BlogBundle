<?php

namespace IMAG\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BlogType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder
      ->add('title', 'text')
      ->add('body');
  }

  public function getDefaultOptions(array $options)
  {
    return array(
                 'data_class' => 'IMAG\BlogBundle\Entity\Blog',
                 );
  }
}
