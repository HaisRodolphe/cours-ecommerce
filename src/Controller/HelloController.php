<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{

    /**
     * @Route("/hello/{prenom?World}", name="name")
     */

    public function Hello($prenom = "world")
    {
        return $this->render('hello.html.twig', [
            'prenom' => $prenom
        ]);
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

    /**
     * @Route("/product/{$id}", name="example")
     */
    public function dimstock($id, ProductRepository $productRepository, Entity $entity, EntityManagerInterface $em)
    {
        $product = $productRepository->find($id);
        $entity = new Product;

        //Essai décrementation stock
        $product->$entity->setStock($entity->getStock() + 1);
        $this->getDoctrine()->getManager()->flush($product);

        // $product
        //     ->setStock();

        // $em->persist($product);
        // $em->flush();
        //persiter l'information
        return $this->render('example.html.twig', [
            'product' => $product
        ]);
    }
}
