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
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/users/{id}", name="user_show")
     */
    public function showAction(SerializerInterface $serialize, User $user)
    {

        $data = $serialize->serialize($user, 'json');


        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/users", name="user_create")
     * @method ({"POST"})
     */
    /* public function createAction(Request $request, SerializerInterface $serialize)
    {
        $data = $request->getContent();
        $user = $serialize->deserialize($data, 'App\Entity\User', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    } */
    /* public function createAction(User $user, UserPasswordEncoderInterface $passwordEncoder)
    {


        $actualUser = $this->getUser();
        $client = $actualUser->getClient();

        $em = $this->getDoctrine()->getManager();

        $user->setClient($client);
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            )
        );
        $em->persist($user);
        $em->flush();

        return $user;
    } */

    public function create(TokenStorageInterface $tokenStorage, Request $request, EntityManagerInterface $manager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {

        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $data = $serializer->serialize($errors, 'json');
            return new JsonResponse($data, 400, [], true);
        }
        // $client = $manager->getRepository(Client::class)->find($request->get('clientId'));
        // $client = $this->$tokenStorage->getToken()->getClient();
        $client = $this->get('security.token_storage')->getToken()->getUser();

        // $client = $this->container->get('security.token_storage')->getToken()->getClient();
        $client->getId();
        $user->setClient($client);

        $manager->persist($user);
        $manager->flush();
        $data = $serializer->serialize($user, 'json', SerializationContext::create()->setGroups(array('Default')));
        return new JsonResponse($data, Response::HTTP_CREATED, [], true);
    }


    /**
     * @Route("/api/usersz", name="user_list")
     * @method ({"GET"})
     */
    public function listAction(SerializerInterface $serialize)
    {
        $users = $this->getDoctrine()->getRepository('App:User')->findAll();
        $data = $serialize->serialize($users, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
