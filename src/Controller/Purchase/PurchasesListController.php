<?php

namespace App\Controller\Purchase;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasesListController extends AbstractController
{
    //Comme on érite de l'AbstractController nous avons plus besion du constructer.
    /**
     * @Route("/purchases", name="purchase_index")
     * //Pour remplacer le if(!user) vue dans le chapitre La session dans Symfony 5 (1 heure et 30 minutes)
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour accéder à vos commandes")
     */
    public function index()
    {
        //1.Nous devons nous assurer que la personne est connectée (sinon retour à la page d'acceuil).->Security

        /** @var User */
        $user = $this->getUser();


        //2. Nous voulons savoir qui est connecter.->Security
        //3. Nous voulons passer l'utilisateur connecté à twig afin d'afficher ces commande. Environement de Twig/Response
        return $this->render('purchase/index.html.twig', [
            'purchases' => $user->getPurchases()
        ]);
    }
}
