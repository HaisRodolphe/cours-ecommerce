<?php

namespace App\Taxes;

use Psr\Log\LoggerInterface;


class Calculatorttc
{

    protected $tva;

    public function __construct(LoggerInterface $logger, float $tva)
    {
        $this->tva = $tva;
    }

    public function calcul(float $prixttc): float
    {

        return  $prixttc + (100 - ($this->tva));
    }
}
