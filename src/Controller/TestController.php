<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController
{
    public function index()
    {
        dd("Ca Fonctionne");
    }

    public function test(Request $request, $age)
    {

        //$age = $request->attributes->get('age', 0);
        // $age = 0;

        // if (!empty($_GET['age'])) {
        //     $age = $_GET['age'];
        // };

        return new Response("Vous avez $age ans !");
    }
}
