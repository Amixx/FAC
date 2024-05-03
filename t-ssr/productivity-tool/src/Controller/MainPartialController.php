<?php

namespace App\Controller;

use App\Service\DataService;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Request\HtmxRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainPartialController extends AbstractController
{
    use HtmxControllerTrait;

    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    #[Route('auth-body', name: 'auth_body')]
    public function authBody(): HtmxResponse
    {
        return $this->htmxRender('main/auth-body.html.twig', $this->dataService->authenticate($this->getRequest()->get('data')));
    }

    #[Route('todos-body', name: 'todos_body')]
    public function todosBody(): HtmxResponse
    {
        return $this->htmxRender('main/todos-body.html.twig', $this->dataService->getTodosData());
    }

    #[Route('todo-categories-body', name: 'todo_categories_body')]
    public function todoCategoriesBody(): HtmxResponse
    {
        return $this->htmxRender('main/todo-categories-body.html.twig', $this->dataService->getTodoCategoriesData());
    }

    #[Route('spent-times-body', name: 'spent_times_body')]
    public function spentTimesBody(): HtmxResponse
    {
        return $this->htmxRender('main/spent-times-body.html.twig', $this->dataService->getSpentTimesData());
    }

    #[Route('partial/todos-delete-spent-time', name: 'partial_todos_delete_spent_time')]
    public function deleteSpentTime(HtmxRequest $request): HtmxResponse
    {
        $this->dataService->deleteSpentTime($request->get('id'));
        return new HtmxResponse();
    }

    #[Route('partial/todo-categories-delete', name: 'partial_todo_categories_delete')]
    public function deleteTodoCategory(HtmxRequest $request): HtmxResponse
    {
        $this->dataService->deleteTodoCategory($request->get('id'));
        return new HtmxResponse();
    }

    #[Route('partial/todos', name: 'partial_todos')]
    public function todos(HtmxRequest $request): HtmxResponse
    {
        return $this->htmxRender('main/todos-body.html.twig', $this->dataService->getTodosData(
            $request->get('lastPage', 1),
            $request->get('includeCompleted', false)
        ));
    }

    #[Route('partial/todos-delete', name: 'partial_todos_delete')]
    public function deleteTodo(HtmxRequest $request): HtmxResponse
    {
        $this->dataService->deleteTodo($request->get('id'));
        return new HtmxResponse();
    }

    #[Route('partial/todos-update', name: 'partial_todos_update')]
    public function updateTodo(HtmxRequest $request): HtmxResponse
    {
        return $this->htmxRender('partials/todo-card.html.twig', $this->dataService->updateTodo($request->request->all()));
    }

    #[Route('partial/todos-add-spent-time', name: 'partial_todos_add_spent_time')]
    public function addSpentTime(HtmxRequest $request): HtmxResponse
    {
        return $this->htmxRender('main/todos-body.html.twig', $this->dataService->addSpentTime($request->get('todoId'), $request->get('duration')));
    }
}