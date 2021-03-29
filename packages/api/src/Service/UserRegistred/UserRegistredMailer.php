<?php


namespace App\Service\UserRegistred;


use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;

class UserRegistredMailer
{
    private string $applicationFromAddress;
    private AccountValidationUrlBuilder $urlBuilder;

    public function __construct(string $applicationFromAddress, AccountValidationUrlBuilder $urlBuilder)
    {
        $this->applicationFromAddress = $applicationFromAddress;
        $this->urlBuilder = $urlBuilder;
    }

    public function createMail(User $createdUser): Email
    {
        $mail = new TemplatedEmail();
        $mail->from($this->applicationFromAddress)
            ->to($createdUser->getEmail())
            ->subject("Validate your account in Wholetrip")
            ->htmlTemplate('emails/validateAccount.html.twig')
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => $createdUser->getUsername(),
                'validation_url' => $this->urlBuilder->getUrl($createdUser),
            ])
        ;

        return $mail;
    }
}
