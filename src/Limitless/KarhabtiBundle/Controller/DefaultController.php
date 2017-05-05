<?php

namespace Limitless\KarhabtiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LimitlessKarhabtiBundle::layout.html.twig');
    }
    public function indexClientAction()
    {
        return $this->render('LimitlessKarhabtiBundle::layoutClient.html.twig');
    }
    public function testAction()
    {
        return $this->render('LimitlessKarhabtiBundle:Default:test.html.twig');
    }
}
