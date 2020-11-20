<?php


namespace App\Controller;


use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/new",name="category_new")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(EntityManagerInterface $entityManager)
    {
        $addedCategory='';
        if (!empty($_REQUEST["name"])) {
            $category = new Categories();
            $category->setName($_REQUEST["name"]);
            $entityManager->persist($category);
            $entityManager->flush();
            $addedCategory='You have added the new category: '.$category->getName();
        }
        return $this->render(
            'blog/categoryInput.twig', ['returnMessage'=>$addedCategory]
        );
    }
}