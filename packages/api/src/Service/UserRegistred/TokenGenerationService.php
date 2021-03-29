<?php


namespace App\Service\UserRegistred;


use App\Entity\User;

class TokenGenerationService
{
    public function generateToken(User $user): string
    {
        return md5(uniqid($user->getUsername(), true));
    }
}
