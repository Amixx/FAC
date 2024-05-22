<?php

namespace App\Service;

use App\Entity\SpentTime;
use App\Entity\TodoItem;
use App\Entity\TodoItemCategory;
use App\Repository\SpentTimeRepository;
use App\Repository\TodoItemCategoryRepository;
use App\Repository\TodoItemRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class DataService
{
    private TodoItemRepository $todoItemRepository;
    private TodoItemCategoryRepository $todoItemCategoryRepository;
    private SpentTimeRepository $spentTimeRepository;
    private RequestStack $requestStack;

    public function __construct(
        TodoItemRepository         $todoItemRepository,
        TodoItemCategoryRepository $todoItemCategoryRepository,
        SpentTimeRepository        $spentTimeRepository,
        RequestStack               $requestStack,
    )
    {
        $this->todoItemRepository = $todoItemRepository;
        $this->todoItemCategoryRepository = $todoItemCategoryRepository;
        $this->spentTimeRepository = $spentTimeRepository;
        $this->requestStack = $requestStack;
    }

    public function authenticate($data): ?string
    {
        // simulate authentication
        sleep(0.5);
        $this->requestStack->getSession()->set('is_authenticated', true);
        return 'todos';
    }

    public function logout(): ?string
    {
        $this->requestStack->getSession()->remove('is_authenticated');
        return 'authenticate';
    }

    public function getTodosData(int $lastPage = 1, bool $includeCompleted = false): array
    {
        $itemsPerPage = 10;
        $todoItemsCount = $this->todoItemRepository->findTodoItemsCount($includeCompleted);
        $hasMoreItems = $todoItemsCount > ($itemsPerPage * $lastPage);
        $todos = $this->todoItemRepository->findTodoItems($itemsPerPage * $lastPage, $includeCompleted);

        return [
            'todos' => $todos,
            'lastPage' => $lastPage,
            'hasMoreItems' => $hasMoreItems,
            'includeCompleted' => $includeCompleted,
        ];
    }

    public function addTodo($data): array
    {
        $todoItem = new TodoItem();
        $todoItem->setName($data['name']);
        $todoItem->setDeadline($data['deadline']);
        $todoItem->setImportant($data['important']);
        $todoItem->setStatus($data['status']);
        $todoItem->setCategory($data['category']);
        $todoItem->setCreatedAt();

        $this->todoItemRepository->save($todoItem);

        return [
            'type' => 'success',
            'message' => 'Darāmais darbs pievienots!',
        ];
    }

    public function updateTodo(array $data): array
    {
        $todoItem = $this->todoItemRepository->find($data['id']);
        foreach ($data as $key => $value) {
            if ($key == 'id') continue;
            $todoItem->{'set' . ucfirst($key)}($value);
        }

        $this->todoItemRepository->save($todoItem);

        return [
            'type' => 'success',
            'message' => 'Darāmais darbs atjaunots!',
            'todo' => $todoItem,
        ];
    }

    public function deleteTodo(int $id): array
    {
        $todoItem = $this->todoItemRepository->find($id);
        $this->todoItemRepository->remove($todoItem);

        return [
            'type' => 'success',
            'message' => 'Darāmais darbs dzēsts!',
        ];
    }

    public function addSpentTime(int $todoId, int $duration): array
    {
        $spentTime = new SpentTime();
        $spentTime->setTodoId($todoId);
        $spentTime->setDuration($duration);
        $spentTime->setCreatedAt();

        $this->spentTimeRepository->save($spentTime);

        return [
            'type' => 'success',
            'message' => 'Pavadītais laiks pievienots!',
        ];
    }

    public function deleteSpentTime(int $id): array
    {
        $spentTime = $this->spentTimeRepository->find($id);
        $this->spentTimeRepository->remove($spentTime);

        return [
            'type' => 'success',
            'message' => 'Pavadītais laiks dzēsts!',
        ];
    }

    public function getTodoCategoriesData(): array
    {
        $todoCategories = $this->todoItemCategoryRepository->findAll();

        return [
            'todoCategories' => $todoCategories,
        ];
    }

    public function addTodoCategory($data): array
    {
        $todoCategory = new TodoItemCategory();
        $todoCategory->setName($data['name']);
        $todoCategory->setCreatedAt();

        $this->todoItemCategoryRepository->save($todoCategory);

        return [
            'type' => 'success',
            'message' => 'Darbu kategorija pievienota!',
        ];
    }

    public function updateTodoCategory($data): array
    {
        $todoCategory = $this->todoItemCategoryRepository->find($data['id']);
        $todoCategory->setName($data['name']);
        $todoCategory->setUpdatedAt();

        $this->todoItemCategoryRepository->save($todoCategory);

        return [
            'type' => 'success',
            'message' => 'Darbu kategorija atjaunota!',
        ];
    }

    public function deleteTodoCategory(int $id): array
    {
        $todoCategory = $this->todoItemCategoryRepository->find($id);
        $this->todoItemCategoryRepository->remove($todoCategory);

        return [
            'type' => 'success',
            'message' => 'Darbu kategorija dzēsta!',
        ];
    }

    public function getSpentTimesData(): array
    {
        $spentTimes = $this->spentTimeRepository->findAll();

        return [
            'spentTimes' => $spentTimes,
        ];
    }
}