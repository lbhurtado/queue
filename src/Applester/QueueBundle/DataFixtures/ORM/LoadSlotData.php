<?php
namespace Applester\QueueBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Applester\QueueBundle\Entity\Slot;

class LoadSlotData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $gov = new Slot();
        $gov->setName('Gov. Jonvic Remulla');
        $gov->setDefault(true);

        $pa = new Slot();
        $pa->setName('Atty. John Doe');
        $pa->setDefault(false);

        $em->persist($gov);
        $em->persist($pa);
        $em->flush();

        $this->addReference('slot-gov', $gov);
        $this->addReference('slot-pa', $pa); 
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
