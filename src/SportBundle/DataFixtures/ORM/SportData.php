<?php
namespace SportBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SportBundle\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SportData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sport = new Sport();
        $sport->setLabel("Golf");
        $manager->persist($sport);

        $sport1 = new Sport();
        $sport1->setLabel("Foot");
        $manager->persist($sport1);

        $sport2 = new Sport();
        $sport2->setLabel("Tennis");
        $manager->persist($sport2);

        $sport3 = new Sport();
        $sport3->setLabel("Basket");
        $manager->persist($sport3);
        
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}