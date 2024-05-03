<?php

namespace App\Controller;

use App\Service\DataService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    #[Route('/')]
    public function home(): Response
    {
        return $this->redirectToRoute('home_body');
    }

    #[Route('/authenticate')]
    public function auth(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $redirectRouteName = $this->dataService->authenticate(
                $request->request->get('username'),
                $request->request->get('password'));
            if ($redirectRouteName) {
                return $this->redirectToRoute($redirectRouteName);
            }
        }

        return $this->render('main/auth.html.twig');
    }

    #[Route('/todos', name: 'todos')]
    public function todos(): Response
    {
        return $this->render('main/todos.html.twig', $this->dataService->getTodosData());
    }

    #[Route('/todos/add', name: 'todos_add', methods: ['POST'])]
    public function addTodo(Request $request): Response
    {
        $flash = $this->dataService->addTodo($request->request);

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todos');
    }

    #[Route('/todos/update', name: 'todos_update', methods: ['POST'])]
    public function updateTodo(Request $request): Response
    {
        $flash = $this->dataService->updateTodo($request->request->get('id'), $request->request->get('title'), $request->request->get('description'), $request->request->get('importance'), $request->request->get('status'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todos');
    }

    #[Route('/todos/delete', name: 'todos_delete', methods: ['POST'])]
    public function deleteTodo(Request $request): Response
    {
        $flash = $this->dataService->deleteTodo($request->request->get('id'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todos');
    }

    #[Route('/todos/add-spent-time', name: 'todos_add_spent_time', methods: ['POST'])]
    public function addSpentTime(Request $request): Response
    {
        $flash = $this->dataService->addSpentTime($request->request->get('todoId'), $request->request->get('duration'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todos');
    }

    #[Route('/todos/delete-spent-time', name: 'todos_delete_spent_time', methods: ['POST'])]
    public function deleteSpentTime(Request $request): Response
    {
        $flash = $this->dataService->deleteSpentTime($request->request->get('id'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todos');
    }

    #[Route('/todo-categories', name: 'todo_categories')]
    public function todoCategories(): Response
    {
        return $this->render('main/todo-categories.html.twig', $this->dataService->getTodoCategoriesData());
    }

    #[Route('/todo-categories/add', name: 'todo_categories_add', methods: ['POST'])]
    public function addTodoCategory(Request $request): Response
    {
        $flash = $this->dataService->addTodoCategory($request->request);

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todo_categories');
    }

    #[Route('/todo-categories/update', name: 'todo_categories_update', methods: ['POST'])]
    public function updateTodoCategory(Request $request): Response
    {
        $flash = $this->dataService->updateTodoCategory($request->request);

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todo_categories');
    }

    #[Route('/todo-categories/delete', name: 'todo_categories_delete', methods: ['POST'])]
    public function deleteTodoCategory(Request $request): Response
    {
        $flash = $this->dataService->deleteTodoCategory($request->request->get('id'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todo_categories');
    }

    #[Route('/spent-times', name: 'spent_times')]
    public function spentTimes(): Response
    {
        return $this->render('main/spent-times.html.twig', $this->dataService->getSpentTimesData());
    }
}