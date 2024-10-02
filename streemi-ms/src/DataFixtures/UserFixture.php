<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Subscription;
use Faker\Factory;

class UserFixture extends Fixture
{
    private $users = [];
    private $subscriptions = [];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 6; $i <= 24; $i += 6) {
            $sub = new Subscription();
            $sub->setDurationInMonths($i);
            $sub->setPrice($i * 7);
            $sub->setName("Abonnement $i mois");

            $this->subscriptions[] = $sub;
            $manager->persist($sub);
        }

        for ($i = 0; $i < 500; $i++) {
            $user = new User();
            $user->setUsername($faker->name());
            $user->setEmail($faker->email());
            $user->setPassword(bin2hex(random_bytes(32)));

            $randomSubscription = $this->subscriptions[array_rand($this->subscriptions)];
            $user->addSubscription($randomSubscription);

            $this->users[] = $user;
            $manager->persist($user);
        }

        $user = new User();
        $user->setUsername('admin1');
        $user->setEmail('m.s@gmail.com');
        $user->setPassword('admin');
        $user->setAccountRole(Role::ADMIN);

        $sub = new Subscription();
        $sub->setDurationInMonths(1);
        $sub->setPrice(10);
        $sub->setName('Basic');

        $user->addSubscription($sub);

        $manager->persist($user);
        $manager->persist($sub);

        $manager->flush();
    }
    
}
