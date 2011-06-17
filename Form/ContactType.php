<?php

namespace IMAG\BlogBundle\Form;

use Symfony\Component\Form\AbstractType,
  Symfony\Component\Form\FormBuilder;
  
class ContactType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder
      ->add('pseudo')
      ->add('mail')
      ->add('who', 'choice', $options['who']);
    
  }

  public function getDefaultOptions(array $options)
  {
    return array(
                 'data_class' => 'IMAG\BlogBundle\Entity\Contact',
                 'who'        => array()
                 );
  }
}