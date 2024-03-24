<?php

namespace App\DataFixtures;

use App\Entity\Cidadao;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CidadaoFixture extends Fixture {

    private $faker;

    public function __construct() {

        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getCidadao());
        }
        $manager->flush();
    }

    private function getCidadao() {

        return new Cidadao(
            $this->faker->numberBetween(10000000000, 99999999999),
            $this->faker->name()
        );
    }
}