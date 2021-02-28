<?php

namespace App\Controller;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\User;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    
    public function __construct(SerializerInterface $serializer, EntityManagerInterface $manager, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder,UserRepository $userRepository )
    {
        $this->serialize = $serializer ;
        $this->validator = $validator ;
        $this->encoder = $encoder ;
        $this->manager = $manager ;
        $this->userRepository = $userRepository;

    }
    /**
     * @Route(
     *      name="addUser" ,
     *      path="/api/admin/users" ,
     *     methods={"POST"} ,
     *     defaults={
     *     "__controller"="App\Controller\UserController::addUser",
     *         "_api_resource_class"=User::class,
     *         
     *     }
     *
     *)
    */
    public function addUser( Request $request) {

        //all data
        $user = $request->request->all() ;
        //get profil
        $profil = $user["profile"] ;

        //recupération de l'image
        $avatar = $request->files->get("avatar");
        //specify entity
        //$base64 = base64_decode($imagedata);
        $avatar = fopen($avatar->getRealPath(),"rb");
        $user["avatar"] = $avatar;
        $user = $this->serializer->denormalize($user, "App\Entity\User");
        $errors = $this->validator->validate($user);
        if (count($errors)){
            $errors = $this->serialize->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        $password = $user->getPassword();
        $user->setPassword($this->encoder->encodePassword($user,$password));
        $user->setArchivage(false);


        $user->setProfil($this->manager->getRepository(Profile::class)->findOneBy(['libelle'=>$profil])) ;

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->json("success",201);

    }
}
