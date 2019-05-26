<?php

namespace App\Controller;

use App\Entity\GalleryImage;
use App\Form\GalleryImageType;
use App\Repository\GalleryImageRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GalleryImageController extends AbstractController
{
    /**
     * @Route("/manager/gallery/images", name="gallery_image_index", methods="GET")
     * @param GalleryImageRepository $galleryImageRepository
     * @return Response
     */
    public function index(GalleryImageRepository $galleryImageRepository): Response
    {

//        $content = $this->render('gallery', ['gallery' => $gallery->getImages(), 'lastItem' => $gallery->select(['ORDER BY' => 'id', 'DESC' => 'LIMIT 1'])[0]]);
//        var_dump($hangars->getHangarsBildingsImages());
//
//        echo $this->render('layout', ['title' => 'Галлерея АГРО-ТЕХ', "content" => $content]);
        return $this->render('gallery_image/index.html.twig', ['gallery_images' => $galleryImageRepository->findBy([],['id' => 'DESC'])]);
    }


    /**
     * @Route("/gallery", name="gallery", methods="GET")
     * @param GalleryImageRepository $galleryImageRepository
     *
     * @return Response
     */
    public function showAll(GalleryImageRepository $galleryImageRepository): Response
    {

        return $this->render('gallery_image/gallery.html.twig', ['gallery' => $galleryImageRepository->findBy([],['id' => 'DESC'])]);

    }

    /**
     * @Route("/manager/gallery/image/new", name="gallery_image_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $fileUploader->setParticularPath('gallery/');
        $galleryImage = new GalleryImage();
        $form = $this->createForm(GalleryImageType::class, $galleryImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $files = $galleryImage->getImage();
            foreach ($files as $file) {
                $fileParams = $fileUploader->upload($file);
                $galleryImage->setName($fileParams['name']);
                $galleryImage->setNameMd5($fileParams['name_md5']);
                $galleryImage->setPath('assets/img/gallery/');
                $galleryImage->setPathThumbnail('assets/img/gallery/thumbnail');
                $em->persist($galleryImage);
                $em->flush();
            }


            return $this->redirectToRoute('gallery_image_index');
        }

        return $this->render('gallery_image/new.html.twig', [
            'gallery_image' => $galleryImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/gallery/image/{id}", name="gallery_image_show", methods="GET")
     */
    public function show(GalleryImage $galleryImage): Response
    {
        return $this->render('gallery_image/show.html.twig', ['gallery_image' => $galleryImage]);
    }

    /**
     * @Route("/manager/gallery/image/{id}/edit", name="gallery_image_edit", methods="GET|POST")
     */
    public function edit(Request $request, GalleryImage $galleryImage): Response
    {
        $form = $this->createForm(GalleryImageType::class, $galleryImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gallery_image_edit', ['id' => $galleryImage->getId()]);
        }

        return $this->render('gallery_image/edit.html.twig', [
            'gallery_image' => $galleryImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/gallery/image/{id}", name="gallery_image_delete", methods="DELETE")
     */
    public function delete(Request $request, GalleryImage $galleryImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galleryImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($galleryImage);
            $em->flush();
        }

        return $this->redirectToRoute('gallery_image_index');
    }
}
