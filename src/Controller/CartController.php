<?php

namespace App\Controller;

use App\Cart\CartService;
use App\Form\CartConfirmationType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CartService
     */
    protected $cartService;

    public function __construct(ProductRepository $productRepository, CartService $cartService)
    {
        $this->productRepository = $productRepository;
        $this->cartService = $cartService;
    }

    /**
     * //requirements={"id":"\d+"} permet d'imposé l'appel d'un nombre.
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, Request $request): Response
    {

        // 0. Securisation: est-ce que le produit existe ?
        $product = $this->productRepository->find($id);


        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas !");
        }

        $this->cartService->add($id);

        $this->addFlash('success', "Le produit a bien été ajouté au panier");

        // Supression de cart
        //$request->getSession()->remove('cart');

        //Si dans l'url il y a un point d'interogation returnToCart 
        if ($request->query->get('returnToCart')) {
            //alors ont sera rediriger sur cart_show
            return $this->redirectToRoute("cart_show");
        }

        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }

    /**
     * @Route("/cart", name="cart_show")
     */
    public function show()
    {

        $form = $this->createForm(CartConfirmationType::class);

        $detaileCart = $this->cartService->getDetailedCartItems();

        $total = $this->cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            'items' => $detaileCart,
            'total' => $total,
            'confirmationForm' => $form->createView()
        ]);
    }

    /**
     * //Supression du product
     *
     * @Route("/cart/delete/{id}", name="cart_delete", requirements={"id": "\d+"})
     */
    public function delete($id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être suprimé ! ");
        }

        $this->cartService->remove($id);

        $this->addFlash("success", "Le produit a bien été suprimé du panier");

        return $this->redirectToRoute("cart_show");
    }

    /**
     * //Decrementation du produit
     * 
     * @Route("/cart/decrement/{id}", name="cart_decrement", requirements={"id": "\d+"})
     */
    public function decrement($id)
    {

        $product = $this->productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être décrémenté ! ");
        }

        $this->cartService->decrement($id);

        $this->addFlash("success", "Le produit a bien été décrémenté");

        return $this->redirectToRoute("cart_show");
    }
}
