<?php

namespace App\Controller;

use App\Entity\AngarCategory;
use App\Form\AngarCategoryType;
use App\Repository\AngarCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AngarCategoryController extends AbstractController
{
    /**
     * @Route("/manager/angary/category", name="angar_category_index", methods="GET")
     */
    public function index(AngarCategoryRepository $angarCategoryRepository): Response
    {
        return $this->render('angar_category/index.html.twig', ['angar_categories' => $angarCategoryRepository->findAll()]);
    }

    /**
     * @Route("/manager/angary/category/new", name="angar_category_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $angarCategory = new AngarCategory();
        $form = $this->createForm(AngarCategoryType::class, $angarCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($angarCategory);
            $em->flush();

            return $this->redirectToRoute('angar_category_index');
        }

        return $this->render('angar_category/new.html.twig', [
            'angar_category' => $angarCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/angary/category/{url}", name="angar_category_show", methods="GET", requirements={"url"="zernohranolisha|ovoshehranalisha|angary-dlya-krs|navesy|aviaangary|tentovye-angary|remont-krysh"})
     */
    public function show(AngarCategory $angarCategory): Response
    {
        return $this->render('angar_category/angar_category.html.twig', ['angar_category' => $angarCategory]);
    }

    /**
     * @Route("/angary/category/{type}", name="angary_types")
     */
    public function showTypes($type)
    {
        $templateDir = $_SERVER['DOCUMENT_ROOT']. '/../templates/angar_category';
        $templatePath = $templateDir . DIRECTORY_SEPARATOR . $type . '.html.twig';
        if (file_exists($templatePath)){
            $template = 'angar_category/'.$type.'.html.twig';
            return $this->render($template);
        }
        else return $this->render('404.html.twig');
    }

    /**
     * @Route("/manager/angary/category/{id}/edit", name="angar_category_edit", methods="GET|POST", requirements={"id" = "\d+"})
     */
    public function edit(Request $request, AngarCategory $angarCategory): Response
    {
        $form = $this->createForm(AngarCategoryType::class, $angarCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('angar_category_edit', ['id' => $angarCategory->getId()]);
        }

        return $this->render('angar_category/edit.html.twig', [
            'angar_category' => $angarCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/angary/category/delete/{id}", name="angar_category_delete", methods="DELETE", requirements={"id" = "\d+"})
     */
    public function delete(Request $request, AngarCategory $angarCategory): Response
    {
        /*$this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');*/
        if ($this->isCsrfTokenValid('delete'.$angarCategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($angarCategory);
            $em->flush();
        }

        return $this->redirectToRoute('angar_category_index');
    }

}
