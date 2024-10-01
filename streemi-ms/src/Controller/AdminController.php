<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render(view: 'admin/admin.html.twig');
    }

    #[Route('/admin_users', name: 'app_admin_users')]
    public function users(): Response
    {
        return $this->render(view: 'admin/admin_users.html.twig');
    }

    #[Route('/admin_films', name: 'app_admin_films')]
    public function films(): Response
    {
        return $this->render(view: 'admin/admin_films.html.twig');
    }

    #[Route('/admin_add_films', name: 'app_admin_add_films')]
    public function addFilms(): Response
    {
        return $this->render(view: 'admin/admin_add_films.html.twig');
    }
}
