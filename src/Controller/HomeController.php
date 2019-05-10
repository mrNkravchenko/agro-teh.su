<?php

namespace App\Controller;

use App\Entity\Tech;
use function dump;
use function exif_imagetype;
use function file_exists;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function var_dump;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        $techs = $this->getDoctrine()->getRepository('App:Tech')->findAll();
        $techsCategory = $this->getDoctrine()->getRepository('App:TechCategory')->findAll();

        return $this->render('home/index.html.twig', [
            'title' => 'Сельхозтехника в Ростовской области, бескаркасные ангары, производитель АГРО-ТЕХ',
            'techs' => $techs,
            'techsCategory' => $techsCategory,

        ]);
    }

    /**
     * @Route("/{slug}", name="app_home_show", requirements={"slug"="voprosy-po-stroitelstvu-angarov-selhoztehnike|about|contacts|politika-konfidencialnosti"})
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($slug)
    {
        $templateDir = $_SERVER['DOCUMENT_ROOT']. '/../templates/home';
        $templatePath = $templateDir . DIRECTORY_SEPARATOR . $slug . '.html.twig';
        if (file_exists($templatePath)){
            $template = 'home/'.$slug.'.html.twig';
            return $this->render($template);
        }
        elseif ($slug === 'voprosy-po-stroitelstvu-angarov-selhoztehnike'){
            return $this->render('home/callback.html.twig');
        }
        else return $this->render('404.html.twig');


    }
}
