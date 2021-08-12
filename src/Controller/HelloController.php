<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController
{
    /**
     * @Route("/hello/{prenom?World}", name="name")
     */

    public function Hello($prenom): Response
    {

        return new Response("Hello $prenom");
    }
}
