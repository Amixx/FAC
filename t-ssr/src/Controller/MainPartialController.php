<?php

namespace App\Controller;

use App\Service\JsonFileReaderService;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Response\HtmxResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainPartialController extends AbstractController
{
    use HtmxControllerTrait;

    private array $data;

    public function __construct()
    {
        $this->data = JsonFileReaderService::readAndParseJson(__DIR__ . '/../../data/data.json');
    }

    #[Route('home-body', name: 'home_body')]
    public function homeBody(): HtmxResponse
    {
        return $this->htmxRender('main/home-body.html.twig', [
            'data' => $this->data['pages'][0],
        ]);
    }

    #[Route('/about-us-body', name: 'about_us_body')]
    public function aboutUsBody(): HtmxResponse
    {
        return $this->htmxRender('main/about-us-body.html.twig', [
            'data' => $this->data['pages'][1],
        ]);
    }

    #[Route('news-body', name: 'news_body')]
    public function newsBody(): HtmxResponse
    {
        return $this->htmxRender('main/news-body.html.twig', [
            'data' => $this->data['pages'][2],
        ]);
    }

    #[Route('offers-body', name: 'offers_body')]
    public function offersBody(): HtmxResponse
    {
        return $this->htmxRender('main/offers-body.html.twig', [
            'data' => $this->data['pages'][3],
        ]);
    }

    #[Route('contacts-body', name: 'contacts_body')]
    public function contactsBody(): HtmxResponse
    {
        return $this->htmxRender('main/contacts-body.html.twig', [
            'data' => $this->data['pages'][4],
        ]);
    }
}