<?php

namespace App\Service;

use App\Entity\Video;
use App\Repository\VideoRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class DataService
{
    private RequestStack $requestStack;
    private VideoRepository $videoRepository;
    private UserRepository $userRepository;

    public function __construct(
        RequestStack    $requestStack,
        VideoRepository $videoRepository,
        UserRepository  $userRepository,
    )
    {
        $this->requestStack = $requestStack;
        $this->videoRepository = $videoRepository;
        $this->userRepository = $userRepository;
    }

    public function authenticate($data): array
    {
        // simulate authentication
        sleep(0.5);
        $fakeUser = $this->userRepository->findFirst();
        $this->requestStack->getSession()->set('authenticated_user', $fakeUser);
        return [
            'user' => $fakeUser,
            'redirect' => 'home',
        ];
    }

    public function logout(): ?string
    {
        $this->requestStack->getSession()->remove('authenticated_user');
        return 'authenticate';
    }

    public function getVideosData(int $lastPage): array
    {
        $itemsPerPage = 20;
        $videos = $this->videoRepository->findVideos($itemsPerPage * $lastPage);
        $videosCount = $this->videoRepository->findVideosCount();

        return [
            'videos' => $videos,
            'lastPage' => $lastPage,
            'hasMoreItems' => $videosCount > ($lastPage * $itemsPerPage),
        ];
    }

    public function getVideoData(int $id): array
    {
        return [
            'video' => $this->videoRepository->find($id),
            'relatedVideos' => $this->videoRepository->findRelatedVideos($id),
        ];
    }
}