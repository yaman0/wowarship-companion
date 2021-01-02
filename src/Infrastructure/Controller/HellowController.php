<?php

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HellowController
 * @package App\Infrastructure\Controller
 * @Route("/", name="index")
 */
class HellowController extends AbstractController
{
    public function __invoke(): Response
    {
        return new Response('Hello world !');
    }
}