<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Categories;
use App\Entity\User;
use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager=$entityManager;
    }

    //to load the fixtures run:
    //php bin/console doctrine:fixtures:load --append
    public function load(ObjectManager $manager)
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $categoryRepository = $this->entityManager->getRepository(Categories::class);
        for ($i = 0; $i < 20; $i++) {
            $blogPost = new Blog();
            $blogPost->setUser($userRepository->find(mt_rand(1,count($userRepository->findAll()))))
                ->setTitle('Blogpost '.$i)
                ->setText('Test Blog')
                ->setCategory($categoryRepository->find(mt_rand(1,count($categoryRepository->findAll()))))
                ->setPrivat(mt_rand(0,1))
                ->setDateAdded((new DateTime())->sub(new DateInterval('P'.mt_rand(10,100).'D')))
                ->setDateChanged((new DateTime())->sub(new DateInterval('P'.mt_rand(0,10).'D')));
            $manager->persist($blogPost);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
