<?php

namespace App\Controller;

use App\Document\ShopOrderItem;
use App\Form\AddToCartType;
use App\Manager\OrderManager;
use App\Repository\ShopCategoryRepository;
use App\Repository\ShopItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop')]
class ShopController extends AbstractController
{
    private ShopCategoryRepository $shopCategoryRepository;
    private OrderManager $orderManager;

    public function __construct(ShopCategoryRepository $shopCategoryRepository, OrderManager $orderManager)
    {
        $this->shopCategoryRepository = $shopCategoryRepository;
        $this->orderManager = $orderManager;
    }

    private function getCategories(): array
    {
        return $this->shopCategoryRepository->findBy([], ['position' => 1]);
    }

    #[Route('', name: 'shop')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig', [
            'categories' => $this->getCategories(),
            'order' => $this->orderManager->getCurrent()
        ]);
    }

    #[Route('/item/{slug}', name: 'shop_item')]
    public function item(string $slug, Request $request, ShopItemRepository $shopItemRepository): Response
    {
        $item = $shopItemRepository->getBySlug($slug);
        if (!$item)
            return $this->redirectToRoute('shop');

        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ShopOrderItem $orderItem */
            $orderItem = $form->getData();
            $orderItem->setItem($item);
            $this->orderManager->saveOrderItem($orderItem);

            $cart = $this->orderManager->getCurrent();
            $cart->addItem($orderItem);
            $this->orderManager->save($cart);

            $this->addFlash('success', ['Ajouté au panier', 'L\'article ' . $item->getName() . ' a bien été ajouté à votre panier. Continuez vos achats ou rendez-vous sur la page de paiement !']);
        }

        return $this->render('shop/item.html.twig', [
            'categories' => $this->getCategories(),
            'order' => $this->orderManager->getCurrent(),
            'item' => $shopItemRepository->getBySlug($slug),
            'form' => $form->createView()
        ]);
    }

    #[Route('/category/{slug}', name: 'shop_category')]
    public function category(string $slug, ShopItemRepository $shopItemRepository): Response
    {
        return $this->render('shop/category.html.twig', [
            'categories' => $this->getCategories(),
            'order' => $this->orderManager->getCurrent(),
            'items' => $shopItemRepository->getByCategorySlug($slug)
        ]);
    }

    #[Route('/checkout', name: 'shop_checkout')]
    public function checkout(): Response
    {
        return $this->render('shop/checkout.html.twig', [
            'categories' => $this->getCategories(),
            'order' => $this->orderManager->getCurrent()
        ]);
    }

}