<?php

namespace App\Controller;

use App\Entity\Angar;
use App\Form\AngarType;
use App\Repository\AngarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/angary")
 */
class AngarController extends AbstractController
{
    /**
     * @Route("", name="angary", methods="GET")
     */
    public function index(AngarRepository $angarRepository): Response
    {
        return $this->render('angar/types/angary.html.twig');
    }
    /**
     * @Route("/postroennue", name="angar_show_all")
     */
    public function showAll(AngarRepository $angarRepository): Response
    {
        return $this->render('angar/postroennue.html.twig', ['angary' => $angarRepository->findAll()]);

    }

    /**
     * @Route("/new", name="angar_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $angar = new Angar();
        $form = $this->createForm(AngarType::class, $angar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($angar);
            $em->flush();

            return $this->redirectToRoute('angar_index');
        }

        return $this->render('angar/new.html.twig', [
            'angar' => $angar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="angar_show", methods="GET", requirements={"id" = "\d+"})
     */
    public function show(Angar $angar): Response
    {
        return $this->render('angar/angar.html.twig', ['angar' => $angar]);
    }

    /**
     * @Route("/{id}/edit", name="angar_edit", methods="GET|POST")
     */
    public function edit(Request $request, Angar $angar): Response
    {
        $form = $this->createForm(AngarType::class, $angar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('angar_edit', ['id' => $angar->getId()]);
        }

        return $this->render('angar/edit.html.twig', [
            'angar' => $angar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="angar_delete", methods="DELETE")
     */
    public function delete(Request $request, Angar $angar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$angar->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($angar);
            $em->flush();
        }

        return $this->redirectToRoute('angar_index');
    }

}
