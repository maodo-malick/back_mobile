<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixtures extends Fixture
{
    public const CUSTOMER_REFERENCE = 'CUSTOMER';
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i <10 ; $i++) { 
            $faker = Factory::create('fr_FR') ;
            $customer = new Customer();   
            $customer ->setNomComplet($faker->name);
            $customer ->setCNI($faker->randomNumber());
            $customer->setTelephon($faker->phone) ;
            $manager->persist($customer);
                   # code...
            $manager->flush();
        }

        $this->addReference(self::CUSTOMER_REFERENCE, $customer);
    }
}
