<?php

namespace App\Controller;

use App\Entity\SparePartsImage;
use App\Form\SparePartsImageType;
use App\Repository\SparePartsImageRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manager/spare/parts-image", name="spare_parts_image")
 */
class SparePartsImageController extends AbstractController
{
    const IMAGE_DIR = '';
//    public $uploadDir = IMAGE_DIR;
    public $imagePath = 'assets/img/spare-parts/';
    /**
     * @Route("/", name="_index", methods="GET")
     */
    public function index(SparePartsImageRepository $sparePartsImageRepository): Response
    {
        return $this->render('spare_parts_image/index.html.twig', ['spare_parts_images' => $sparePartsImageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $sparePartsImage = new SparePartsImage();
        $form = $this->createForm(SparePartsImageType::class, $sparePartsImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image = $sparePartsImage->getImage();

            $fileUploader->setParticularPath('spare-parts/'.$sparePartsImage->getSpare()->getId().'/');
            $fileParams = $fileUploader->upload($image);
            $sparePartsImage->setName($fileParams['name']);
            $sparePartsImage->setNameMd5($fileParams['name_md5']);
            $sparePartsImage->setPath('assets/img/spare-parts/'.$sparePartsImage->getSpare()->getId().'/');
            $sparePartsImage->setPathThumbnail('assets/img/spare-parts/'.$sparePartsImage->getSpare()->getId().'/thumbnail/');

            $em->persist($sparePartsImage);
            $em->flush();

            return $this->redirectToRoute('spare_parts_image_index');
        }

        return $this->render('spare_parts_image/new.html.twig', [
            'spare_parts_image' => $sparePartsImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="_show", methods="GET")
     */
    public function show(SparePartsImage $sparePartsImage): Response
    {
        return $this->render('spare_parts_image/show.html.twig', ['spare_parts_image' => $sparePartsImage]);
    }

    /**
     * @Route("/{id}/edit", name="_edit", methods="GET|POST")
     */
    public function edit(Request $request, SparePartsImage $sparePartsImage): Response
    {
        $form = $this->createForm(SparePartsImageType::class, $sparePartsImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spare_parts_image_edit', ['id' => $sparePartsImage->getId()]);
        }

        return $this->render('spare_parts_image/edit.html.twig', [
            'spare_parts_image' => $sparePartsImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="_delete", methods="DELETE")
     */
    public function delete(Request $request, SparePartsImage $sparePartsImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sparePartsImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sparePartsImage);
            $em->flush();
        }

        return $this->redirectToRoute('spare_parts_image_index');
    }

    /**
     * @Route("/{id}/first", name="spare_part_image_set_first", methods="GET|POST")
     * @param SparePartsImage $sparePartImage
     *
     * @return Response
     */
    public function setFirst(SparePartsImage $sparePartsImage): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(SparePartsImage::class)->setFirstImage($sparePartsImage);
        $em->flush();
        return $this->redirectToRoute('spare_parts_show', ['id' => $sparePartsImage->getSpare()->getId()]);
    }
}
