<?php

namespace App\Controller;

use App\Repository\ShopCategoryRepository;
use App\Repository\ShopItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop')]
class ShopController extends AbstractController
{
    private ShopCategoryRepository $shopCategoryRepository;

    public function __construct(ShopCategoryRepository $shopCategoryRepository)
    {
        $this->shopCategoryRepository = $shopCategoryRepository;
    }

    private function getCategories(): array
    {
        return $this->shopCategoryRepository->findBy([], ['position' => 1]);
    }

    #[Route('', name: 'shop')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig', [
            'categories' => $this->getCategories()
        ]);
    }

    #[Route('/item/{slug}', name: 'shop_item')]
    public function item(string $slug, ShopItemRepository $shopItemRepository): Response
    {
        return new Response();
    }

    #[Route('/category/{slug}', name: 'shop_category')]
    public function category(string $slug, ShopItemRepository $shopItemRepository): Response
    {
        return $this->render('shop/category.html.twig', [
            'categories' => $this->getCategories()
        ]);
    }

}