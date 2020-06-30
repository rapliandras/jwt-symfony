<?php


namespace App\Provider;


use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function loadUserByUsername(string $username)
    {
        return new User();
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass(string $class)
    {
        return User::class;
    }
}