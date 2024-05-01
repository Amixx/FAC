<?php

namespace App\Controller;

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

    public function __construct(ProductRepository $productRepository, ProductCategoryRepository $productCategoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->productCategoryRepository = $productCategoryRepository;
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
                'title' => 'Apģērbi.lv',
                'metaTitle' => 'Apģērbi.lv',
                'metaDescription' => 'lorem ipsum dolor sit amet',
                'metaKeywords' => 'lorem ipsum dolor sit amet',
            ],
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }
}