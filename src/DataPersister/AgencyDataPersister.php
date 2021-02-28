<?php
namespace App\DataPersister;
use App\Entity\User;
use App\Entity\Agency;
use App\Entity\Account;
use App\Repository\AgencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;


final class AgencyDataPersister implements ContextAwareDataPersisterInterface
{
    private $manager;
    /**
     * @var AgencyRepository
     */
    private $agencyRepository;


    /**
     * ProfilPersisiter constructor.
     */
    public function __construct(EntityManagerInterface $manager, AgencyRepository $agencyRepository)
    {
        $this->manager = $manager ;
        $this->agencyRepository = $agencyRepository ;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Agency;
    }

    public function persist($data, array $context = [])
    {
        if (isset($context["collection_operation_name"])) {
            # code...
        
        if ($data instanceof Agency) {
            if ($data->getNomAgence()&& $data->getAdresse()) {
                $account= new Account();
                $account->setSolde(700000)
                        ->setNumeroCompte(rand(0,123456789))
                        ->setCreatAt(new \DateTime());
                $this->manager->persist($account);
                $data->setStatus(false)
                     ->setAccount($account);
                     $this->manager->persist($data);
                     $this->manager->flush();
                    //  return $this->json(["votre agence a été  ajouter avec  success"], Response::HTTP_OK);
                     return new JsonResponse("votre agence a été  ajouter avec  success", Response::HTTP_OK, [], true);
            }
            # code...
            return new JsonResponse("Revoyez les données que vous avez saisie", Response::HTTP_BAD_REQUEST, [], true);

        }
    }
    else {
        # code...
        $this->manager->persist($data);
        $this->manager->flush();
    }
   }
  
    public function remove($data, array $context = [])
    {
         

        $data->setStatus(true);
        $agency = $data->getUtilisateur();
        foreach($agency as $u)
            $u->setArchive(true);

        $this->entityManager->flush();
        return $data;
    

    }
}
