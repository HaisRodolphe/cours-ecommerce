<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController
{
    // protected $logger;

    // public function __construct(LoggerInterface $logger)
    // {
    //     $this->logger = $logger;
    // }
    /**
     * @Route("/hello/{prenom?World}", name="name")
     */

    public function Hello($prenom, LoggerInterface $logger): Response
    {
        $logger->error("Mon message de log !");
        //$this->logger->error("Mon message de log !");

        return new Response("Hello $prenom");
    }
}
