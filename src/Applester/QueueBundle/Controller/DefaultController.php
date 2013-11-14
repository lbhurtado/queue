<?php

namespace Applester\QueueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ApplesterQueueBundle:Default:index.html.twig', array('name' => $name));
    }
}
