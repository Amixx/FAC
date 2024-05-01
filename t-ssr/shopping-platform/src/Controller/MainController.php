<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Service\DataService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig', $this->dataService->getHomeData());
    }

    #[Route('/catalogue/{page}', name: 'catalogue')]
    public function catalogue(Request $request, $page = 1): Response
    {
        $data = $this->dataService->getCatalogueData($request->get('category'), $page);
        return $this->render('main/catalogue.html.twig', [
            ...$data,
            'toNextPage' => $data['nextPageData'] ? $this->generateUrl('catalogue', $data['nextPageData']) : null,
            'toPrevPage' => $data['prevPageData'] ? $this->generateUrl('catalogue', $data['prevPageData']) : null,
        ]);
    }

    #[Route('/product/{id}', name: 'product')]
    public function product(int $id): Response
    {
        return $this->render('main/product.html.twig', $this->dataService->getProductData($id));
    }

    #[Route('/add-to-cart', name: 'add-to-cart', methods: ['POST'])]
    public function addToCart(Request $request): Response
    {
        $flash = $this->dataService->addToCart($request->request->get('productId'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('catalogue');
    }

    #[Route('cart', name: 'cart')]
    public function cart(): Response
    {
        return $this->render('main/cart.html.twig', $this->dataService->getCartData());
    }

    #[Route('update-cart-item', name: 'update-cart-item')]
    public function updateCartItem(Request $request): Response
    {
        $flash = $this->dataService->updateCartItem($request->request->get('cartItemId'), $request->request->get('amount'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('cart');
    }

    #[Route('remove-cart-item', name: 'remove-cart-item')]
    public function removeCartItem(Request $request): Response
    {
        $flash = $this->dataService->removeCartItem($request->request->get('cartItemId'));

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('cart');
    }

    #[Route('checkout', name: 'checkout')]
    public function checkout(): Response
    {
        return $this->render('main/checkout.html.twig', $this->dataService->getCheckoutData());
    }

    #[Route('make-payment', name: 'make-payment')]
    public function payment(): Response
    {
        $flash = $this->dataService->makePayment();

        if (!$flash) {
            return $this->redirectToRoute('home');
        }

        $this->addFlash($flash['type'], $flash['message']);

        return $this->redirectToRoute('home');
    }
}