<?php

namespace App\DataFixtures;

use App\Entity\Productp33;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\ProductP33Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ProductP33Factory::createOne();
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new ProductP33();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
