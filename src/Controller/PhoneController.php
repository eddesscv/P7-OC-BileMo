<?php

namespace App\Controller;

use App\Entity\Phone;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhoneController extends AbstractController
{
    /**
     * @Route("/phone", name="phone")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PhoneController.php',
        ]);
    }

    /**
     * @Route("/phones/{id}", name="phone_show")
     */
    public function showAction(SerializerInterface $serialize, Phone $phone)
    {

        $data = $serialize->serialize($phone, 'json');


        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/phones", name="phone_create")
     * @method ({"POST"})
     */
    public function createAction(Request $request, SerializerInterface $serialize)
    {
        $data = $request->getContent();
        $phone = $serialize->deserialize($data, 'App\Entity\Phone', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($phone);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/phones_list", name="phone_list")
     * @method ({"GET"})
     */
    public function listAction(SerializerInterface $serialize)
    {
        $phones = $this->getDoctrine()->getRepository('App:Phone')->findAll();
        /* $data = $this->get('jms_serializer')->serialize($phones, 'json'); */
        $data = $serialize->serialize($phones, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
