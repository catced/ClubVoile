<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/membrelogin.html.twig', [
        //return $this->render('security/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Ce contrôleur ne sera jamais appelé directement
    }

    #[Route('/membre/login', name: 'membre_login')]
    public function loginmembre(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/membrelogin.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    // #[Route('/membre/logout', name: 'membre_logout')]
    // public function logoutmembre(): void
    // {
    //     throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    // }
}