<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        dd("Ca Fonctionne");
    }

    /**
     * @Route("/test/{age<\d+>?0}", name="test", methods={"GET", "POST"}, schemes={"http", "https"})
     */

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
