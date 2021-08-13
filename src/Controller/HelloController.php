<?php

namespace App\Controller;

use Twig\Environment;
use App\Taxes\Calculator;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController
{

    /**
     * @Route("/hello/{prenom?World}", name="name")
     */

    public function Hello($prenom, LoggerInterface $logger, Calculator $calculator, Slugify $slugify, Environment $twig): Response
    {
        dump($twig);

        dump($slugify->slugify("Hello World"));

        $logger->error("Mon message de log !");

        $tva = $calculator->calcul(100);

        dump($tva);

        return new Response("Hello $prenom");
    }
}
