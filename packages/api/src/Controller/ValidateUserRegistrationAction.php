<?php


namespace App\Controller;


use App\Repository\UserRepository;
use App\Service\UserRegistred\TokenValidationService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ValidateUserRegistrationAction extends AbstractController
{
    private TokenValidationService $validationService;
    private UserRepository $repository;
    private EntityManagerInterface $entityManager;
    private string $redirectUrl;

    public function __construct(string $redirectUrl, TokenValidationService $validationService, UserRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->validationService = $validationService;
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @Route("/api/user_validation", name="user_validation")
     */
    public function __invoke(Request $request): Response
    {
        $userId = $request->query->get('user_id');
        $token = $request->query->get('token');

        if (!$token) {
            throw new BadRequestHttpException("Missing 'token' query field");
        }

        $user = $this->repository->find($userId);

        if ($user === null) {
            throw new NotFoundHttpException("User $userId do not exist");
        }

        if (!$this->validationService->validateToken($user, $token)) {
            throw new NotFoundHttpException("Given token : $token do not exist for user $userId");
        }

        $user->setActive(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirect($this->redirectUrl);
    }
}
