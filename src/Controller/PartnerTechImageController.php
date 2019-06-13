<?php

namespace App\Controller;

use App\Entity\PartnerTechImage;
use App\Form\PartnerTechImageType;
use App\Repository\PartnerTechImageRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manager/partner/tech/image")
 */
class PartnerTechImageController extends AbstractController
{
    /**
     * @Route("/", name="partner_tech_image_index", methods="GET")
     * @param PartnerTechImageRepository $partnerTechImageRepository
     * @return Response
     */
    public function index(PartnerTechImageRepository $partnerTechImageRepository): Response
    {
        return $this->render('partner_tech_image/index.html.twig', ['partner_tech_images' => $partnerTechImageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="partner_tech_image_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $partnerTechImage = new PartnerTechImage();
        $form = $this->createForm(PartnerTechImageType::class, $partnerTechImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tech = $partnerTechImage->getTech();
            $fileUploader->setParticularPath('content/partners/techs/'.$tech->getUrl().'/');
            $images = $partnerTechImage->getImage();

            $em = $this->getDoctrine()->getManager();
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));


            foreach ($images as $image) {
                $techImage = new PartnerTechImage();
                $techImage->setTech($tech);
                $fileParams = $fileUploader->upload($image);
                $techImage->setPath('assets/img/content/partners/techs/'.$tech->getUrl().'/'.$fileParams['name_md5']);
                $techImage->setCreated($dateTime);
                $techImage->setIsSlider(true);
                $em->persist($techImage);
            }

            $em->flush();

            return $this->redirectToRoute('partner_tech_image_index');
        }

        return $this->render('partner_tech_image/new.html.twig', [
            'partner_tech_image' => $partnerTechImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partner_tech_image_show", methods="GET")
     * @param PartnerTechImage $partnerTechImage
     * @return Response
     */
    public function show(PartnerTechImage $partnerTechImage): Response
    {
        return $this->render('partner_tech_image/show.html.twig', ['partner_tech_image' => $partnerTechImage]);
    }

    /**
     * @Route("/{id}/edit", name="partner_tech_image_edit", methods="GET|POST")
     * @param Request $request
     * @param PartnerTechImage $partnerTechImage
     * @return Response
     */
    public function edit(Request $request, PartnerTechImage $partnerTechImage): Response
    {
        $form = $this->createForm(PartnerTechImageType::class, $partnerTechImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_tech_image_edit', ['id' => $partnerTechImage->getId()]);
        }

        return $this->render('partner_tech_image/edit.html.twig', [
            'partner_tech_image' => $partnerTechImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partner_tech_image_delete", methods="DELETE")
     * @param Request $request
     * @param PartnerTechImage $partnerTechImage
     * @return Response
     */
    public function delete(Request $request, PartnerTechImage $partnerTechImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partnerTechImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partnerTechImage);
            $em->flush();
        }

        return $this->redirectToRoute('partner_tech_image_index');
    }
}
