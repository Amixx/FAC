<?php

namespace App\Controller;

use App\Service\DataService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class MainController extends AbstractController
{
    private DataService $dataService;
    private RequestStack $requestStack;

    public function __construct(DataService $dataService, RequestStack $requestStack)
    {
        $this->dataService = $dataService;
        $this->requestStack = $requestStack;
    }

    #[Route('/')]
    public function home(): Response
    {
        if ($this->requestStack->getSession()->get('is_authenticated')) {
            return $this->redirectToRoute('todos');
        } else {
            return $this->redirectToRoute('authenticate');
        }
    }

    #[Route('/authenticate', name: 'authenticate')]
    public function auth(Request $request): Response
    {
        $this->denyAccessIfAuthenticated();

        if ($request->isMethod('POST')) {
            $redirectRouteName = $this->dataService->authenticate($request->request);
            if ($redirectRouteName) {
                return $this->redirectToRoute($redirectRouteName);
            }
        }

        return $this->render('main/auth.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $redirectRouteName = $this->dataService->logout();
        if ($redirectRouteName) {
            return $this->redirectToRoute($redirectRouteName);
        }
        return $this->redirectToRoute('todos');
    }

    #[Route('/todos', name: 'todos')]
    public function todos(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        return $this->render('main/todos.html.twig', $this->dataService->getTodosData(
            $request->query->get('lastPage', 1),
            $request->query->get('includeCompleted', false)
        ));
    }

    #[Route('/todos/add', name: 'todos_add', methods: ['POST'])]
    public function addTodo(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->addTodo($request->request);

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('todos');
    }

    #[Route('/todos/update', name: 'todos_update', methods: ['POST'])]
    public function updateTodo(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->updateTodo($request->request->all());

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('todos');
    }

    #[Route('/todos/delete', name: 'todos_delete', methods: ['POST'])]
    public function deleteTodo(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->deleteTodo($request->request->get('id'));

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('todos');
    }

    #[Route('/todos/add-spent-time', name: 'todos_add_spent_time', methods: ['POST'])]
    public function addSpentTime(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->addSpentTime($request->request->get('todoId'), $request->request->get('duration'));

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('todos');
    }

    #[Route('/todos/delete-spent-time', name: 'todos_delete_spent_time', methods: ['POST'])]
    public function deleteSpentTime(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->deleteSpentTime($request->request->get('id'));

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('todos');
    }

    #[Route('/todo-categories', name: 'todo_categories')]
    public function todoCategories(): Response
    {
        $this->denyAccessUnlessAuthenticated();
        return $this->render('main/todo-categories.html.twig', $this->dataService->getTodoCategoriesData());
    }

    #[Route('/todo-categories/add', name: 'todo_categories_add', methods: ['POST'])]
    public function addTodoCategory(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->addTodoCategory($request->request);

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todo_categories');
    }

    #[Route('/todo-categories/update', name: 'todo_categories_update', methods: ['POST'])]
    public function updateTodoCategory(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->updateTodoCategory($request->request);

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todo_categories');
    }

    #[Route('/todo-categories/delete', name: 'todo_categories_delete', methods: ['POST'])]
    public function deleteTodoCategory(Request $request): Response
    {
        $this->denyAccessUnlessAuthenticated();
        $flash = $this->dataService->deleteTodoCategory($request->request->get('id'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('todo_categories');
    }

    #[Route('/spent-times', name: 'spent_times')]
    public function spentTimes(): Response
    {
        $this->denyAccessUnlessAuthenticated();
        return $this->render('main/spent-times.html.twig', $this->dataService->getSpentTimesData());
    }

    private function denyAccessUnlessAuthenticated(): void
    {
        if (!$this->requestStack->getSession()->get('is_authenticated')) {
            $this->redirectToRoute('authenticate');
        }
    }

    private function denyAccessIfAuthenticated(): void
    {
        if ($this->requestStack->getSession()->get('is_authenticated')) {
            $this->redirectToRoute('home');
        }
    }
}
