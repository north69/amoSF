<?php
// src/Acme/DemoBundle/Controller/MainController.php

namespace Acme\DemoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function contactAction()
    {
        return new Response('<h1>Contact us!</h1>');
    }
}
