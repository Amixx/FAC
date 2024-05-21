<?php

namespace App\Controller;

use App\Service\DataService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/json')]
class JsonApiController extends AbstractController
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    #[Route('/authenticate', name: 'json_authenticate', methods: ['POST'])]
    public function authenticate(Request $request): JsonResponse
    {
        $redirectRouteName = $this->dataService->authenticate($request->toArray());

        return $this->json($redirectRouteName);
    }

    #[Route('/logout', name: 'json_logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
        $redirectRouteName = $this->dataService->logout();

        return $this->json($redirectRouteName);
    }

    #[Route('/videos', name: 'json_videos')]
    public function videos(Request $request): JsonResponse
    {
        return $this->json($this->dataService->getVideosData($request->query->all()['lastPage'] ?? 1));
    }
}