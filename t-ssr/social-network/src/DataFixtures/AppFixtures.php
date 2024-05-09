<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\PostLike;
use App\Entity\User;
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
        $users = [];
        for ($i = 0; $i < 20; $i++) {
            $users[$i] = new User();
            $users[$i]->setEmail($this->faker->email);
            $users[$i]->setFullName($this->faker->name);
            $users[$i]->setBiography($this->faker->text);
            $users[$i]->setPhoneNumber($this->faker->phoneNumber);
            $users[$i]->setPhysicalAddress($this->faker->address);
            $users[$i]->setWorkplace($this->faker->jobTitle);
            $users[$i]->setWebsite($this->faker->url);
            $users[$i]->setAvatar('https://picsum.photos/200?random=' . $i);
            $users[$i]->setCreatedAt();
            $manager->persist($users[$i]);
        }

        $manager->flush();

        $posts = [];
        for ($i = 0; $i < 500; $i++) {
            $posts[$i] = new Post();
            $posts[$i]->setContent($this->faker->paragraphs(rand(1, 4), true));
            $posts[$i]->setAuthor($this->faker->randomElement($users));
            $posts[$i]->setCreatedAt();
            $manager->persist($posts[$i]);
        }

        $manager->flush();

        for ($i = 0; $i < 2000; $i++) {
            $postLike = new PostLike();
            $postLike->setAuthor($this->faker->randomElement($users));
            $postLike->setPost($this->faker->randomElement($posts));
            $postLike->setCreatedAt();
            $manager->persist($postLike);
        }

        $manager->flush();
    }
}