<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Productp33;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        for ($i = 1; $i <= 3; $i++) {
//            $category = new Category();
//            $category->setName('Категория '.$i);
//            $manager->persist($category);
//        }

        for ($i = 1; $i <= 10; $i++) {
            $product = new Productp33();
            $product->setTitle('Продукт ' . $i);
            $product->setName('Продукт ' . $i);
            $product->setPrice(mt_rand(100, 1000));
            $manager->persist($product);
        }
        $manager->flush();
    }
}