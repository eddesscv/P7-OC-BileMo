<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientsFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public const CLIENT_SFR = 'SFR';

    public function load(ObjectManager $manager)
    {

        $data = new Client();
        $data->setUsername('SFR');
        $data->setEmail('clientSFR@bilemo.com');
        $data->setName('ClientSFR Bilemo');
        $data->setPassword($this->passwordEncoder->encodePassword(
            $data,
            'Admin1@'
        ));
        $data->setRoles(array('ROLE_USER'));
        $this->addReference(self::CLIENT_SFR, $data);
        $manager->persist($data);

        $manager->flush();
    }
}
