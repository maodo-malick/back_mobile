<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AgencyFixtures extends Fixture
{
    public const AGENCY_REFERENCE = 'AGENCY';
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i <5 ; $i++) { 
            $faker = Factory::create('fr_FR') ;
            $agency = new Agency() ;
            # code...
            $agency ->setNomAgence($faker->name);
            $agency ->setAdresse($faker->address);
            $agency->setStatus(false) ;
            $manager->persist($agency);
            $manager->flush();
        }
        $this->addReference(self::AGENCY_REFERENCE, $agency);
    }
}
