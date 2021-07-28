<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliment", name="admin_aliment")
     */
    public function index(AlimentRepository $repository): Response
    {
        $aliments = $repository->findAll();
        return $this->render('admin/admin_aliment/adminAliment.html.twig', [
            'aliments' => $aliments
        ]);
    }


    /**
     * @Route("/admin/aliment/creation", name="admin_aliment_creation" )
     * @Route("/admin/aliment/{id}", name="admin_aliment_modification", methods="GET|POST")
     */
    public function modifAjoutEtAliment(Aliment $aliment = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$aliment) {
            $aliment = new Aliment();
        }
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $modif = $aliment->getId() !== null;
            $entityManager->persist($aliment);
            $entityManager->flush();
            $this->addFlash("success", ($modif) ? "La modification à été effectuée" : "L'ajout à été effectuée");
            return $this->redirectToRoute("admin_aliment");
        }
        return $this->render('admin/admin_aliment/modifAjoutAliment.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
            'isModification' => $aliment->getId() !== null
        ]);
    }
    /**
     * @Route("/admin/aliment/{id}", name="admin_aliment_suppression", methods="delete")
     */
    public function suppression(Aliment $aliment, Request $request, EntityManagerInterface $objectManager)
    {
        if ($this->isCsrfTokenValid("SUP" . $aliment->getId(), $request->get('_token'))) {
            $objectManager->remove($aliment);
            $objectManager->flush();
            $this->addFlash("success", "La suppression à été effectuée");

            return $this->redirectToRoute("admin_aliment");
        }
    }
}