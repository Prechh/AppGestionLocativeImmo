<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyUserController extends AbstractController
{
    #[Route('/property/user', name: 'app_property_user', methods: ['GET'])]
    public function index(PropertyRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $properties = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            16
        );

        return $this->render('property_user/propertyUser.html.twig', [
            'properties' => $properties,
        ]);
    }

    #[Route('/property/user/show/{id}', 'app_property_user_show',  methods: ['GET'])]
    public function show(Property $property): Response
    {
        return $this->render('property_user/show.html.twig', [
            'property' => $property
        ]);
    }
}
