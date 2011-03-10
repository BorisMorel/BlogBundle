<?php
namespace imag\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
  imag\BlogBundle\Entity\Blog,
  imag\BlogBundle\Entity\BlogComment;

class BlogFixtures implements FixtureInterface
{
  public function load($manager)
  {
    $b1 = new Blog();
    $b1->setTitle('title1');
    for($i=0 ; $i <=5 ; $i++)
      {
        ${"b$i"} = new Blog();
        ${"b$i"}->setTitle("Blog $i");
        $manager->persist(${"b$i"});
      }
    
    for($i=0 ; $i<50 ; $i++)
      {
        $bc = new BlogComment();
        $bc->setBody("Body $i");
        $bc->setPseudo("Pseudo$i");
        $bc->setBlog(${"b".rand(0,5)});
        $manager->persist($bc);          
      }
    
    $manager->flush();
   
  }
}
