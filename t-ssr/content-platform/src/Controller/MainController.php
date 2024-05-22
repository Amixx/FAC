<?php

namespace App\Controller;

use App\Service\JsonFileReaderService;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Response\HtmxResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    use HtmxControllerTrait;

    private array $data;

    public function __construct()
    {
        $this->data = JsonFileReaderService::readAndParseJson(__DIR__ . '/../../data/data.json');
    }

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig', [
            'data' => $this->data['pages'][0],
        ]);
    }

    #[Route('/about-us', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('main/about-us.html.twig', [
            'data' => $this->data['pages'][1],
        ]);
    }

    #[Route('/news', name: 'news')]
    public function news(): Response
    {
        return $this->render('main/news.html.twig', [
            'data' => $this->data['pages'][2],
        ]);
    }

    #[Route('/offers', name: 'offers')]
    public function offers(): Response
    {
        return $this->render('main/offers.html.twig', [
            'data' => $this->data['pages'][3],
        ]);
    }

    #[Route('/contacts', name: 'contacts')]
    public function contacts(): Response
    {
        return $this->render('main/contacts.html.twig', [
            'data' => $this->data['pages'][4],
        ]);
    }
}