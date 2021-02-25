<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;

class ProfileFixtures extends Fixture
{
    public const PROFILE_REFERENCE = 'PROFILE';
    
    public function load(ObjectManager $manager)
    {
        $profiles = ["Admin_System","Admin_Agence","Caissier","User_Agence"] ;
        // $product = new Product();*
        // $manager->persist($product);
        for ($i=0; $i < count($profiles); $i++) { 
            $profile = new Profile() ;
            $profile->setLibelle($profiles[$i]) ;
            # code...
            $manager->persist($profile);
            $manager->flush();
        }

        $this->addReference(self::PROFILE_REFERENCE, $profiles);
    }
}
