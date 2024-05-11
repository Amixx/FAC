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
        if ($this->requestStack->getSession()->get('authenticated_user')) {
            return $this->redirectToRoute('posts');
        } else {
            return $this->redirectToRoute('authenticate');
        }
    }

    #[Route('/authenticate', name: 'authenticate')]
    public function auth(Request $request): Response
    {
        $redirect = $this->denyAccessIfAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }

        if ($request->isMethod('POST')) {
            $data = $this->dataService->authenticate($request->request);
            if ($data) {
                return $this->redirectToRoute($data['redirect']);
            }
        }

        return $this->render('main/auth.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }
        $redirectRouteName = $this->dataService->logout();
        if ($redirectRouteName) {
            return $this->redirectToRoute($redirectRouteName);
        }
        return $this->redirectToRoute('posts');
    }

    #[Route('/posts', name: 'posts')]
    public function posts(Request $request): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }
        return $this->render('main/posts.html.twig', $this->dataService->getPostsData(
            $request->query->get('lastPage', 1),
        ));
    }

    #[Route('/posts/new/{postId}', name: 'posts_new', methods: ['GET'])]
    public function newPost(Request $request, ?int $postId = null): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }

        return $this->render('main/new-post.html.twig', $this->dataService->getNewPostData($postId));
    }

    #[Route('/posts/create', name: 'posts_create', methods: ['POST'])]
    public function createPost(Request $request): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }
        $flash = $this->dataService->createPost($request->request->all());

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('posts');
    }

    #[Route('/posts/toggle-like', name: 'posts_toggle_like', methods: ['POST'])]
    public function togglePostLike(Request $request): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }
        $flash = $this->dataService->togglePostLike($request->request->all());

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('posts');
    }

    #[Route('/posts/delete', name: 'posts_delete', methods: ['POST'])]
    public function deletePost(Request $request): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }
        $flash = $this->dataService->deletePost($request->request->get('id'));

        $this->addFlash($flash['type'], $flash['message']);

        return $request->headers->get('referer')
            ? $this->redirect($request->headers->get('referer'))
            : $this->redirectToRoute('posts');
    }

    #[Route('/user/{id}', name: 'user')]
    public function user(int $id): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }
        return $this->render('main/user.html.twig', $this->dataService->getUserData($id));
    }

    private function denyAccessUnlessAuthenticated(): ?Response
    {
//        $this->dataService->authenticate([]);
//        return null;
        if (!$this->requestStack->getSession()->get('authenticated_user')) {
            return $this->redirectToRoute('authenticate');
        }

        return null;
    }

    private function denyAccessIfAuthenticated(): ?Response
    {
//        $this->dataService->authenticate([]);
//        return null;
        if ($this->requestStack->getSession()->get('authenticated_user')) {
            return $this->redirectToRoute('home');
        }

        return null;
    }
}
