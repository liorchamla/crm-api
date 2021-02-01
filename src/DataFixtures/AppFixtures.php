<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Customer;
use App\Entity\Invoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($c = 0; $c < 100; $c++) {
            $customer = new Customer;
            $customer->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($faker->email);

            $manager->persist($customer);

            for ($i = 0; $i < mt_rand(5, 10); $i++) {
                $invoice = new Invoice;
                $invoice->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setAmount(mt_rand(2000, 200000))
                    ->setCustomer($customer)
                    ->setDescription($faker->catchPhrase);

                $manager->persist($invoice);
            }
        }

        for ($p = 0; $p < 40; $p++) {
            $post = new BlogPost;
            $post->setTitle($faker->catchPhrase)
                ->setContent($faker->sentences(6, true))
                ->setImage('https://placehold.it/400x400');

            $manager->persist($post);
        }

        $manager->flush();
    }
}
