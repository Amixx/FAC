<?php

namespace App\Service;

use App\Entity\Order;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;

class DataService
{
    private ProductRepository $productRepository;
    private ProductCategoryRepository $productCategoryRepository;
    private OrderRepository $orderRepository;

    public function __construct(
        ProductRepository         $productRepository,
        ProductCategoryRepository $productCategoryRepository,
        OrderRepository           $orderRepository,
        OrderItemRepository       $orderItemRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getProductData(int $id): array
    {
        $product = $this->productRepository->find($id);
        return [
            'metadata' => [
                'title' => $product->getTitle() . ' | Apģērbi.lv',
                'metaTitle' => $product->getTitle() . ' | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'product' => $product,
        ];
    }

    public function getHomeData(): array
    {
        return [
            'metadata' => [
                'title' => 'Apģērbi.lv',
                'metaTitle' => 'Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'images' => [
                'mob' => '/images/mob/home-hero.jpg',
                'desk' => '/images/desk/home-hero.jpg',
            ],
            'newProducts' => $this->productRepository->findNewProducts(),
            'popularProducts' => $this->productRepository->findPopularProducts(),
            'productsWithDiscounts' => $this->productRepository->findProductsWithDiscounts(),
        ];
    }

    public function getCatalogueData(?string $selectedCategory = null, int $page = 1): array
    {
        $itemsPerPage = 10;
        $categories = $this->productCategoryRepository->findAll();
        $productsCount = $this->productRepository->findProductsByCategoryCount($selectedCategory);

        $hasPrevPage = $page > 1;
        $hasCurrentPage = (($page - 1) * $itemsPerPage) < $productsCount;
        $hasNextPage = ($page * $itemsPerPage) < $productsCount;

        if ($selectedCategory) {
            if (!$hasCurrentPage) {
                return $this->redirectToRoute('catalogue', ['page' => 1, 'category' => $selectedCategory]);
            }
            $products = $this->productRepository->findProductsByCategory($selectedCategory, $page);
        } else {
            $products = $this->productRepository->findProducts($page);
        }

        $prevPageData = $hasPrevPage ? ['page' => $page - 1, 'category' => $selectedCategory] : null;
        $nextPageData = $hasNextPage ? ['page' => $page + 1, 'category' => $selectedCategory] : null;

        return [
            'metadata' => [
                'title' => 'Katalogs | Apģērbi.lv',
                'metaTitle' => 'Katalogs | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'itemsPerPage' => $itemsPerPage,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'productsCount' => $productsCount,
            'hasCurrentPage' => $hasCurrentPage,
            'hasNextPage' => $hasNextPage,
            'products' => $products,
            'page' => $page,
            'prevPageData' => $prevPageData,
            'nextPageData' => $nextPageData,
        ];
    }

    public function addToCart(int $productId): array
    {
        $product = $this->productRepository->find($productId);
        $order = $this->orderRepository->getCurrentOrder() ?? $this->orderRepository->createNewOrder();

        $orderItem = $this->orderItemRepository->createNewOrderItem($product, $order);
        $order->addOrderItem($orderItem);

        $this->orderItemRepository->save($orderItem);
        $this->orderRepository->save($order);

        return [
            'type' => 'success',
            'message' => 'Produkts pievienots grozam!',
        ];
    }

    public function getCartData(): array
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            $order = $this->orderRepository->createNewOrder();
        }

        return [
            'metadata' => [
                'title' => 'Grozs | Apģērbi.lv',
                'metaTitle' => 'Grozs | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'order' => $order,
        ];
    }

    public function updateCartItem(int $cartItemId, int $amount): array
    {
        $orderItem = $this->orderItemRepository->find($cartItemId);
        $orderItem->setAmount($amount);

        $this->orderItemRepository->save($orderItem);

        return [
            'type' => 'success',
            'message' => 'Groza vienums atjaunots!',
        ];
    }

    public function removeCartItem(int $cartItemId): array
    {
        $orderItem = $this->orderItemRepository->find($cartItemId);
        $this->orderItemRepository->remove($orderItem);

        return [
            'type' => 'success',
            'message' => 'Groza vienums dzēsts!',
        ];
    }

    public function getCheckoutData(): array
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            $order = $this->orderRepository->createNewOrder();
        }

        return [
            'metadata' => [
                'title' => 'Pirkuma noformēšana | Apģērbi.lv',
                'metaTitle' => 'Pirkuma noformēšana | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'order' => $order,
        ];
    }

    public function makePayment(): array|false
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            return false;
        }

        $order->setStatus(Order::STATUS_COMPLETED);
        $this->orderRepository->save($order);

        sleep(3);

        return [
            'type' => 'success',
            'message' => 'Pirkums veiksmīgi noformēts!',
        ];
    }
}