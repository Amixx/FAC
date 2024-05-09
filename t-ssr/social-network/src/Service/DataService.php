<?php

namespace App\Service;

use App\Entity\Post;
use App\Entity\PostLike;
use App\Repository\PostLikeRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class DataService
{
    private RequestStack $requestStack;
    private PostRepository $postRepository;
    private UserRepository $userRepository;
    private PostLikeRepository $postLikeRepository;

    public function __construct(
        RequestStack       $requestStack,
        PostRepository     $postRepository,
        UserRepository     $userRepository,
        PostLikeRepository $postLikeRepository,
    )
    {
        $this->requestStack = $requestStack;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->postLikeRepository = $postLikeRepository;
    }

    public function authenticate($data): ?string
    {
        // simulate authentication
        sleep(0.5);
        $fakeUser = $this->userRepository->findFirst();
        $this->requestStack->getSession()->set('authenticated_user', $fakeUser);
        return 'posts';
    }

    public function logout(): ?string
    {
        $this->requestStack->getSession()->remove('authenticated_user');
        return 'authenticate';
    }

    public function getPostsData(int $lastPage): array
    {
        $itemsPerPage = 10;
        $posts = $this->postRepository->findPosts($itemsPerPage * $lastPage);
        $postsCount = $this->postRepository->findPostsCount();

        return [
            'posts' => $posts,
            'lastPage' => $lastPage,
            'hasMoreItems' => $postsCount > ($lastPage * $itemsPerPage),
        ];
    }

    public function getNewPostData(?int $postId): array
    {
        $repostedPost = $postId ? $this->postRepository->find($postId) : null;
        return ['repostedPost' => $repostedPost];
    }

    public function createPost($data): array
    {
        $post = new Post();
        $post->setContent($data['content']);
        $post->setAuthor($this->userRepository->find($this->requestStack->getSession()->get('authenticated_user')->getId()));
        $repostedPost = $data['repostedPostId'] ? $this->postRepository->find($data['repostedPostId']) : null;
        $post->setRepostedPost($repostedPost);
        $post->setCreatedAt();
        $this->postRepository->save($post);

        return [
            'type' => 'success',
            'message' => 'Ziņa pievienota!',
            'post' => $post,
        ];
    }

    public function togglePostLike(array $data): array
    {
        $post = $this->postRepository->find($data['id']);

        if ($post->hasBeenLikedBy($this->requestStack->getSession()->get('authenticated_user'))) {
            $postLike = $this->postLikeRepository->findOneBy([
                'author' => $this->requestStack->getSession()->get('authenticated_user'),
                'post' => $post,
            ]);
            if ($postLike) {
                $this->postLikeRepository->remove($postLike);
            }
        } else {
            $postLike = new PostLike();
            $postLike->setPost($post);
            $postLike->setAuthor($this->userRepository->find($this->requestStack->getSession()->get('authenticated_user')));
            $postLike->setCreatedAt();
            $this->postLikeRepository->save($postLike);
        }

        return [
            'type' => 'success',
            'message' => 'Darbība veiksmīga!',
            'post' => $post,
        ];
    }

    public function deletePost(int $id): array
    {
        $post = $this->postRepository->find($id);
        $this->postRepository->remove($post);

        return [
            'type' => 'success',
            'message' => 'Ziņa dzēsta!',
        ];
    }

    public function getUserData(int $id): array
    {
        $user = $this->userRepository->find($id);
        return ['user' => $user];
    }
}