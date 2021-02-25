<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TransactionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $unixTimestamp = '1461067200';

        for($i=0; $i<10; $i++)
        {
            $faker = Factory::create('fr_FR') ;
    
            $transaction = new Transaction() ;
            $transaction ->setMontant ($faker->randomNumber());
            // $password = $this->encoder->encodePassword($transaction, 'passer') ;
            $transaction ->setDateDepot($faker->dateTime($unixTimestamp));
            $transaction ->setDateRetrait($faker->dateTime($unixTimestamp));
            // $transaction ->setPhone(223666);
             $transaction ->setDateAnnulation($faker->dateTime($unixTimestamp));
             $transaction->setTtc('3000') ;
            $transaction->setFraisEtat('5000') ;
            $transaction->setFraisSystem('4000');
            $transaction->setFraisEnvoie($faker->building_number());
            $transaction->setFraisRetrait($faker->building_number());
            $transaction->setCodeTransaction($faker->siren());
            $transaction->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $transaction->setCustomer($this->getReference(CustomerFixtures::CUSTOMER_REFERENCE));
            $transaction->setAccount($this->getReference(AccountFixtures::ACCOUNT_REFERENCE));
            $manager->persist($transaction);
    
            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            CustomerFixtures::class,
            AccountFixtures::class
        );
    }
}
