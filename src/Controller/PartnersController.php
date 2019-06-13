<?php

namespace App\Controller;

use App\Repository\PartnerServiceRepository;
use App\Repository\PartnerTechRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartnersController extends AbstractController
{
    /**
     * @Route("/partners", name="partners")
     */
    public function index()
    {
        return $this->render('partners/partners.html.twig');
    }

    /**
     * @Route("/partners/techs", name="partners_techs")
     * @param PartnerTechRepository $partnerTechRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showTechs(PartnerTechRepository $partnerTechRepository)
    {

        return $this->render('partner_tech/all_tech.html.twig', [
            'title' => 'Техника партнеров ООО "АГРО-ТЕХ"',
            'h1' => 'Техника партнеров ООО "АГРО-ТЕХ"',
            'partner_techs' => $partnerTechRepository->findBy([], ['short_name' => 'asc']),
        ]);

    }


    /**
     * @Route("/partners/services", name="partners_services")
     * @param PartnerServiceRepository $partnerServiceRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showServices(PartnerServiceRepository $partnerServiceRepository)
    {
        return $this->render('partner_service/all_services.html.twig', [
            'title' => 'Услуги партнеров ООО "АГРО-ТЕХ"',
            'h1' => 'Услуги партнеров ООО "АГРО-ТЕХ"',
            'partner_services' => $partnerServiceRepository->findBy([], ['short_name' => 'asc']),
        ]);
    }
}
