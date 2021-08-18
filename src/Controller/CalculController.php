<?php

namespace App\Controller;

use App\Taxes\Calculator;
use App\Taxes\Calculatorttc;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CalculController
{
    /**
     * @Route("/calcul", name="calcul")
     */
    public function calcul(Calculator $calculator, Calculatorttc $calculatorttc)
    {
        $tva = $calculator->calcul(100);

        dump($tva);


        $prixttc = $calculatorttc->calcul(50);

        return new Response("Prixttc + (100 - tva) = $prixttc");
    }
}
