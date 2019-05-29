<?php

namespace App\Controller;

use App\Entity\Dimensions;
use App\Form\DimensionsType;
use App\Repository\DimensionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manager/dimensions")
 */
class DimensionsController extends AbstractController
{
    /**
     * @Route("/", name="dimensions_index", methods="GET")
     */
    public function index(DimensionsRepository $dimensionsRepository): Response
    {
        return $this->render('dimensions/index.html.twig', ['dimensions' => $dimensionsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="dimensions_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $dimension = new Dimensions();
        $form = $this->createForm(DimensionsType::class, $dimension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dimension);
            $em->flush();

            return $this->redirectToRoute('dimensions_index');
        }

        return $this->render('dimensions/new.html.twig', [
            'dimension' => $dimension,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dimensions_show", methods="GET")
     */
    public function show(Dimensions $dimension): Response
    {
        return $this->render('dimensions/show.html.twig', ['dimension' => $dimension]);
    }

    /**
     * @Route("/{id}/edit", name="dimensions_edit", methods="GET|POST")
     */
    public function edit(Request $request, Dimensions $dimension): Response
    {
        $form = $this->createForm(DimensionsType::class, $dimension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dimensions_edit', ['id' => $dimension->getId()]);
        }

        return $this->render('dimensions/edit.html.twig', [
            'dimension' => $dimension,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dimensions_delete", methods="DELETE")
     */
    public function delete(Request $request, Dimensions $dimension): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dimension->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dimension);
            $em->flush();
        }

        return $this->redirectToRoute('dimensions_index');
    }
}
