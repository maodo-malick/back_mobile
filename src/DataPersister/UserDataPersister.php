<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Profile;
use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

final class UserPersister implements ContextAwareDataPersisterInterface
{
    private $manager;
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * ProfilPersisiter constructor.
     */
    public function __construct(EntityManagerInterface $manager, UserRepository $userRepository)
    {
        $this->manager = $manager ;
        $this->userRepository = $userRepository ;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Profile;
    }

    public function persist($data, array $context = [])
    {
        // call your persistence layer to save $data

           $data->setLibelle($data->getLibelle()) ;
         $user = $this->manager->persist($data) ;
        $this->manager->flush($user);
        return $data;

    }

    public function remove($data, array $context = [])
    {
          $id = $data->getId() ;

           $users = $this->userRepository->findBy($id) ;


            $data->setArchiver(1) ;
            dd($data);
            $persist = $this->manager->persist($data);
            $this->manager->flush($persist);

            // foreach ($users as $value) {
            //     $value->setArchivage(1) ;
            //     $user = $this->manager->persist($value) ;
            //     $this->manager->flush($user);
            // }


    }
}
