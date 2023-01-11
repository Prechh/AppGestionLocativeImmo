<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyFormType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    #[Route('/property', name: 'app_property', methods: ['GET'])]
    public function index(PropertyRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $propertys = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10
        );

        return $this->render('property/property.html.twig', [
            'propertys' => $propertys
        ]);
    }

    #[Route('/property/new', name: 'app_property_new',  methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyFormType::class, $property);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $property = $form->getData();

            $manager->persist($property);
            $manager->flush();

            $this->addFlash(
                'success',
                'La propriétée à été ajoutée avec succès !'
            );

            return $this->redirectToRoute('app_property');
        }

        return $this->render('property/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
