<?php

namespace App\Controller;

use App\Entity\TechCategory;
use App\Form\TechCategoryType;
use App\Repository\TechCategoryRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

///**
// * @Route("/tech/category")
// */
class TechCategoryController extends AbstractController
{
    /**
     * @Route("/manager/tech/category", name="tech_category_index", methods="GET")
     */
    public function index(TechCategoryRepository $techCategoryRepository): Response
    {
        return $this->render('tech_category/index.html.twig', ['tech_categories' => $techCategoryRepository->findAll()]);
    }

    /**
     * @Route("/manager/tech/category/new", name="tech_category_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $techCategory = new TechCategory();
        $form = $this->createForm(TechCategoryType::class, $techCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $techCategory->setCreated($dateTime);
            $techCategory->setUpdated($dateTime);

            $imageSmall = $techCategory->getSmallImageBin();
            $imageSideBar = $techCategory->getSideBarImageBin();

            $fileUploader->setParticularPath('content/category/'.$techCategory->getId().'/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $techCategory->setSmallImage('assets/img/content/category/'.$techCategory->getId().'/'.$imageSmallUpload['name_md5']);

            $imageSideBarUpload = $fileUploader->upload($imageSideBar);
            $techCategory->setSideBarImage('assets/img/content/category/'.$techCategory->getId().'/'.$imageSideBarUpload['name_md5']);

            $em->persist($techCategory);
            $em->flush();

            return $this->redirectToRoute('tech_category_index');
        }

        $content = $this->renderView('tech_category/_form.html.twig', [
            'form' => $form->createView(),
        ]);

        return $this->render('tech_category/new.html.twig', [
            'tech_category' => $techCategory,
            'content' => $content
        ]);
    }

    /**
     * @Route("/manager/tech/category/{id}", name="tech_category_show", methods="GET")
     */
    public function show(TechCategory $techCategory): Response
    {
        return $this->render('tech_category/show.html.twig', ['tech_category' => $techCategory]);
    }

    /**
     * @Route("/manager/tech/category/{id}/edit", name="tech_category_edit", methods="GET|POST")
     * @param Request $request
     * @param TechCategory $techCategory
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit(Request $request, TechCategory $techCategory, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(TechCategoryType::class, $techCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $techCategory->setCreated($dateTime);
            $techCategory->setUpdated($dateTime);

            $imageSmall = $techCategory->getSmallImageBin();
            $imageSideBar = $techCategory->getSideBarImageBin();

            $fileUploader->setParticularPath('content/category/'.$techCategory->getId().'/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $techCategory->setSmallImage('assets/img/content/category/'.$techCategory->getId().'/'.$imageSmallUpload['name_md5']);

            $imageSideBarUpload = $fileUploader->upload($imageSideBar);
            $techCategory->setSideBarImage('assets/img/content/category/'.$techCategory->getId().'/'.$imageSideBarUpload['name_md5']);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tech_category_edit', ['id' => $techCategory->getId()]);
        }

        $content = $this->renderView('tech_category/_form.html.twig', [
            'form' => $form->createView(),
        ]);

        return $this->render('tech_category/new.html.twig', [
            'tech_category' => $techCategory,
            'content' => $content
        ]);
    }

    /**
     * @Route("/manager/tech/category/{id}", name="tech_category_delete", methods="DELETE")
     */
    public function delete(Request $request, TechCategory $techCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$techCategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($techCategory);
            $em->flush();
        }

        return $this->redirectToRoute('tech_category_index');
    }

    /**
     * @Route("/selhoztehnika/", name="selhoztehnika")
     * @param TechCategoryRepository $techCategoryRepository
     * @return Response
     */
    public function showAll(TechCategoryRepository $techCategoryRepository)
    {

        return $this->render('tech_category/all_categories.html.twig', [
            'title' => 'Купить сельхозтехнику от производителя в Ростовской области',
            'h1' => 'Сельхозтехника',
            'tech_categories' => $techCategoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/category/{url}", name="category")
     * @param $url
     * @return Response
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


        return $this->render('tech_category/category.html.twig', [
            'title' => $title,
            'h1' => $category->getName(),
            'techs_of_category' => $techs,
            'category' => $category,
        ]);
    }
}
