<?php

namespace App\Controller;

use App\Service\DataService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/json')]
class JsonApiController extends AbstractController
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    #[Route('/home')]
    public function home(SerializerInterface $serializer): JsonResponse
    {
        return $this->json($this->dataService->getHomeData());
    }

    #[Route('/catalogue/{page}', methods: ['OPTIONS', 'GET'])]
    public function catalogue(Request $request, int $page = 1): JsonResponse
    {
        return $this->json($this->dataService->getCatalogueData($request->get('category'), $page));
    }

    #[Route('/product/{id}')]
    public function product(int $id): JsonResponse
    {
        return $this->json($this->dataService->getProductData($id));
    }

    #[Route('/add-to-cart', methods: ['OPTIONS', 'POST'])]
    public function addToCart(Request $request): JsonResponse
    {
        return $this->json($this->dataService->addToCart($request->toArray()['productId']));
    }

    #[Route('/cart')]
    public function cart(): JsonResponse
    {
        return $this->json($this->dataService->getCartData());
    }

    #[Route('/update-cart-item', methods: ['OPTIONS', 'POST'])]
    public function updateCartItem(Request $request): JsonResponse
    {
        $requestData = $request->toArray();
        $flash = $this->dataService->updateCartItem($requestData['cartItemId'], $requestData['amount']);

        return $this->json($flash);
    }

    #[Route('/remove-cart-item', methods: ['OPTIONS', 'POST'])]
    public function removeCartItem(Request $request): JsonResponse
    {
        $flash = $this->dataService->removeCartItem($request->toArray()['cartItemId']);

        return $this->json($flash);
    }

    #[Route('/checkout')]
    public function checkout(): JsonResponse
    {
        return $this->json($this->dataService->getCheckoutData());
    }

    #[Route('/make-payment')]
    public function makePayment(): JsonResponse
    {
        return $this->json($this->dataService->makePayment());
    }
}