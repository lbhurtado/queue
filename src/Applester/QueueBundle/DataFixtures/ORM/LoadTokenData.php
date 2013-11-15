<?php
namespace Applester\QueueBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Applester\QueueBundle\Entity\Token;

class LoadTokenData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $token1 = new Token();
        $token1->setCode('APPLE');
        $token1->setStart(new \Datetime());
        $token1->setEnd(new \Datetime('+8 hours'));
        

        $token2 = new Token();
        $token2->setCode('MANGO');
        $token2->setStart(new \Datetime());
        $token2->setEnd(new \Datetime('+8 hours'));

        $em->persist($token1);
        $em->persist($token2);
        $em->flush();

        $this->addReference('token-1', $token1);
        $this->addReference('token-2', $token2); 
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
