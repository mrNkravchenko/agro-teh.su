<?php

namespace App\Controller;

use App\Entity\PartnerService;
use App\Form\PartnerServiceType;
use App\Repository\PartnerServiceRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("")
 */
class PartnerServiceController extends AbstractController
{

    /**
     * @Route("/partner/service/{url}", name="partner_service_show_one")
     * @param $url
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showOne($url)
    {

        $service = $this->getDoctrine()
            ->getRepository('App:PartnerService')
            ->findOneBy([
                'url' => $url
            ]);
        $name = $service->getName();
        $price = $service->getPrice();
        $firstImagePath = "{{ asset('". $service->getImage() ."') }}";
        $slider = $service->getSlider()->toArray();


        $content = $this->renderView('partner_service/content.html.twig', [
            'content' => $service->getContent(),
            'slider' => $slider,
            'price' => $price,
            'service' => $service,
        ]);

        return $this->render('partner_service/service.html.twig', [
            'title' =>  'Партнеры ООО "АГРО-ТЕХ", услуги партнеров, ' .$name,
            'name' => $name,
            'price' => $price,
            'service' => $service,
            'slider' => $slider,
            'firstImagePath' => $firstImagePath,
            'content' => $content,
        ]);
    }

    /**
     * @Route("/manager/partner/service/", name="partner_service_index", methods="GET")
     */
    public function index(PartnerServiceRepository $partnerServiceRepository): Response
    {
        return $this->render('partner_service/index.html.twig', ['partner_services' => $partnerServiceRepository->findAll()]);
    }

    /**
     * @Route("/new", name="partner_service_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $partnerService = new PartnerService();
        $form = $this->createForm(PartnerServiceType::class, $partnerService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $partnerService = $form->getData();

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $partnerService->setCreated($dateTime);
            $partnerService->setUpdated($dateTime);

            $image = $partnerService->getImageBin();
            $imageSmall = $partnerService->getSmallImageBin();


            $fileUploader->setParticularPath('content/partners/services/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $partnerService->setImage('assets/img/content/partners/services/'.$imageUpload['name_md5']);

            $fileUploader->setParticularPath('content/partners/services/group/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $partnerService->setSmallImage('assets/img/content/partners/services/group/'.$imageSmallUpload['name_md5']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($partnerService);
            $em->flush();

            return $this->redirectToRoute('partner_service_index');
        }

        $content = $this->renderView('partner_service/create.html.twig', ['form' => $form->createView()]);

        return $this->render('partner_service/new.html.twig', ['content' => $content]);
    }

    /**
     * @Route("/manager/partner/service/{id}", name="partner_service_show", methods="GET")
     */
    public function show(PartnerService $partnerService): Response
    {
        return $this->render('partner_service/show.html.twig', ['partner_service' => $partnerService]);
    }

    /**
     * @Route("/manager/partner/service/{id}/edit", name="partner_service_edit", methods="GET|POST")
     */
    public function edit(Request $request, PartnerService $partnerService, FileUploader $fileUploader): Response
    {

        $form = $this->createForm(PartnerServiceType::class, $partnerService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $partnerService->setUpdated($dateTime);

            $image = $partnerService->getImageBin();
            $imageSmall = $partnerService->getSmallImageBin();


            $fileUploader->setParticularPath('content/partners/services/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $partnerService->setImage('assets/img/content/partners/services/'.$imageUpload['name_md5']);

            $fileUploader->setParticularPath('content/partners/services/group/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $partnerService->setSmallImage('assets/img/content/partners/services/group/'.$imageSmallUpload['name_md5']);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_service_edit', ['url' => $partnerService->getUrl()]);
        }

        return $this->render('partner_service/edit.html.twig', [
            'partner_service' => $partnerService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/partner/service/{id}", name="partner_service_delete", methods="DELETE")
     */
    public function delete(Request $request, PartnerService $partnerService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partnerService->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partnerService);
            $em->flush();
        }

        return $this->redirectToRoute('partner_service_index');
    }
}
