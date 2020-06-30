<?php


namespace App\AuthenticationManager;


use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class JWTAuthenticationManager implements AuthenticationManagerInterface
{

    public function authenticate(TokenInterface $token)
    {
        // Change token to contain info about being authenticated.
        return $token;
    }
}