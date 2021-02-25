<?php

namespace App\DataFixtures;

use App\Entity\Depot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DepotFixture extends Fixture
{
    public const DEPOT_REFERENCE = 'DEPOT';
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i <10 ; $i++) { 
            # code...
            $faker = Factory::create('fr_FR') ;
            $depot = new Depot();
            $depot ->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $depot ->setCompteCibler($this->getReference(AccountFixtures::ACCOUNT_REFERENCE));
            $depot->setDateDepot($faker->date_time_this_year());
            $depot->setMontantDepot($faker->randomNumber());
            $manager->persist($depot);
            $manager->flush();
        }
        $this->addReference(self::DEPOT_REFERENCE, $depot);
       
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            AccountFixtures::class
        );
    }
}
