<?php

namespace App\Controller;

use function exif_imagetype;
use function file_exists;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use function var_dump;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Сельхозтехника в Ростовской области, производитель АГРО-ТЕХ',
        ]);
    }

    /**
     * @Route("/{slug}")
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
