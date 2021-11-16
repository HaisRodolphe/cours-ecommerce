<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class AmountExtension extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('amount', [$this, 'amount'])
        ];
    }

    public function amount($value, string $symbol = '€', string $decsep = ',', string $thousandesp = ' ')

    {
        //dd($value);
        // 19229 = 192.29 €
        $finalValue = $value / 100;
        // 192.29
        $finalValue = number_format($finalValue, 2, $decsep, $thousandesp);
        // 192,29 €

        return $finalValue . ' ' . $symbol;
    }
}
