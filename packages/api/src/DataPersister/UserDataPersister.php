<?php


namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use App\Service\UserRegistred\TokenGenerationService;
use App\Service\UserRegistred\UserRegistredMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;

final class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private ContextAwareDataPersisterInterface $decorated;
    private TokenGenerationService $tokenGenerationService;
    private MailerInterface $mailer;
    private UserRegistredMailer $userRegistredMailer;
    private EntityManagerInterface $entityManager;

    public function __construct(ContextAwareDataPersisterInterface $decorated, TokenGenerationService $tokenGenerationService, MailerInterface $mailer, UserRegistredMailer $userRegistredMailer, EntityManagerInterface $entityManager)
    {
        $this->decorated = $decorated;
        $this->tokenGenerationService = $tokenGenerationService;
        $this->mailer = $mailer;
        $this->userRegistredMailer = $userRegistredMailer;
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
        $this->decorated->persist($data, $context);

        if (
            $data instanceof User && (
                ($context['collection_operation_name'] ?? null) === 'post' ||
                ($context['graphql_operation_name'] ?? null) === 'create'
            )
        ) {
            $this->generateToken($data);
            $this->sendRegistrationEmail($data);

            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }

        return $data;
    }

    public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
    }

    public function generateToken(User $user)
    {
        $token = $this->tokenGenerationService->generateToken($user);
        $user->setActivationToken($token);
    }

    public function sendRegistrationEmail(User $user)
    {
        $email = $this->userRegistredMailer->createMail($user);
        $this->mailer->send($email);
    }
}
