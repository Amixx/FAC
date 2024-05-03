<?php

namespace App\DataFixtures;

use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\Entity\TodoItemCategory;
use App\Entity\TodoItem;
use App\Entity\SpentTime;

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
        // create 10 TodoItemCategory entities; 20 TodoItem entities and each TodoItem has a category
        // then create 40 SpentTime entities, with each TodoItem having between 0 and 4 spent times
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $categories[$i] = new TodoItemCategory();
            $categories[$i]->setName($this->faker->sentence(3));
            $categories[$i]->setColor($this->faker->colorName);
            $categories[$i]->setCreatedAt();
            $manager->persist($categories[$i]);
        }

        $manager->flush();

        $todoItems = [];
        for ($i = 0; $i < 20; $i++) {
            $todoItems[$i] = new TodoItem();
            $todoItems[$i]->setName($this->faker->sentence(3));
            $todoItems[$i]->setDeadline($this->faker->dateTimeBetween('-1 year', '+1 year'));
            $todoItems[$i]->setImportant($this->faker->boolean);
            $todoItems[$i]->setStatus($this->faker->randomElement([
                TodoItem::STATUS_TODO,
                TodoItem::STATUS_IN_PROGRESS,
                TodoItem::STATUS_DONE
            ]));
            $todoItems[$i]->setCreatedAt();
            $todoItems[$i]->setCategory($this->faker->randomElement($categories));
            $manager->persist($todoItems[$i]);
        }

        $manager->flush();

        for ($i = 0; $i < 40; $i++) {
            $spentTime = new SpentTime();
            $spentTime->setDuration($this->createRandomTimeInterval());
            $spentTime->setCreatedAt();
            $spentTime->setTodoItem($this->faker->randomElement($todoItems));
            $manager->persist($spentTime);
        }

        $manager->flush();
    }

    private function createRandomTimeInterval(): DateInterval
    {
        $randomDate1 = $this->faker->dateTimeBetween('+1 minute', '+1 day');
        $randomDate2 = $this->faker->dateTimeBetween('+1 minute', '+1 day');
        if ($randomDate1 > $randomDate2) {
            // swap dates
            $temp = $randomDate1;
            $randomDate1 = $randomDate2;
            $randomDate2 = $temp;
        }
        return $randomDate1->diff($randomDate2);
    }
}