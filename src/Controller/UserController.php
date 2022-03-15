<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class UserController extends AbstractController
{


    /**
     * @Route("/api/users", name="user_create", methods = {"POST"})
     * 
     */

    public function create(Request $request, EntityManagerInterface $manager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {

        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $data = $serializer->serialize($errors, 'json');
            return new JsonResponse($data, 400, [], true);
        }
        $client = $this->get('security.token_storage')->getToken()->getUser();

        $client->getId();
        $user->setClient($client);

        $manager->persist($user);
        $manager->flush();
        $data = $serializer->serialize($user, 'json', SerializationContext::create()->setGroups(array('Default')));
        return new JsonResponse($data, Response::HTTP_CREATED, [], true);
    }
}
