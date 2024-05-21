<?php

namespace App\DataFixtures;

use App\Entity\Video;
use App\Entity\VideoLike;
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
            $users[$i]->setCreatedAt();
            $manager->persist($users[$i]);
        }

        $manager->flush();

        $youtubeIds = [
            'KJwYBJMSbPI',
            'RzVvThhjAKw',
            'BHACKCNDMW8',
            'KLuTLF3x9sA',
            'UV0mhY2Dxr0',
            'dVYl5ImNjow',
            '3176Sw8A0EE',
            '6stlCkUDG_s',
            'RK1RRVR9A2g',
            'HHBsvKnCkwI',
            'RvreULjnzFo',
            '_Sl8diqCAFw',
            'gsnqXt7d1mU',
            'a9MSluFIYyI',
            '4N8oOj_aue8',
            'CmCIZ_aUAeQ',
            'o-7fsuJtEhk',
            'eg2g6FPsdLI',
            'ZjbFDYoE-OY',
            'NpdQkEPELh4',
            'oe70Uhjc_F4',
            'B_ZxezFynEA',
            'IxF55qB4CuQ',
            'pavJSLjL964',
            'HccqokXN2n8'
        ];

        $videos = [];
        for ($i = 0; $i < 500; $i++) {
            $videos[$i] = new Video();
            $videos[$i]->setTitle($this->faker->sentence(3));
            $videos[$i]->setDescription($this->faker->paragraph(3));
            $videos[$i]->setYoutubeId($this->faker->randomElement($youtubeIds));
            $videos[$i]->setCreatedAt();
            $manager->persist($videos[$i]);
        }

        $manager->flush();
    }
}