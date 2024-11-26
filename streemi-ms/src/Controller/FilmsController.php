<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FilmsController extends AbstractController
{
    #[Route(path: '/movie', name: 'page_detail_movie')]
    public function detail(): Response
    {
        return $this->render(view: 'detail.html.twig');
    }

    #[Route(path: '/serie', name: 'page_detail_serie')]
    public function detailSerie(): Response
    {
        return $this->render(view: 'detail_serie.html.twig');
    }

    #[Route(path: '/discover', name: 'page_discover')]
    public function discover(): Response
    {
        return $this->render(view: 'discover.html.twig');
    }

    #[Route('/lists', name: 'page_lists')]
    public function lists(): Response
    {
        return $this->render('lists.html.twig');
    }

    #[Route(path: '/category', name: 'page_category')]
    public function category(): Response
    {
        return $this->render(view: 'category.html.twig');
    }
}