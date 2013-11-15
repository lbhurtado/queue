<?php
namespace Applester\QueueBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Applester\QueueBundle\Entity\Window;

class LoadWindowData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $next = new Window();
        $next->setName('Next Available');
        $next->setDefault(true);

        $morning = new Window();
        $morning->setName('Morning');
        $morning->setDefault(false);

        $lunch = new Window();
        $lunch->setName('Lunch');
        $lunch->setDefault(false);

        $afternoon = new Window();
        $afternoon->setName('Afternoon');
        $afternoon->setDefault(false);

        $midafternoon = new Window();
        $midafternoon->setName('Mid-afternoon');
        $midafternoon->setDefault(false);

        $lateafternoon = new Window();
        $lateafternoon->setName('Late-afternoon');
        $lateafternoon->setDefault(false);

        $em->persist($next);
        $em->persist($morning);
        $em->persist($lunch);
        $em->persist($afternoon);
        $em->persist($midafternoon);
        $em->persist($lateafternoon);
        $em->flush();

        $this->addReference('window-next', $next);
        $this->addReference('window-morning', $morning);
        $this->addReference('window-lunch', $lunch);
        $this->addReference('window-afternoon', $afternoon);
        $this->addReference('window-midafternoon', $midafternoon);
        $this->addReference('window-lateafternoon', $lateafternoon);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
