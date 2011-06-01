<?php

namespace IMAG\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder
      ->add('pseudo')
      ->add('body', 'textarea');
  }

  public function getDefaultOptions(array $options)
  {
    return array(
                 'data_class' => 'IMAG\BlogBundle\Entity\BlogComment',
                 );
  }
}

