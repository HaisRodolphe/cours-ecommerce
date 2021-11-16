<?php

namespace App\Cart;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }
    //GetCart nous revois un tableau
    protected function getCart(): array
    {
        //queque ma session me retourne en get un tableau vide.
        return $this->session->get('cart', []);
    }
    //Setcart qui recevera un tableau $cart
    protected function saveCart(array $cart)
    {
        //Qui retourne dans la session un tableau $cart
        $this->session->set('cart', $cart);
    }

    public function empty()
    {
        $this->saveCart([]);
    }

    public function add(int $id)
    {
        // 1. Retrouver le panier dans la session (sous forme de tableau) 
        // 2. Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $this->getCart();

        // 3. Voir si le produit ($id) existe déjà dans le tableau [12 => 3, 29 => 2]
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité 1
        //attention si sa n'existe pas il reste a zero
        if (!array_key_exists($id, $cart)) {
            $cart[$id] = 0; //si le produit est déjà en panier il ajouterat +

        }
        //Si il exite il passera au nombre superieur.
        $cart[$id]++; // Si le produit n'est pas dans le panier il metrat 1


        // 6. Enregistrer le tableau mis à jour dans la session
        $this->saveCart($cart);
    }

    public function remove(int $id)
    {
        $cart = $this->getCart();

        unset($cart[$id]);

        $this->saveCart($cart);
    }

    public function decrement(int $id)
    {

        $cart = $this->getCart();

        if (!array_key_exists($id, $cart)) {
            return;
        }

        //soit le produit est à 1 ,alors il faut simplement le suprimer
        if ($cart[$id] === 1) {
            $this->remove($id);
            return;
        }

        //soit le produit est à plus de 1, alors il faut décrémenter
        $cart[$id]--;

        $this->saveCart($cart);
    }

    public function getTotal(): int
    {
        $total = 0;

        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);

            //Si un produit à était suprimé, il continurat la boucle.
            if (!$product) {
                continue;
            }

            $total += $product->getPrice() * $qty;
        }

        return $total;
    }

    /**
     *
     * @return CartItem[]
     */
    public function getDetailedCartItems(): array
    {
        $detaileCart = [];


        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);

            //Si un produit à était suprimé, il continurat la boucle.
            if (!$product) {
                continue;
            }

            $detaileCart[] = new CartItem($product, $qty);
        }

        return $detaileCart;
    }
}
