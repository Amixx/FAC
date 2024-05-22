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

    #[Route('/videos', name: 'partial_videos')]
    public function videos(HtmxRequest $request): HtmxResponse
    {
        return $this->htmxRender('main/videos-body.html.twig', $this->dataService->getVideosData(
            $request->get('lastPage', 1),
        ));
    }

    #[Route('/video/{id}', name: 'partial_video')]
    public function video(int $id): HtmxResponse
    {
        return $this->htmxRender('main/video-body.html.twig', $this->dataService->getVideoData($id));
    }
}