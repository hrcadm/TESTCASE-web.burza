<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {

            $person = new Person();

            $person->setNickname('test-00-'.$faker->word);
            $person->setName($faker->firstName);
            $person->setSurname($faker->lastName);
            $person->setGender('M');
            $person->setIsGamer($faker->boolean);

            $manager->persist($person);
        }

    $manager->flush();

    }
}