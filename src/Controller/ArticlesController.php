<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

///**
// * @Route("/articles")
// */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/agronomu-na-zametku", name="articles", methods="GET")
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function showAll(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', ['articles' => $articlesRepository->findAll()]);
    }

    /**
     * @Route("/manager/articles/", name="articles_index", methods="GET")
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', ['articles' => $articlesRepository->findAll()]);
    }

    /**
     * @Route("/manager/articles/new", name="articles_new", methods="GET|POST")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $image = $article->getImageBin();
            $fileUploader->setParticularPath('articles/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $article->setImage('assets/img/articles/'.$imageUpload['name_md5']);
            $article->setCreated($dateTime);
            $article->setUpdated($dateTime);


            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/articles/{id}", name="articles_show", methods="GET")
     * @param Articles $article
     * @return Response
     */
    public function show(Articles $article): Response
    {
        return $this->render('articles/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/manager/articles/{id}/edit", name="articles_edit", methods="GET|POST")
     * @param Request $request
     * @param Articles $article
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit(Request $request, Articles $article, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $image = $article->getImageBin();
            $fileUploader->setParticularPath('articles/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $article->setImage('assets/img/articles/'.$imageUpload['name_md5']);
            $article->setCreated($dateTime);
            $article->setUpdated($dateTime);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_edit', ['id' => $article->getId()]);
        }

        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/articles/{id}", name="articles_delete", methods="DELETE")
     * @param Request $request
     * @param Articles $article
     * @return Response
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('articles_index');
    }
}
