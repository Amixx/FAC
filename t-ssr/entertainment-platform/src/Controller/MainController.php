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

    #[Route('/', name: 'home')]
    public function home(Request $request): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }

        return $this->render('main/videos.html.twig', $this->dataService->getVideosData(
            $request->query->get('lastPage', 1),
        ));
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
        return $this->redirectToRoute('home');
    }

    #[Route('/video/{id}', name: 'video')]
    public function video(int $id): Response
    {
        $redirect = $this->denyAccessUnlessAuthenticated();
        if ($redirect instanceof Response) {
            return $redirect;
        }
        
        return $this->render('main/video.html.twig', $this->dataService->getVideoData($id));
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
