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

    #[Route('/posts', name: 'json_posts')]
    public function posts(Request $request): JsonResponse
    {
        return $this->json($this->dataService->getPostsData($request->query->all()['lastPage'] ?? 1));
    }

    #[Route('/posts/{id}', name: 'json_post', methods: ['GET'])]
    public function post(int $id): JsonResponse
    {
        return $this->json($this->dataService->getPostData($id));
    }

    #[Route('/posts/new', name: 'json_posts_new', methods: ['POST'])]
    public function newPost(Request $request): JsonResponse
    {
        return $this->json($this->dataService->createPost($request->toArray()));
    }

    #[Route('/posts/toggle-like', name: 'json_posts_toggle_like', methods: ['POST'])]
    public function togglePostLike(Request $request): JsonResponse
    {
        return $this->json($this->dataService->togglePostLike($request->toArray()));
    }

    #[Route('/posts/delete', name: 'json_posts_delete', methods: ['POST'])]
    public function deletePost(Request $request): JsonResponse
    {
        return $this->json($this->dataService->deletePost($request->toArray()['id']));
    }

    #[Route('/user/{id}', name: 'json_user', methods: ['GET'])]
    public function user(int $id): JsonResponse
    {
        return $this->json($this->dataService->getUserData($id));
    }

    #[Route('/user/{id}/posts', name: 'json_user_posts', methods: ['GET'])]
    public function userPosts(int $id): JsonResponse
    {
        return $this->json($this->dataService->getUserPostsData($id));
    }
}