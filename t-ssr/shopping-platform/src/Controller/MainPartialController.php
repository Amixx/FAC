<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Request\HtmxRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainPartialController extends AbstractController
{
    use HtmxControllerTrait;

    private ProductRepository $productRepository;
    private ProductCategoryRepository $productCategoryRepository;
    private OrderRepository $orderRepository;
    private OrderItemRepository $orderItemRepository;

    public function __construct(
        ProductRepository         $productRepository,
        ProductCategoryRepository $productCategoryRepository,
        OrderRepository           $orderRepository,
        OrderItemRepository       $orderItemRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    #[Route('home-body', name: 'home_body')]
    public function homeBody(): HtmxResponse
    {
        return $this->htmxRender('main/home-body.html.twig', [
            'images' => [
                'mob' => '/images/mob/home-hero.jpg',
                'desk' => '/images/desk/home-hero.jpg',
            ],
            'newProducts' => $this->productRepository->findNewProducts(),
            'popularProducts' => $this->productRepository->findPopularProducts(),
            'productsWithDiscounts' => $this->productRepository->findProductsWithDiscounts(),
        ]);
    }

    #[Route('catalogue-body/{page}', name: 'catalogue_body')]
    public function catalogueBody(HtmxRequest $request, $page = 1): HtmxResponse
    {
        $categories = $this->productCategoryRepository->findAll();

        $selectedCategory = $request->get('category');
        if ($selectedCategory) {
            $products = $this->productRepository->findProductsByCategory($selectedCategory, $page);
        } else {
            $products = $this->productRepository->findProducts($page);
        }

        return $this->htmxRender('main/catalogue-body.html.twig', [
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'products' => $products,
        ]);
    }

    #[Route('product-body/{id}', name: 'product_body')]
    public function productBody(int $id): HtmxResponse
    {
        $product = $this->productRepository->find($id);

        return $this->htmxRender('main/product-body.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('cart-body', name: 'cart_body')]
    public function cartBody(): HtmxResponse
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            $order = $this->orderRepository->createNewOrder();
        }

        return $this->htmxRender('main/cart-body.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('checkout-body', name: 'checkout_body')]
    public function checkoutBody(): HtmxResponse
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            return $this->redirectToRoute('home');
        }

        return $this->htmxRender('main/checkout-body.html.twig', [
            'order' => $order,
        ]);
    }
}