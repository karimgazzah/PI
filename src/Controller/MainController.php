<?php

namespace App\Controller;

use App\Entity\Lawyer;
use App\Form\LawyerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class MainController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $lawyers = $this->em->getRepository(Lawyer::class)->findAll();

        return $this->render('main/admin.html.twig', [
            'lawyers' => $lawyers, // Fixed typo from 'laywers' to 'lawyers'
        ]);
    }

    #[Route('/signup_lawyer', name: 'signup_lawyer')]
    public function lawyer(Request $request)
    {
        $lawyer = new Lawyer();
        $form = $this->createForm(LawyerType::class, $lawyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($lawyer);
            $this->em->flush();

            $this->addFlash('message', 'Inserted successfully');
            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // New route for editing a lawyer
    #[Route('/edit_lawyer/{id}', name: 'edit_lawyer')]
    public function editLawyer(Request $request, int $id): Response
    {
        $lawyer = $this->em->getRepository(Lawyer::class)->find($id);

        if (!$lawyer) {
            $this->addFlash('message', 'Lawyer not found.');
            return $this->redirectToRoute('app_main');
        }

        $form = $this->createForm(LawyerType::class, $lawyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('message', 'Lawyer updated successfully!');
            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/edit_lawyer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // New route for deleting a lawyer
    #[Route('/delete_lawyer/{id}', name: 'delete_lawyer')]
    public function deleteLawyer(int $id): Response
    {
        $lawyer = $this->em->getRepository(Lawyer::class)->find($id);

        if ($lawyer) {
            $this->em->remove($lawyer);
            $this->em->flush();

            $this->addFlash('message', 'Lawyer deleted successfully!');
        } else {
            $this->addFlash('message', 'Lawyer not found.');
        }

        return $this->redirectToRoute('app_main');
    }
}
