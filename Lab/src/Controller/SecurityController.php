<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route(name="api_login", path="/api/login_check")
     * @return JsonResponse
     */
    public function api_login(): JsonResponse
    {
        $user = $this->getUser();

        return new Response([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);
    }
}