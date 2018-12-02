<?php

namespace App\Controller;

use function min;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use function var_dump;

class TechCategoryController extends AbstractController
{
    /**
     * @Route("/category/{url}", name="category")
     */
    public function showAction($url)
    {

        $category = $this->getDoctrine()
            ->getRepository('App:TechCategory')
            ->findOneBy([
                'url' => $url
            ]);

        $techs = $category->getTechs()->toArray();

        $minPrice = $this->getDoctrine()
            ->getRepository('App:Tech')
            ->findBy(
                [
                    'category' => $category->getId()
                ],
                [
                    'price' => 'ASC',

                ], 1)[0]->getPrice();


        $title = $category->getTitle() .' '. $minPrice . ' рублей';

        $content = $this->renderView('tech_category/content.html.twig', [
            'techs' => $techs,
            'content' => $category->getContent(),
        ]);

        return $this->render('tech_category/show.html.twig', [
            'title' => $title,
            'name' => $category->getName(),
            'content' => $content,
        ]);
    }
}
