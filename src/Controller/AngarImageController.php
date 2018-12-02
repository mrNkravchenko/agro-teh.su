<?php

namespace App\Controller;

use App\Entity\AngarImage;
use App\Form\AngarImageType;
use App\Repository\AngarImageRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/angar/image")
 */
class AngarImageController extends AbstractController
{
    /**
     * @Route("/", name="angar_image_index", methods="GET")
     */
    public function index(AngarImageRepository $angarImageRepository): Response
    {
        return $this->render('angar_image/index.html.twig', ['angar_images' => $angarImageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="angar_image_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $angarImage = new AngarImage();
        $form = $this->createForm(AngarImageType::class, $angarImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($angarImage);
            $em->flush();

            return $this->redirectToRoute('angar_image_index');
        }

        return $this->render('angar_image/new.html.twig', [
            'angar_image' => $angarImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="angar_image_show", methods="GET")
     */
    public function show(AngarImage $angarImage): Response
    {
        return $this->render('angar_image/show.html.twig', ['angar_image' => $angarImage]);
    }

    /**
     * @Route("/{id}/edit", name="angar_image_edit", methods="GET|POST")
     */
    public function edit(Request $request, AngarImage $angarImage): Response
    {
        $form = $this->createForm(AngarImageType::class, $angarImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('angar_image_edit', ['id' => $angarImage->getId()]);
        }

        return $this->render('angar_image/edit.html.twig', [
            'angar_image' => $angarImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/first", name="angar_image_set_first", methods="GET|POST")
     * @param AngarImage $angarImage
     *
     * @return Response
     */
    public function setFirst(AngarImage $angarImage): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(AngarImage::class)->setFirstImage($angarImage);
        $em->flush();
        return $this->redirectToRoute('angar_show', ['id' => $angarImage->getAngar()->getId()]);
    }

    /**
     * @Route("/{id}", name="angar_image_delete", methods="DELETE")
     */
    public function delete(Request $request, AngarImage $angarImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$angarImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($angarImage);
            $em->flush();
        }

        return $this->redirectToRoute('angar_image_index');
    }
}
