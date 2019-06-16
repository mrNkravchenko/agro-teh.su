<?php

namespace App\Controller;

use App\Entity\SpareParts;
use App\Form\SparePartsType;
use App\Repository\SparePartsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="spare_parts")
 */
class SparePartsController extends AbstractController
{
    /**
     * @Route("/manager/spare/parts", name="_index", methods="GET")
     */
    public function index(SparePartsRepository $sparePartsRepository): Response
    {
        return $this->render('spare_parts/index.html.twig', ['spare_parts' => $sparePartsRepository->findAll()]);
    }

    /**
     * @Route("/spare-parts", name="_show_all", methods="GET")
     */
    public function showAll(SparePartsRepository $sparePartsRepository): Response
    {
        return $this->render('spare_parts/spare_parts.html.twig', ['spare_parts' => $sparePartsRepository->findAll()]);
    }

    /**
     * @Route("/manager/spare/parts/new", name="_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $sparePart = new SpareParts();
        $form = $this->createForm(SparePartsType::class, $sparePart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sparePart);
            $em->flush();

            return $this->redirectToRoute('spare_parts_index');
        }

        return $this->render('spare_parts/new.html.twig', [
            'spare_part' => $sparePart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/spare/parts/{id}", name="_show", methods="GET")
     */
    public function show(SpareParts $sparePart): Response
    {
        return $this->render('spare_parts/show.html.twig', ['spare_part' => $sparePart]);
    }

    /**
     * @Route("/manager/spare/parts/{id}/edit", name="_edit", methods="GET|POST")
     * @param Request $request
     * @param SpareParts $sparePart
     * @return Response
     */
    public function edit(Request $request, SpareParts $sparePart): Response
    {
        $form = $this->createForm(SparePartsType::class, $sparePart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spare_parts_edit', ['id' => $sparePart->getId()]);
        }

        return $this->render('spare_parts/edit.html.twig', [
            'spare_part' => $sparePart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/spare/parts/{id}", name="_delete", methods="DELETE")
     */
    public function delete(Request $request, SpareParts $sparePart): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sparePart->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sparePart);
            $em->flush();
        }

        return $this->redirectToRoute('spare_parts_index');
    }
}
