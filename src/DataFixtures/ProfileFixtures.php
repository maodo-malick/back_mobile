<?php

namespace App\DataFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;

class ProfileFixtures extends Fixture
{
    public const PROFILE_REFERENCE = 'PROFILE';
    
    public function load(ObjectManager $manager)
    {
        $profiles = ["AdminSystem","AdminAgence","Caissier","UserAgence"] ;
        
        for ($i=0; $i < count($profiles); $i++) { 
            $profile =  new Profile();
            $profile->setLibelle($profiles[$i]) ;
            $manager->persist($profile);
            
        }
        $manager->flush();
        $this->addReference(self::PROFILE_REFERENCE, $profiles);
    }
}
