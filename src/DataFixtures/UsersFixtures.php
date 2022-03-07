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

        $data = new User();
        $data->setUsername('user1');
        $data->setEmail('user1@bilemo.com');
        $data->setFullName('user1 Bilemo');
        $data->setClient($this->getReference(ClientsFixtures::CLIENT_SFR));
        $data->setRoles(array('ROLE_USER'));
        $manager->persist($data);

        $manager->flush();
    }
}
