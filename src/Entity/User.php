<?php


namespace App\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return 'asdasdasd';
    }

    public function getSalt()
    {
        return md5(microtime());
    }

    public function getUsername()
    {
        return 'andrew';
    }

    public function eraseCredentials()
    {
        // nothing
    }
}