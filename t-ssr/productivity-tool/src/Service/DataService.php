<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\SpentTime;
use App\Entity\TodoItem;
use App\Entity\TodoItemCategory;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SpentTimeRepository;
use App\Repository\TodoItemCategoryRepository;
use App\Repository\TodoItemRepository;
use DateTime;

class DataService
{
    private TodoItemRepository $todoItemRepository;
    private TodoItemCategoryRepository $todoItemCategoryRepository;
    private SpentTimeRepository $spentTimeRepository;

    public function __construct(
        TodoItemRepository         $todoItemRepository,
        TodoItemCategoryRepository $todoItemCategoryRepository,
        SpentTimeRepository        $spentTimeRepository,
    )
    {
        $this->todoItemRepository = $todoItemRepository;
        $this->todoItemCategoryRepository = $todoItemCategoryRepository;
        $this->spentTimeRepository = $spentTimeRepository;
    }

    public function authenticate(string $username, string $password): ?string
    {
        // simulate authentication
        sleep(1);
        return 'todos';
    }

    public function getTodos(int $page = 1): array
    {
        $itemsPerPage = 10;
        $todoItemsCount = $this->todoItemRepository->findTodoItemsCount();
        $hasMoreItems = $todoItemsCount > ($itemsPerPage * $page);

        $todoItems = $this->todoItemRepository->findTodoItems($page, $itemsPerPage);

        return [
            'todoItems' => $todoItems,
            'page' => $page,
            'hasMoreItems' => $hasMoreItems,
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
            'message' => 'Todo item added!',
        ];
    }

    public function updateTodo(int $id, $data): array
    {
        $todoItem = $this->todoItemRepository->find($id);
        $todoItem->setName($data['name']);
        $todoItem->setDeadline($data['deadline']);
        $todoItem->setImportant($data['important']);
        $todoItem->setStatus($data['status']);
        $todoItem->setCategory($data['category']);
        $todoItem->setUpdatedAt();

        $this->todoItemRepository->save($todoItem);

        return [
            'type' => 'success',
            'message' => 'Todo item updated!',
        ];
    }

    public function deleteTodo(int $id): array
    {
        $todoItem = $this->todoItemRepository->find($id);
        $this->todoItemRepository->remove($todoItem);

        return [
            'type' => 'success',
            'message' => 'Todo item deleted!',
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
            'message' => 'Spent time added!',
        ];
    }

    public function deleteSpentTime(int $id): array
    {
        $spentTime = $this->spentTimeRepository->find($id);
        $this->spentTimeRepository->remove($spentTime);

        return [
            'type' => 'success',
            'message' => 'Spent time deleted!',
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
            'message' => 'Todo category added!',
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
            'message' => 'Todo category updated!',
        ];
    }

    public function deleteTodoCategory(int $id): array
    {
        $todoCategory = $this->todoItemCategoryRepository->find($id);
        $this->todoItemCategoryRepository->remove($todoCategory);

        return [
            'type' => 'success',
            'message' => 'Todo category deleted!',
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