<?php

namespace App\Controller;

use App\Entity\AngarCategory;
use App\Form\AngarCategoryType;
use App\Repository\AngarCategoryRepository;
use App\Service\FileUploader;
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
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $angarCategory = new AngarCategory();
        $form = $this->createForm(AngarCategoryType::class, $angarCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $angarCategory->setCreated($dateTime);
            $angarCategory->setUpdated($dateTime);

            $image = $angarCategory->getImageBin();

            $fileUploader->setParticularPath('hangars-category/'.$angarCategory->getUrl().'/');
            $fileParams = $fileUploader->upload($image);
            $angarCategory->setImage('hangars-category/'.$angarCategory->getUrl().'/'.$fileParams['name_md5']);

            $imageSmall = $angarCategory->getSmallImageBin();

            $fileParams = $fileUploader->upload($imageSmall);
            $angarCategory->setImage('hangars-category/'.$angarCategory->getUrl().'/'.$fileParams['name_md5']);

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
     * @Route("/angary/category/{url}", name="angar_category_show", methods="GET")
     * @param AngarCategory $angarCategory
     * @return Response
     */
    public function show(AngarCategory $angarCategory): Response
    {
        return $this->render('angar_category/angar_category.html.twig', ['angar_category' => $angarCategory]);
    }

    /**
     * @Route("/angary/{type}", name="angary_types", methods="GET", requirements={"type"="uteplenie-penopoliuretanom|tehnologia-stroitelstva-beskarkasnyh-angarov|stroitelstvo-zernohranilishh-i-ovoshehranilishh|stroitelstvo-zernohranilish|preimushhestva-beskarkasnogo-stroitelstva|karkasnye-i-beskarkasnye-angary|beskarkasnoe-arochnoe-stroitelstvo|aviatsionnye-angary|arochnye-angary-istoriya|arochnye-angary"})
     * @param $type
     * @return Response
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
     * @param Request $request
     * @param AngarCategory $angarCategory
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit(Request $request, AngarCategory $angarCategory, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(AngarCategoryType::class, $angarCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $angarCategory->setUpdated($dateTime);

            $image = $angarCategory->getImageBin();

            $fileUploader->setParticularPath('hangars-category/'.$angarCategory->getUrl().'/');
            $fileParams = $fileUploader->upload($image);
            $angarCategory->setImage('hangars-category/'.$angarCategory->getUrl().'/'.$fileParams['name_md5']);

            $imageSmall = $angarCategory->getSmallImageBin();

            $fileParams = $fileUploader->upload($imageSmall);
            $angarCategory->setImage('hangars-category/'.$angarCategory->getUrl().'/'.$fileParams['name_md5']);

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
