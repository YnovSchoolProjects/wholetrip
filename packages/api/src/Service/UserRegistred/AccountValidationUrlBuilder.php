<?php


namespace App\Service\UserRegistred;


use App\Entity\User;

class AccountValidationUrlBuilder
{
    private string $baseUrl;

    public function __construct(string $activationBaseUrl)
    {
        $this->baseUrl = $activationBaseUrl;
    }

    public function getUrl(User $user): string
    {
        return sprintf("%s?user=%s&token=%s", $this->baseUrl, $user->getId(), $user->getActivationToken());
    }
}
