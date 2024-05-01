<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class AppFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $category = new ProductCategory();
            $category->setName($this->faker->sentence(3));
            $manager->persist($category);
        }

        $manager->flush();

        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->setTitle($this->faker->sentence(3));
            $product->setDescription($this->faker->paragraph(3));
            $product->setImages([
                $this->faker->imageUrl(360, 360),
                $this->faker->imageUrl(360, 360),
                $this->faker->imageUrl(360, 360),
                $this->faker->imageUrl(360, 360),
            ]);
            $product->setPrice($this->faker->randomFloat(2, 0, 100));
            $product->setDiscount($this->faker->randomFloat(2, 0, 100));
            $product->setPopularity($this->faker->randomFloat(2, 0, 100));
            $product->setCategory($this->faker->randomElement($manager->getRepository(ProductCategory::class)->findAll()));

            $manager->persist($product);
        }

        $manager->flush();
    }
}