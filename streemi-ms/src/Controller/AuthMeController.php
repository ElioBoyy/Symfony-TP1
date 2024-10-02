<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class AuthMeController extends AbstractController
{
    #[Route("/login", name: "app_login")]
    public function login(): Response
    {
        return $this->render(view: 'login.html.twig');
    }

    #[Route("/register", name: "app_register")]
    public function register(): Response
    {
        return $this->render(view: 'register.html.twig');
    }

    #[Route("/forgot-password", name: "app_forgot_password")]
    public function forgotPassword(): Response
    {
        return $this->render(view: 'forgot.html.twig');
    }

    #[Route("/reset-password", name: "app_reset_password")]
    public function resetPassword(): Response
    {
        return $this->render(view: 'reset.html.twig');
    }


    #[Route("/create-user", name: "app_create_user", methods: ["POST"])]
    public function createUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        error_log($request->request->get('username'));
        $user->setUsername($request->request->get('username'));
        $user->setPassword(password_hash($request->request->get('password'), PASSWORD_BCRYPT));
        $user->setEmail($request->request->get('email'));

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('User created successfully');
    }
}
