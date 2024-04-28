<?php

namespace App\Controller;

use App\Service\JsonFileReaderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class DataController extends AbstractController
{
    private array $data;

    public function __construct()
    {
        $this->data = JsonFileReaderService::readAndParseJson(__DIR__ . '/../../data/data.json');
    }

    #[Route('/global')]
    public function data(): JsonResponse
    {
        return $this->json([
            'branding' => $this->data['branding'],
            'footer' => $this->data['footer'],
        ]);
    }

    #[Route('/pages/{index}')]
    public function page(int $index): JsonResponse
    {
        return $this->json($this->data['pages'][$index]);
    }
}