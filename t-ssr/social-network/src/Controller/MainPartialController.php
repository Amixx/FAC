<?php

namespace App\Controller;

use App\Service\DataService;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Request\HtmxRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/partial')]
class MainPartialController extends AbstractController
{
    use HtmxControllerTrait;

    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    #[Route('/posts', name: 'partial_posts')]
    public function posts(HtmxRequest $request): HtmxResponse
    {
        return $this->htmxRender('main/posts-body.html.twig', $this->dataService->getPostsData(
            $request->get('lastPage', 1),
        ));
    }

    #[Route('/posts/new/{postId}', name: 'partial_posts_new')]
    public function postsNew(HtmxRequest $request, ?int $postId = null): HtmxResponse
    {
        return $this->htmxRender('main/posts-new-body.html.twig', $this->dataService->getNewPostData($postId));
    }

    #[Route('posts/toggle-like', name: 'partial_posts_toggle_like')]
    public function postsToggleLike(HtmxRequest $request): HtmxResponse
    {
        return $this->htmxRender('partials/post-card.html.twig', $this->dataService->togglePostLike($request->request->all()));
    }

    #[Route('posts/delete', name: 'partial_posts_delete')]
    public function postsDelete(HtmxRequest $request): HtmxResponse
    {
        $this->dataService->deletePost($request->request->get('id'));
        return new HtmxResponse();
    }

    #[Route('user/{id}', name: 'partial_user')]
    public function user(HtmxRequest $request, int $id): HtmxResponse
    {
        return $this->htmxRender('main/user-body.html.twig', $this->dataService->getUserData($id));
    }
}