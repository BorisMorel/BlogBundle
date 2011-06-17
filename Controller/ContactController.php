<?php

namespace IMAG\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
  IMAG\BlogBundle\Form\ContactType,
  IMAG\BlogBundle\Entity\Contact;
  

class ContactController extends Controller
{
  public function contactAction()
  {
    $form = $this->get('form.factory')
      ->create(new ContactType(), null, array(
        'who' => array(
          'choices' => array(
            'fr' => 'fr',
            'en' => 'en',
            'de' => 'de',
          ))));

    return $this->render('BlogBundle:Contact:contact.html.twig', array('form' => $form->createView()));
    
  }
}

