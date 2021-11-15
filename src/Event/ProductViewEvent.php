<?php

namespace App\Event;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;
// class ProductViewEvent qui vas heriter de la class Event
class ProductViewEvent extends Event
{
    //Ont n'as une donné protéger qui vas s'appaler $product
    protected $product;
    // On vas avoir un constructeur qui vas recevoir un $product
    public function __construct(Product $product)
    {
        // Puis se le faire injecter dans le constructeur
        $this->product = $product;
    }

    // on vas rendre cette function accessible donc on vas se mettre un getter
    // Qui retournerat un $product
    public function getProduct(): Product
    {
        // Qui vas retrouner un $this->product.
        return $this->product;
    }
}
