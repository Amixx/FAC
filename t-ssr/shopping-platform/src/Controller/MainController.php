<?php

namespace App\Controller;

use App\Service\JsonFileReaderService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig', [
            'data' => [
                'title' => 'Apģērbi.lv',
                'metaTitle' => 'Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ]
        ]);
    }
}