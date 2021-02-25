<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'USER';
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i=0; $i<10; $i++)
            {
                $faker = Factory::create('fr_FR') ;

                $user = new User() ;
                $user ->setEmail ($faker->email);
                $password = $this->encoder->encodePassword($user, 'passer') ;
                $user ->setFirstname($faker->name);
                $user ->setLastname($faker->lastName);
                // $user ->setPhone(223666);
                $user ->setAdresse($faker->address);
                $user->setArchiver(false) ;
                $user->setPassword($password) ;
                $user->setTelephon($faker->phone);
                $user->setProfile($this->getReference(ProfileFixtures::PROFILE_REFERENCE));
                $user->setAgency($this->getReference(AgencyFixtures::AGENCY_REFERENCE));
                
                $manager->persist($user);

                $manager->flush();
            }

            $this->addReference(self::USER_REFERENCE, $user);
    }
    public function getDependencies()
    {
        return array(
            ProfileFixtures::class,
            AgencyFixtures::class
        );
    }
}
