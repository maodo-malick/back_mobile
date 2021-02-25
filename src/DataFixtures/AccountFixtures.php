<?php

namespace App\DataFixtures;

use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AccountFixtures extends Fixture
{
    public const ACCOUNT_REFERENCE = 'ACCOUNT';
    public function load(ObjectManager $manager)
    {
        
        for ($i=0; $i <10 ; $i++) { 
            # code...
            $faker = Factory::create('fr_FR') ;
            $account = new Account();
            $account ->setNumeroCompte($faker->randomNumber());
            $account->setSolde($faker->randomNumber());
            $account->setStatut(false);
            $account->setAgence($this->getReference(AgencyFixtures::AGENCY_REFERENCE));
            $manager->persist($account);
            $manager->flush();
        }
        $this->addReference(self::ACCOUNT_REFERENCE, $account);
       
    }
    public function getDependencies()
    {
        return array(
            AgencyFixtures::class,
        );
    }
}
