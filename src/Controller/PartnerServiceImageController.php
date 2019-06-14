<?php

namespace App\Controller;

use App\Entity\PartnerServiceImage;
use App\Form\PartnerServiceImageType;
use App\Repository\PartnerServiceImageRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PartnerServiceImageController extends AbstractController
{
    /**
     * @Route("/manager/partner/service-image/", name="partner_service_image_index", methods="GET")
     * @param PartnerServiceImageRepository $partnerServiceImageRepository
     * @return Response
     */
    public function index(PartnerServiceImageRepository $partnerServiceImageRepository): Response
    {
        return $this->render('partner_service_image/index.html.twig', ['partner_service_images' => $partnerServiceImageRepository->findAll()]);
    }

    /**
     * @Route("/manager/partner/service/image/new", name="partner_service_image_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $partnerServiceImage = new PartnerServiceImage();
        $form = $this->createForm(PartnerServiceImageType::class, $partnerServiceImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service = $partnerServiceImage->getService();
            $fileUploader->setParticularPath('content/partners/services/'.$service->getUrl().'/');
            $images = $partnerServiceImage->getImage();

            $em = $this->getDoctrine()->getManager();
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));


            foreach ($images as $image) {
                $partnerServiceImage = new PartnerServiceImage();
                $partnerServiceImage->setService($service);
                $fileParams = $fileUploader->upload($image);
                $partnerServiceImage->setPath('assets/img/content/partners/services/'.$service->getUrl().'/'.$fileParams['name_md5']);
                $partnerServiceImage->setCreated($dateTime);
                $partnerServiceImage->setIsSlider(true);
                $em->persist($partnerServiceImage);
            }

            $em->flush();

            return $this->redirectToRoute('partner_service_image_index');
        }

        return $this->render('partner_service_image/new.html.twig', [
            'partner_service_image' => $partnerServiceImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/partner/service/image/{id}", name="partner_service_image_show", methods="GET")
     * @param PartnerServiceImage $partnerServiceImage
     * @return Response
     */
    public function show(PartnerServiceImage $partnerServiceImage): Response
    {
        return $this->render('partner_service_image/show.html.twig', ['partner_service_image' => $partnerServiceImage]);
    }

    /**
     * @Route("/manager/partner/service/image/{id}/edit", name="partner_service_image_edit", methods="GET|POST")
     * @param Request $request
     * @param PartnerServiceImage $partnerServiceImage
     * @return Response
     */
    public function edit(Request $request, PartnerServiceImage $partnerServiceImage): Response
    {
        $form = $this->createForm(PartnerServiceImageType::class, $partnerServiceImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_service_image_edit', ['id' => $partnerServiceImage->getId()]);
        }

        return $this->render('partner_service_image/edit.html.twig', [
            'partner_service_image' => $partnerServiceImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/partner/service/image/{id}", name="partner_service_image_delete", methods="DELETE")
     * @param Request $request
     * @param PartnerServiceImage $partnerServiceImage
     * @return Response
     */
    public function delete(Request $request, PartnerServiceImage $partnerServiceImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partnerServiceImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partnerServiceImage);
            $em->flush();
        }

        return $this->redirectToRoute('partner_service_image_index');
    }
}
