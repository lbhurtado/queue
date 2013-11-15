<?php
namespace Applester\QueueBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Applester\QueueBundle\Entity\Queue;

class LoadQueueData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $q1 = new Queue();
        $q1->setMobile('+639189362340');
        $q1->setHandle('Lester');
        $q1->setDate(new \Datetime());
        $q1->setSlot($em->merge($this->getReference('slot-gov')));
        $q1->setWindow($em->merge($this->getReference('window-morning')));
        $q1->setBusiness($em->merge($this->getReference('business-followup')));

        $em->persist($q1);

        $em->flush();

        $this->addReference('queue-1', $q1);
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
