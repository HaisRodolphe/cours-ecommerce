<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FuncController extends AbstractController
{
    /**
     * @Route("/function", name="funcpage")
     */
    public function funcpage(ProductRepository $productRepository)
    {
        //count([])
        //find(id)
        //findBy([], [])
        //findOneBy([], [])
        //findall()
        //count permet de compter les produits.
        $count = $productRepository->count(['price' => 1500]);
        dump($count);
        //Permet de retrouver un produit.
        $product = $productRepository->find(2);
        dump($product);
        //Permet de retrouver tout les produits.
        $products = $productRepository->findall();
        dump($products);
        //Permet de retrouver plusieur produits avec certain critére.
        $products = $productRepository->findBy([
            'slug' => 'chaise-en-bois',
            'price' => 2000
        ]);
        dump($products);
        //Retrouver les noms dans l'ordre descendant.
        $products = $productRepository->findBy([], ['name' => 'DESC']);
        dump($products);
        //Permet de renvoyer un tableau de resulta, il vas trouver la premier entity à 1500.
        $products = $productRepository->findOneBy([
            'price' => 1500
        ]);
        dump($products);




        return $this->render('home.html.twig');
    }
}
