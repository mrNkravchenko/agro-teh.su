<?php

namespace App\Controller;

use App\Entity\AngarImage;
use App\Form\AngarImageType;
use App\Repository\AngarImageRepository;
use phpDocumentor\Reflection\Types\This;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

///**
// * @Route("/angar/image")
// */
class AngarImageController extends AbstractController
{
    const IMAGE_DIR = '';
//    public $uploadDir = IMAGE_DIR;
    public $imagePath = 'assets/img/hangars/';
    /**
     * @Route("/manager/angar/image", name="angar_image_index", methods="GET")
     */
    public function index(AngarImageRepository $angarImageRepository): Response
    {
        return $this->render('angar_image/index.html.twig', ['angar_images' => $angarImageRepository->findAll()]);
    }

    /**
     * @Route("/manager/angar/image/new", name="angar_image_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $angarImage = new AngarImage();
        $form = $this->createForm(AngarImageType::class, $angarImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $angar = $angarImage->getAngar();
            $fileUploader->setParticularPath('hangars/'.$angarImage->getAngar()->getId().'/');

            $em = $this->getDoctrine()->getManager();

            $images = $angarImage->getImage();
            foreach ($images as $image) {
                $angarImage = new AngarImage();
                $angarImage->setAngar($angar);
                $angarImage->setFirst(false);
                $fileParams = $fileUploader->upload($image);
                $angarImage->setName($fileParams['name']);
                $angarImage->setNameMd5($fileParams['name_md5']);
                $angarImage->setPath('assets/img/hangars/'.$angarImage->getAngar()->getId().'/');
                $angarImage->setPathThumbnail('assets/img/hangars/'.$angarImage->getAngar()->getId().'/thumbnail/');
                $em->persist($angarImage);
            }
            $em->flush();

            return $this->redirectToRoute('angar_image_index');
        }

        return $this->render('angar_image/new.html.twig', [
            'angar_image' => $angarImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/angar/image/{id}", name="angar_image_show", methods="GET")
     */
    public function show(AngarImage $angarImage): Response
    {
        return $this->render('angar_image/show.html.twig', ['angar_image' => $angarImage]);
    }

    /**
     * @Route("/manager/angar/image/{id}/edit", name="angar_image_edit", methods="GET|POST")
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
     * @Route("/angar/image/{id}/first", name="angar_image_set_first", methods="GET|POST")
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
     * @Route("/manager/manage/angar/image/{id}", name="angar_image_delete", methods="DELETE")
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
