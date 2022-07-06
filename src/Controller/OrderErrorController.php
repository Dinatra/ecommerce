<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderErrorController extends AbstractController
{
    /**
     * @Route("/order/error/{stripeSessionId}", name="order_error")
     */
    public function index($stripeSessionId, EntityManagerInterface  $entityManager): Response
    {
        $order = $entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        // check if this order is the order of the actual user
        if(!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }
        // envoyer un email d'echec de paiement
        return $this->render('order_error/index.html.twig', [
            'order' => $order
        ]);
    }
}
