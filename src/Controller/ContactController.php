<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        if ($this->getUser()) {
            $contact->setName($this->getUser()->getName())
                ->setFirstname($this->getUser()->getFirstname())
                ->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            //email
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('admin@AgenceImmoFictive.com')
                ->subject($contact->getSubject())
                ->html("<h1> Message de {$contact->getName()} {$contact->getFirstname()} </h1>" . "<p> Email : {$contact->getEmail()} </p>" . "<p> Objet : {$contact->getSubject()} </p>" . "<p> Message : {$contact->getMessage()} </p>");

            $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
            $mailer = new Mailer($transport);

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre message nous à été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
