<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Security\TokenAuthenticator;
use App\Security\UserAuthenticator;
use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
//    /**
//     * @Route("/login", name="app_login", methods={"POST", "OPTIONS"})
//     * @param Request $request
//     * @return Response
//     */
    //for api autorization
    /*public function login(Request $request): Response
    {

        if ($request->getMethod() === 'OPTIONS') {
            $request_headers = $request->server->getHeaders();
            $response_headers = [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Request-Headers' => $request_headers["ACCESS_CONTROL_REQUEST_HEADERS"],
                'Access-Control-Allow-Headers' => '*'
            ];
            return new Response('', 200, $response_headers);
        };
        $user = $this->getUser();
        $data = ['apiToken' => $user->getApiToken(), 'username' => $user->getEmail()];

        return $this->json($data, 200, ['Access-Control-Allow-Origin' => '*']);
    }*/
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authUtils): Response
    {

        // получить ошибку входа, если она есть
        $error = $authUtils->getLastAuthenticationError();

        // последнее имя пользователя, введенное пользователем
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }
}
