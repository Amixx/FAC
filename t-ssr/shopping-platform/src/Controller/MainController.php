<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
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

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig', [
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
        ]);
    }

    #[Route('/catalogue/{page}', name: 'catalogue')]
    public function catalogue(Request $request, $page = 1): Response
    {
        $categories = $this->productCategoryRepository->findAll();

        $selectedCategory = $request->get('category');
        if ($selectedCategory) {
            $products = $this->productRepository->findProductsByCategory($selectedCategory, $page);
        } else {
            $products = $this->productRepository->findProducts($page);
        }

        return $this->render('main/catalogue.html.twig', [
            'metadata' => [
                'title' => 'Katalogs | Apģērbi.lv',
                'metaTitle' => 'Katalogs | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    #[Route('/product/{id}', name: 'product')]
    public function product(int $id): Response
    {
        $product = $this->productRepository->find($id);

        return $this->render('main/product.html.twig', [
            'metadata' => [
                'title' => $product->getTitle() . ' | Apģērbi.lv',
                'metaTitle' => $product->getTitle() . ' | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'product' => $product,
        ]);
    }

    #[Route('/add-to-cart', name: 'add-to-cart', methods: ['POST'])]
    public function addToCart(Request $request): Response
    {
        $productId = $request->request->get('productId');

        $product = $this->productRepository->find($productId);
        $order = $this->orderRepository->getCurrentOrder() ?? $this->orderRepository->createNewOrder();

        $orderItem = $this->orderItemRepository->createNewOrderItem($product, $order);
        $order->addOrderItem($orderItem);

        $this->orderItemRepository->save($orderItem);
        $this->orderRepository->save($order);

        $this->addFlash('success', 'Produkts pievienots grozam!');

        return $this->redirectToRoute('catalogue');
    }

    #[Route('cart', name: 'cart')]
    public function cart(): Response
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            $order = $this->orderRepository->createNewOrder();
        }

        return $this->render('main/cart.html.twig', [
            'metadata' => [
                'title' => 'Grozs | Apģērbi.lv',
                'metaTitle' => 'Grozs | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'order' => $order,
        ]);
    }

    #[Route('update-cart-item', name: 'update-cart-item')]
    public function updateCartItem(Request $request): Response
    {
        $cartItemId = $request->request->get('cartItemId');
        $amount = $request->request->get('amount');

        $orderItem = $this->orderItemRepository->find($cartItemId);
        $orderItem->setAmount($amount);

        $this->orderItemRepository->save($orderItem);

        $this->addFlash('success', 'Groza vienums atjaunots!');

        return $this->redirectToRoute('cart');
    }

    #[Route('remove-cart-item', name: 'remove-cart-item')]
    public function removeCartItem(Request $request): Response
    {
        $cartItemId = $request->request->get('cartItemId');

        $orderItem = $this->orderItemRepository->find($cartItemId);
        $this->orderItemRepository->remove($orderItem);

        $this->addFlash('success', 'Groza vienums dzēsts!');

        return $this->redirectToRoute('cart');
    }

    #[Route('checkout', name: 'checkout')]
    public function checkout(): Response
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            $order = $this->orderRepository->createNewOrder();
        }

        return $this->render('main/checkout.html.twig', [
            'metadata' => [
                'title' => 'Pirkuma noformēšana | Apģērbi.lv',
                'metaTitle' => 'Pirkuma noformēšana | Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'order' => $order,
        ]);
    }

    #[Route('make-payment', name: 'make-payment')]
    public function payment(): Response
    {
        $order = $this->orderRepository->getCurrentOrder();
        if (!$order) {
            return $this->redirectToRoute('home');
        }

        $order->setStatus(Order::STATUS_COMPLETED);
        $this->orderRepository->save($order);

        $this->addFlash('success', 'Pirkums veiksmīgi noformēts!');

        sleep(3);

        return $this->redirectToRoute('home');
    }
}