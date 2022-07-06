<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderValidateController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/order/thanks/{stripeSessionId}", name="order_validate")
     */
    public function index(Cart $cart, $stripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        // check if this order is the order of the actual user
        if(!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $cart->remove();
        if(!$order->getIsPaid()) {
            // Modifier le status isPaid de notre commande en mettant 1
            $order->setIsPaid(1);
            $this->entityManager->flush();
            // Envoyer un email au client pour lui confirmer sa commande
        }

        // Afficher les quelques informations de la commande de l'utilisateur
        return $this->render('order_validate/index.html.twig', [
            'order' => $order
        ]);
    }
}
