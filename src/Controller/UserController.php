<?php


namespace App\Controller;


use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/user/new",name="user_new")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(EntityManagerInterface $entityManager)
    {
        if (!empty($_REQUEST["fname"])) {
            $user = new User();
            $user->setFname($_REQUEST["fname"])
                ->setLname($_REQUEST["lname"])
                ->setDateAdded(new DateTime())
                ->setDateChanged(new DateTime());
            $entityManager->persist($user);
            $entityManager->flush();

            $addedUser='Well hallo! The shiny new user is: Id #'.$user->getId().', 
            with the name: '.$user->getFname().', '.$user->getLname();
        }
        if (empty($addedUser))
            return $this->render('blog/userInput.twig', ['returnMessage'=>'']);
        else
            return $this->render('blog/userInput.twig', ['returnMessage'=>$addedUser]);
    }


    /**
     * @Route("/user/show",name="user_show")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function show(EntityManagerInterface $entityManager)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $userRepository = $entityManager->getRepository(User::class);
        $usersObject=$userRepository->findAll();
        $k=0;
        foreach ($usersObject as $user){
            $users[$k]=
                [
                    'id'=>$propertyAccessor->getValue($user, 'id'),
                    'fname'=>$propertyAccessor->getValue($user, 'fname'),
                    'lname'=>$propertyAccessor->getValue($user, 'lname'),
                    'dateAdded'=>$propertyAccessor->getValue($user, 'dateAdded'),
                    'dateChanged'=>$propertyAccessor->getValue($user, 'dateChanged')
                ];
            $k++;
        }

        if (empty($users))
            return $this->render('blog/userOutput.twig', ['users'=>'']);
        else
            return $this->render('blog/userOutput.twig', ['users'=>$users]);
    }
}