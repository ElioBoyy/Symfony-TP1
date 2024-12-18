<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserApiController extends AbstractController
{
    #[Route(name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            $user->setUsername($request->request->get('username'));
            $user->setEmail($request->request->get('email'));
            $user->setPassword(password_hash($request->request->get('password'), PASSWORD_BCRYPT));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('confirm', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/confirm.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/login', name: 'app_user_login', methods: ['POST'])]
    public function login(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['email' => $request->request->get('email')]);

        if ($user && password_verify($request->request->get('password'), $user->getPassword())) {
            return $this->redirectToRoute('app_user_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('page_login', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
