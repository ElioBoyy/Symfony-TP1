<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{
    #[Route('/abonnements', name: 'app_subscriptions')]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        $subscriptions = $subscriptionRepository->findAll();

        return $this->render('other/abonnements.html.twig', [
            'subscriptions' => $subscriptions,
        ]);
    }
}

