<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OtherController extends AbstractController
{
    #[Route('/subscriptions', name: 'page_subscription')]
    public function subs(): Response
    {
        return $this->render('abonnements.html.twig');
    }

    #[Route('/upload', name: 'page_upload')]
    public function upload(): Response
    {
        return $this->render('upload.html.twig');
    }
}
