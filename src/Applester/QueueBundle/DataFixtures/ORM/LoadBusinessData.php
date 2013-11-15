<?php
namespace Applester\QueueBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Applester\QueueBundle\Entity\Business;

class LoadBusinessData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $consult = new Business();
        $consult->setName('Consult');
        $consult->setDefault(true);

        $followup = new Business();
        $followup->setName('Follow-up');
        $followup->setDefault(false);

        $em->persist($consult);
        $em->persist($followup);
        $em->flush();

        $this->addReference('business-consult', $consult);
        $this->addReference('business-followup', $followup);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
