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
     * @Route("/{slug}", name="app_home_show", requirements={"slug":"about|contacts|politika-konfidencialnosti|services|leasing"})
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


    }

    /**
     * @Route("/verify-user", name="verify-user", methods="POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function verifyUser(Request $request)
    {

        $params = $request->request->all();
        $token = $params['token'];

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'secret'=>$_ENV['reCAPTCHA_SECRET_KEY'],
            'response' => $token,
            'remoteip' => $request->getClientIp()
        ]);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);


        if (!json_decode($result, true)['success']) {
            return $this->json(['status' => 0, 'params' => $params, 'result' => $result, 'message' => 'Google Капча не подтвержена']);
        } else {
            return $this->json(['status' => 1, 'params' => $params, 'result' => $result, 'message' => 'Google Капча подтвержена']);
        }
    }
}
