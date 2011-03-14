<?php
namespace imag\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
  imag\BlogBundle\Entity\Blog,
  imag\BlogBundle\Entity\BlogComment;

class BlogFixtures implements FixtureInterface
{
  public function load($manager)
  {
    for($i=0 ; $i <=5 ; $i++)
      {
        ${"b$i"} = new Blog();
        ${"b$i"}->setTitle("Blog $i");
        ${"b$i"}->setBody("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est ipsum, semper eget dictum ac, congue id dui. Aliquam ac quam et sem pellentesque tempus. Pellentesque magna nibh, rutrum fringilla bibendum sed, aliquet in ipsum. Vestibulum iaculis tempus vehicula. Nam placerat urna ac volutpat.");
        $manager->persist(${"b$i"});
      }
    
    for($i=0 ; $i<50 ; $i++)
      {
        $bc = new BlogComment();
        $bc->setBody("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac augue massa. Nunc lectus ante, varius at elementum sed, mattis eget dolor. Ut consectetur eleifend magna, quis cursus est rhoncus in. Pellentesque eget metus interdum erat volutpat commodo. Etiam ullamcorper tempus lectus, vel lobortis felis auctor ac. Suspendisse fringilla, massa sit amet adipiscing cursus, lectus augue viverra nulla, id blandit quam quam ac est. Suspendisse tempus, dolor et sagittis semper, leo mi blandit neque, ac cursus ante quam in arcu. Donec luctus eleifend enim, in dignissim mi pharetra nec. Vivamus volutpat nulla id lectus ultricies sodales. Maecenas elit justo, tempor eu suscipit quis, molestie a odio. Maecenas suscipit, diam sed tempor tempor, arcu tortor consequat erat, hendrerit egestas mauris metus eu felis. Sed placerat sem nec metus feugiat vel elementum sapien eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque varius mi eu sapien eleifend eu scelerisque odio accumsan. Donec quis nisl orci.");
        $bc->setPseudo("Pseudo$i");
        $bc->setBlog(${"b".rand(0,5)});
        $manager->persist($bc);          
      }
    
    $manager->flush();
   
  }
}
