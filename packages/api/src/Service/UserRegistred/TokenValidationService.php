<?php


namespace App\Service\UserRegistred;


use App\Entity\User;
use App\Repository\UserRepository;

class TokenValidationService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validateToken(User $user, string $token): bool
    {
        return $user->getActivationToken() === $token;
    }
}
