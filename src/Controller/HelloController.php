<?php

namespace App\Controller;

use App\Taxes\Detector;
use Twig\Environment;
use App\Taxes\Calculator;
use App\Taxes\Calculatorttc;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController
{

    /**
     * @Route("/hello/{prenom?World}", name="name")
     */

    public function Hello($prenom, LoggerInterface $logger, Calculator $calculator, Slugify $slugify, Environment $twig, Detector $detector, Calculatorttc $calculatorttc): Response
    {
        dump($detector->detect(101));
        dump($detector->detect(10));

        dump($twig);

        dump($slugify->slugify("Hello World"));

        $logger->error("Mon message de log !");

        $tva = $calculator->calcul(100);

        dump($tva);

        $prixttc = $calculatorttc->calcul(50);

        dump("Prixttc + (100 - tva) = $prixttc");

        return new Response("Hello $prenom");
    }
}
