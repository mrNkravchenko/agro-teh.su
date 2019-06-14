<?php

namespace App\Controller;

use App\Entity\PartnerTech;
use App\Form\PartnerTechType;
use App\Repository\PartnerTechRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PartnerTechController extends AbstractController
{

    /**
     * @Route("/partner/tech/{url}", name="partner_tech_show_one")
     * @param $url
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showOne($url)
    {

        $tech = $this->getDoctrine()
            ->getRepository('App:PartnerTech')
            ->findOneBy([
                'url' => $url
            ]);
        $name = $tech->getName();
        $price = $tech->getPrice();
        $firstImagePath = "{{ asset('". $tech->getImage() ."') }}";
        $slider = $tech->getSlider()->toArray();


        $content = $this->renderView('partner_tech/content.html.twig', [
            'content' => $tech->getContent(),
            'slider' => $slider,
            'price' => $price,
            'tech' => $tech,
        ]);


        return $this->render('partner_tech/tech.html.twig', [
            'title' =>  'Партнеры ООО "АГРО-ТЕХ", техника партнеров, ' .$name,
            'name' => $name,
            'price' => $price,
            'tech' => $tech,
            'slider' => $slider,
            'firstImagePath' => $firstImagePath,
            'content' => $content,
        ]);
    }

    /**
     * @Route("/manager/partner/tech/", name="partner_tech_index", methods="GET")
     * @param PartnerTechRepository $partnerTechRepository
     * @return Response
     */
    public function index(PartnerTechRepository $partnerTechRepository): Response
    {
        return $this->render('partner_tech/index.html.twig', ['partner_teches' => $partnerTechRepository->findAll()]);
    }

    /**
     * @Route("/manager/partner/tech/new", name="partner_tech_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $partnerTech = new PartnerTech();
        $form = $this->createForm(PartnerTechType::class, $partnerTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $partnerTech = $form->getData();

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $partnerTech->setCreated($dateTime);
            $partnerTech->setUpdated($dateTime);

            $image = $partnerTech->getImageBin();
            $imageSmall = $partnerTech->getSmallImageBin();


            $fileUploader->setParticularPath('content/partners/techs/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $partnerTech->setImage('assets/img/content/partners/techs/'.$imageUpload['name_md5']);

            $fileUploader->setParticularPath('content/partners/techs/group/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $partnerTech->setSmallImage('assets/img/content/partners/techs/group/'.$imageSmallUpload['name_md5']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($partnerTech);
            $em->flush();

            return $this->redirectToRoute('partner_tech_index');
        }

        $content = $this->renderView('partner_tech/create.html.twig', ['form' => $form->createView()]);

        return $this->render('partner_tech/new.html.twig', ['content' => $content]);

    }

    /**
     * @Route("/manager/partner/tech/{id}", name="partner_tech_show", methods="GET")
     * @param PartnerTech $partnerTech
     * @return Response
     */
    public function show(PartnerTech $partnerTech): Response
    {
        return $this->render('partner_tech/show.html.twig', ['partner_tech' => $partnerTech]);
    }

    /**
     * @Route("/manager/partner/tech/{id}/edit", name="partner_tech_edit", methods="GET|POST")
     * @param Request $request
     * @param PartnerTech $partnerTech
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit(Request $request, PartnerTech $partnerTech, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(PartnerTechType::class, $partnerTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $partnerTech->setUpdated($dateTime);

            $image = $partnerTech->getImageBin();
            $imageSmall = $partnerTech->getSmallImageBin();


            $fileUploader->setParticularPath('content/partners/techs/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $partnerTech->setImage('assets/img/content/partners/techs/'.$imageUpload['name_md5']);

            $fileUploader->setParticularPath('content/partners/techs/group/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $partnerTech->setSmallImage('assets/img/content/partners/techs/group/'.$imageSmallUpload['name_md5']);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_tech_edit', ['id' => $partnerTech->getId()]);
        }

        return $this->render('partner_tech/edit.html.twig', [
            'partner_tech' => $partnerTech,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/partner/tech/{id}", name="partner_tech_delete", methods="DELETE")
     * @param Request $request
     * @param PartnerTech $partnerTech
     * @return Response
     */
    public function delete(Request $request, PartnerTech $partnerTech): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partnerTech->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partnerTech);
            $em->flush();
        }

        return $this->redirectToRoute('partner_tech_index');
    }
}
