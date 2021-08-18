<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HelloController
{
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    /**
     * @Route("/hello/{prenom?World}", name="name")
     */

    public function Hello($prenom = "world"): Response
    {
        $html = $this->twig->render('hello.html.twig', [
            'prenom' => $prenom,
            'age' => 5,
            'prenoms' => [
                'Céline',
                'Rodolphe',
                'Typhaine',
                'Leonie'
            ],
            //Boucle for et if
            'ages' => [
                12,
                18,
                29,
                15
            ],

            // tableaux assiociatif ou des objets
            'formateur' => [
                'prenom' => 'Rodolphe',
                'nom' => 'Has',
                'age' => '42'
            ],
            'formateur1' => ['prenom' => 'Rodolphe', 'nom' => 'ha'],
            'formateur2' => ['prenom' => 'Celine', 'nom' => 'chacha'],
        ]);
        return new Response($html);
    }

    /**
     * @Route("/example", name="example")
     */
    public function example()
    {

        return $this->render('example.html.twig', [
            'age' => 33
        ]);
    }

    protected function render(string $path, array $variables = [])
    {
        $html = $this->twig->render($path, $variables);
        return new Response($html);
    }
}
