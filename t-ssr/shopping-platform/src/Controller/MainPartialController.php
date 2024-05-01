<?php

namespace App\Controller;

use App\Service\DataService;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Request\HtmxRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainPartialController extends AbstractController
{
    use HtmxControllerTrait;

    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    #[Route('home-body', name: 'home_body')]
    public function homeBody(): HtmxResponse
    {
        return $this->htmxRender('main/home-body.html.twig', $this->dataService->getHomeData());
    }

    #[Route('catalogue-body/{page}', name: 'catalogue_body')]
    public function catalogueBody(HtmxRequest $request, $page = 1): HtmxResponse
    {
        $data = $this->dataService->getCatalogueData($request->get('category'), $page);

        return $this->htmxRender('main/catalogue-body.html.twig', [
            ...$data,
            'toNextPage' => $data['nextPageData'] ? $this->generateUrl('catalogue-products', $data['nextPageData']) : null,
            'toPrevPage' => $data['prevPageData'] ? $this->generateUrl('catalogue-products', $data['prevPageData']) : null,
        ]);
    }

    #[Route('catalogue-products/{page}', name: 'catalogue-products')]
    public function catalogueProducts(HtmxRequest $request, $page = 1): HtmxResponse
    {
        $data = $this->dataService->getCatalogueData($request->get('category'), $page);

        return $this->htmxRender('main/catalogue-products.html.twig', $data);
    }

    #[Route('product-body/{id}', name: 'product_body')]
    public function productBody(int $id): HtmxResponse
    {
        return $this->htmxRender('main/product-body.html.twig', $this->dataService->getProductData($id));
    }

    #[Route('cart-body', name: 'cart_body')]
    public function cartBody(): HtmxResponse
    {
        return $this->htmxRender('main/cart-body.html.twig', $this->dataService->getCartData());
    }

    #[Route('checkout-body', name: 'checkout_body')]
    public function checkoutBody(): HtmxResponse
    {
        return $this->htmxRender('main/checkout-body.html.twig', $this->dataService->getCheckoutData());
    }
}