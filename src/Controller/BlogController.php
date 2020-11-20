<?php


namespace App\Controller;


use App\Entity\Blog;
use App\Entity\Categories;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/new",name="blog_new")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(EntityManagerInterface $entityManager)
    {
        $userRepository = $entityManager->getRepository(User::class);
        /* @var User[] $usersObject */
        $usersObject=$userRepository->findAll();
        $k=0;
        foreach ($usersObject as $user){
            $users[$k]=
                [
                    'id'=>$user->getId(),
                    'fname'=>$user->getFname(),
                    'lname'=>$user->getLname()
                ];
            $k++;
        }if (!isset($users))$users='';

        //Categories
        $categoryRepository = $entityManager->getRepository(Categories::class);
        $categoryObject=$categoryRepository->findAll();
        $k=0;
        foreach ($categoryObject as $category){
            $categories[$k]=['name'=>$category->getName(),'id'=>$category->getId()];
            $k++;
        }
        if (!isset($categories))$categories='-';

        if(!empty($_REQUEST)) {
            if (isset($_REQUEST["privat"]))
                $privat=true;
            else
                $privat=false;

            $blog = new Blog();
            $blog->setUser($userRepository->find($_REQUEST["user"]))
                ->setTitle($_REQUEST["title"])
                ->setText($_REQUEST["text"])
                ->setCategory($_REQUEST["category"])
                ->setCategory($categoryRepository->find($_REQUEST["category"]))
                ->setPrivat($privat)
                ->setDateAdded(new DateTime())
                ->setDateChanged(new DateTime());
            $entityManager->persist($blog);
            $entityManager->flush();
        }

        return $this->render(
            'blog/blogInput.twig', ['users'=>$users,'categories'=>$categories]
        );
    }


    /**
     * @Route("/blog/show",name="blog_show")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function show(EntityManagerInterface $entityManager)
    {
        $blogRepository = $entityManager->getRepository(Blog::class);
        $blogObject=$blogRepository->findAll();
        $k=0;

        foreach ($blogObject as $blog){
            $user=['fname'=>$blog->getUser()->getFname(),'lname'=>$blog->getUser()->getLname()];
            $blogs[$k]=[
                'id'=> $blog->getId(),
                'title' => $blog->getTitle(),
                'category' => $blog->getCategory()->getName(),
                'text' => $blog->getText(),
                'privat' => $blog->getPrivat(),
                'dateAdded' => $blog->getDateAdded(),
                'dateChanged' => $blog->getDateChanged(),
                'user'=>$user
            ];
            $k++;
        }
        if (empty($blogs)){
            return $this->render('blog/blogOutput.twig', ['blogs'=>'']);
        }else{
            return $this->render('blog/blogOutput.twig', ['blogs'=>$blogs]);
        }
    }

    /**
     * @Route ("/blog/recent", name="blog_recent")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function recent(EntityManagerInterface $entityManager):Response
    {

        $blogRepository = $entityManager->getRepository(Blog::class);
        $blogObject=$blogRepository->findRecentChanged(3);
        $k=0;
        foreach ($blogObject as $blog){
            $user=['fname'=>$blog->getUser()->getFname(),'lname'=>$blog->getUser()->getLname()];
            $blogs[$k]=[
                'id'=> $blog->getId(),
                'title' => $blog->getTitle(),
                'category' => $blog->getCategory()->getName(),
                'text' => $blog->getText(),
                'privat' => $blog->getPrivat(),
                'dateAdded' => $blog->getDateAdded(),
                'dateChanged' => $blog->getDateChanged(),
                'user'=>$user
            ];
            $k++;
        }

        if (empty($blogs)){
            return $this->render('blog/blogOutput.twig', ['blogs'=>'']);
        }else{
            return $this->render('blog/blogOutput.twig', ['blogs'=>$blogs]);
        }
    }

    /**
     * @Route("/blog/change/{blogId}",name="blog_change")
     * @param EntityManagerInterface $entityManager
     * @param $blogId
     * @return Response
     */
    public function change(EntityManagerInterface $entityManager, $blogId)
    {

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $blogRepository = $entityManager->getRepository(Blog::class);
        $categoryRepository = $entityManager->getRepository(Categories::class);
        $blog = $blogRepository->find($blogId);

        if (!empty($_REQUEST)){
            $blog->setTitle($_REQUEST["title"])
                ->setText($_REQUEST["text"])
                ->setCategory($categoryRepository->find($_REQUEST["category"]))
                ->setPrivat(isset($_REQUEST["privat"]))
                ->setDateChanged(new DateTime());
            $entityManager->persist($blog);
            $entityManager->flush();
            $blogChanged=true;
        }else
            $blogChanged=false;

        //combine all information's
        $blog=[
            'userId' => $blog->getUser()->getId(),
            'fname' => $blog->getUser()->getFname(),
            'lname' => $blog->getUser()->getLname(),
            'title' => $propertyAccessor->getValue($blog, 'title'),
            'category' => $blog->getCategory(),
            'text' => $propertyAccessor->getValue($blog, 'text'),
            'privat' => $propertyAccessor->getValue($blog, 'privat'),
            'dateAdded' => $propertyAccessor->getValue($blog, 'dateAdded'),
            'dateChanged' => $propertyAccessor->getValue($blog, 'dateChanged')
        ];
        //Categories
        $categoryObject=$categoryRepository->findAll();
        $k=0;
        foreach ($categoryObject as $category){
            $categories[$k]=['name'=>$category->getName(),'id'=>$category->getId()];
            $k++;
        }
        if (!isset($categories))$categories='-';

        return $this->render('blog/blogChange.twig',
            ['blogId'=>$blogId,'blog'=>$blog,'categories'=>$categories,'changed'=>$blogChanged]);
    }
}