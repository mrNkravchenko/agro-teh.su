<?php

namespace App\Controller;

use App\Entity\Angar;
use App\Entity\AngarCategory;
use App\Entity\Articles;
use App\Entity\PartnerService;
use App\Entity\PartnerTech;
use App\Entity\SpareParts;
use App\Entity\Tech;
use App\Entity\TechCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // We define an array of urls
        $urls = [];
        // We store the hostname of our website
        $hostname = $request->getHost();
        $em = $this->getDoctrine();

        //add static URLs
        $urls[] = ['loc' => $this->get('router')->generate('app_home'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('app_home_show', ['slug' => 'about']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('app_home_show', ['slug' => 'contacts']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('app_home_show', ['slug' => 'politika-konfidencialnosti']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('app_home_show', ['slug' => 'services']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('app_home_show', ['slug' => 'leasing']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'uteplenie-penopoliuretanom']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'tehnologia-stroitelstva-beskarkasnyh-angarov']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'stroitelstvo-zernohranilishh-i-ovoshehranilishh']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'stroitelstvo-zernohranilish']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'preimushhestva-beskarkasnogo-stroitelstva']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'karkasnye-i-beskarkasnye-angary']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'beskarkasnoe-arochnoe-stroitelstvo']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'aviatsionnye-angary']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'arochnye-angary-istoriya']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angary_types', ['type' => 'arochnye-angary']), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('angar_show_all'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('articles'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('gallery'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('partners'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('partners_techs'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('partners_services'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('spare_parts_show_all'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => $this->get('router')->generate('selhoztehnika'), 'changefreq' => 'weekly', 'priority' => '1.0'];

        // add dynamic urls

        //angar_category_show                           GET        ANY      ANY    /angary/category/{url}
        $angarCategory = $em->getRepository(AngarCategory::class)->findAll();
        foreach ($angarCategory as $category) {
            /**@var AngarCategory $category*/
            $urls[] = ['loc' => $this->get('router')->generate('angar_category_show', ['url' => $category->getUrl()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }

        //angar_show                                    GET        ANY      ANY    /angary/postroennue/{id}
        $angars = $em->getRepository(Angar::class)->findAll();
        foreach ($angars as $angar) {
            /**@var Angar $angar*/
            $urls[] = ['loc' => $this->get('router')->generate('angar_show', ['id' => $angar->getId()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }

        //articles_show                                 GET        ANY      ANY    /articles/{id}
        $articles = $em->getRepository(Articles::class)->findAll();
        foreach ($articles as $article) {
            /**@var Articles $article*/
            $urls[] = ['loc' => $this->get('router')->generate('articles_show', ['id' => $article->getId()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }

        //partner_service_show_one                      ANY        ANY      ANY    /partner/service/{url}
        $partnersServices = $em->getRepository(PartnerService::class)->findAll();
        foreach ($partnersServices as $partnersService) {
            /**@var PartnerService $partnersService*/
            $urls[] = ['loc' => $this->get('router')->generate('partner_service_show_one', ['url' => $partnersService->getUrl()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }

        //partner_tech_show_one                         ANY        ANY      ANY    /partner/tech/{url}
        $partnersTechs = $em->getRepository(PartnerTech::class)->findAll();
        foreach ($partnersTechs as $partnersTech) {
            /**@var PartnerTech $partnersTech*/
            $urls[] = ['loc' => $this->get('router')->generate('partner_tech_show_one', ['url' => $partnersTech->getUrl()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }

        //spare_parts_show                              GET        ANY      ANY    /spare-parts/{id}
        $spareParts = $em->getRepository(SpareParts::class)->findAll();
        foreach ($spareParts as $sparePart) {
            /**@var SpareParts $sparePart*/
            $urls[] = ['loc' => $this->get('router')->generate('spare_parts_show', ['id' => $sparePart->getId()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }

        //category                                      ANY        ANY      ANY    /category/{url}
        $techCategories = $em->getRepository(TechCategory::class)->findAll();
        foreach ($techCategories as $techCategory) {
            /**@var TechCategory $techCategory*/
            $urls[] = ['loc' => $this->get('router')->generate('category', ['url' => $techCategory->getUrl()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }

        //selhoztehnika_show                            ANY        ANY      ANY    /tech/{url}
        $techs = $em->getRepository(Tech::class)->findAll();
        foreach ($techs as $tech) {
            /**@var Tech $tech*/
            $urls[] = ['loc' => $this->get('router')->generate('selhoztehnika_show', ['url' => $tech->getUrl()]), 'changefreq' => 'weekly', 'priority' => '1.0'];
        }


        $response = new Response();
        $response->headers->set('Content-Type', 'xml');

        return $this->render('sitemap/index.xml.twig', [
            'urls' => $urls,
            'hostname' => $hostname
        ], $response);
    }
}
