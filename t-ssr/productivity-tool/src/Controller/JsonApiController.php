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

    #[Route('/todos', name: 'json_todos')]
    public function todos(Request $request): JsonResponse
    {
        $data = $request->query->all();
        return $this->json($this->dataService->getTodosData(
            $data['lastPage'] ?? 1,
            $data['includeCompleted'] ?? false
        ));
    }

    #[Route('/todos/delete', name: 'json_todos_delete')]
    public function deleteTodo(Request $request): JsonResponse
    {
        $flash = $this->dataService->deleteTodo($request->toArray()['id']);

        return $this->json($flash);
    }

    #[Route('/todos/update', name: 'json_todos_update')]
    public function updateTodo(Request $request): JsonResponse
    {
        $updatedTodo = $this->dataService->updateTodo($request->toArray());

        return $this->json($updatedTodo);
    }

    #[Route('/todo-categories', name: 'json_todo_categories')]
    public function todoCategories(): JsonResponse
    {
        return $this->json($this->dataService->getTodoCategoriesData());
    }

    #[Route('/todo-categories/delete', name: 'json_todo_categories_delete')]
    public function deleteTodoCategory(Request $request): JsonResponse
    {
        $flash = $this->dataService->deleteTodoCategory($request->toArray()['id']);

        return $this->json($flash);
    }

    #[Route('/todo-categories/update', name: 'json_todo_categories_update')]
    public function updateTodoCategory(Request $request): JsonResponse
    {
        $updatedTodoCategory = $this->dataService->updateTodoCategory($request->toArray());

        return $this->json($updatedTodoCategory);
    }

    #[Route('/spent-times', name: 'json_spent_times')]
    public function spentTimes(): JsonResponse
    {
        return $this->json($this->dataService->getSpentTimesData());
    }

    #[Route('/spent-times/delete', name: 'json_spent_times_delete')]
    public function deleteSpentTime(Request $request): JsonResponse
    {
        $flash = $this->dataService->deleteSpentTime($request->toArray()['id']);

        return $this->json($flash);
    }

    #[Route('/spent-times/update', name: 'json_spent_times_update')]
    public function updateSpentTime(Request $request): JsonResponse
    {
        $updatedSpentTime = $this->dataService->updateSpentTime($request->toArray()['spentTime']);

        return $this->json($updatedSpentTime);
    }
}