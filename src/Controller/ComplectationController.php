<?php

namespace App\Controller;

use App\Entity\Complectation;
use App\Form\ComplectationType;
use App\Repository\ComplectationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/complectation")
 */
class ComplectationController extends AbstractController
{
    /**
     * @Route("/", name="complectation_index", methods="GET")
     */
    public function index(ComplectationRepository $complectationRepository): Response
    {
        return $this->render('complectation/index.html.twig', ['complectations' => $complectationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="complectation_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $complectation = new Complectation();
        $form = $this->createForm(ComplectationType::class, $complectation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($complectation);
            $em->flush();

            return $this->redirectToRoute('complectation_index');
        }

        return $this->render('complectation/new.html.twig', [
            'complectation' => $complectation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="complectation_show", methods="GET")
     */
    public function show(Complectation $complectation): Response
    {
        return $this->render('complectation/show.html.twig', ['complectation' => $complectation]);
    }

    /**
     * @Route("/{id}/edit", name="complectation_edit", methods="GET|POST")
     */
    public function edit(Request $request, Complectation $complectation): Response
    {
        $form = $this->createForm(ComplectationType::class, $complectation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('complectation_edit', ['id' => $complectation->getId()]);
        }

        return $this->render('complectation/edit.html.twig', [
            'complectation' => $complectation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="complectation_delete", methods="DELETE")
     */
    public function delete(Request $request, Complectation $complectation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$complectation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($complectation);
            $em->flush();
        }

        return $this->redirectToRoute('complectation_index');
    }
}
