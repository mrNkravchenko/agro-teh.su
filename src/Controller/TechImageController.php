<?php

namespace App\Controller;

use App\Entity\TechImage;
use App\Form\TechImageType;
use App\Repository\TechImageRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manager/tech/image")
 */
class TechImageController extends AbstractController
{
    /**
     * @Route("/", name="tech_image_index", methods="GET")
     * @param TechImageRepository $techImageRepository
     * @return Response
     */
    public function index(TechImageRepository $techImageRepository): Response
    {
        return $this->render('tech_image/index.html.twig', ['tech_images' => $techImageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tech_image_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {

        $techImage = new TechImage();
        $form = $this->createForm(TechImageType::class, $techImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tech = $techImage->getTech();
            $fileUploader->setParticularPath('content/'.$tech->getUrl().'/');

            $em = $this->getDoctrine()->getManager();

            $images = $techImage->getImage();
            foreach ($images as $image) {
                $techImage = new TechImage();
                $techImage->setTech($tech);
                $fileParams = $fileUploader->upload($image);
                $techImage->setPath('assets/img/content/'.$tech->getUrl().'/'.$fileParams['name_md5']);
                $em->persist($techImage);

            }
            $em->flush();

            return $this->redirectToRoute('tech_image_index');
        }

        return $this->render('tech_image/new.html.twig', [
            'tech_image' => $techImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tech_image_show", methods="GET")
     * @param TechImage $techImage
     * @return Response
     */
    public function show(TechImage $techImage): Response
    {
        return $this->render('tech_image/show.html.twig', ['tech_image' => $techImage]);
    }

    /**
     * @Route("/{id}/edit", name="tech_image_edit", methods="GET|POST")
     * @param Request $request
     * @param TechImage $techImage
     * @return Response
     */
    public function edit(Request $request, TechImage $techImage): Response
    {
        $form = $this->createForm(TechImageType::class, $techImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tech_image_edit', ['id' => $techImage->getId()]);
        }

        return $this->render('tech_image/edit.html.twig', [
            'tech_image' => $techImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tech_image_delete", methods="DELETE")
     * @param Request $request
     * @param TechImage $techImage
     * @return Response
     */
    public function delete(Request $request, TechImage $techImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$techImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($techImage);
            $em->flush();
        }

        return $this->redirectToRoute('tech_image_index');
    }
}
