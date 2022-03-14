<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'username' => 'user1',
                'email' => 'user1@bilemo.com',
                'full_name' => 'user1 Bilemo SFR'
            ],
            [
                'username' => 'user2',
                'email' => 'user2@bilemo.com',
                'full_name' => 'user2 Bilemo SFR'
            ],
            [
                'username' => 'user3',
                'email' => 'user3@bilemo.com',
                'full_name' => 'user3 Bilemo SFR'
            ],
            [
                'username' => 'user4',
                'email' => 'user4@bilemo.com',
                'full_name' => 'user4 Bilemo SFR'
            ],
            [
                'username' => 'user5',
                'email' => 'user5@bilemo.com',
                'full_name' => 'user5 Bilemo SFR'
            ],
            [
                'username' => 'user6',
                'email' => 'user6@bilemo.com',
                'full_name' => 'user6 Bilemo SFR'
            ],
        ];
        foreach ($users as $data) {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setFull_name($data['full_name']);
            $user->setClient($this->getReference(ClientsFixtures::CLIENT_SFR));
            /* $data->setRoles(array('ROLE_USER')); */
            $manager->persist($user);

            $manager->flush();
        }
    }
}
