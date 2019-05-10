<?php

namespace App\Controller;

use App\Entity\TechFeedback;
use App\Form\TechFeedbackType;
use App\Repository\TechFeedbackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function var_dump;

/**
 * @Route("/manager/feedback/tech")
 */
class TechFeedbackController extends AbstractController
{
    /**
     * @Route("/", name="tech_feedback_index", methods="GET")
     * @param TechFeedbackRepository $techFeedbackRepository
     * @return Response
     */
    public function index(TechFeedbackRepository $techFeedbackRepository): Response
    {
        return $this->render('tech_feedback/index.html.twig', ['tech_feedbacks' => $techFeedbackRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tech_feedback_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $techFeedback = new TechFeedback();
        $form = $this->createForm(TechFeedbackType::class, $techFeedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            $techFeedbackForm = $form->getData();
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $techFeedback->setCreated($dateTime);

            $em = $this->getDoctrine()->getManager();
            $em->persist($techFeedback);
            $em->flush();


            return $this->redirectToRoute('tech_feedback_index');
        }

        return $this->render('tech_feedback/new.html.twig', [
            'tech_feedback' => $techFeedback,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tech_feedback_show", methods="GET")
     */
    public function show(TechFeedback $techFeedback): Response
    {
        return $this->render('tech_feedback/show.html.twig', ['tech_feedback' => $techFeedback]);
    }

    /**
     * @Route("/{id}/edit", name="tech_feedback_edit", methods="GET|POST")
     */
    public function edit(Request $request, TechFeedback $techFeedback): Response
    {
        $form = $this->createForm(TechFeedbackType::class, $techFeedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tech_feedback_edit', ['id' => $techFeedback->getId()]);
        }

        return $this->render('tech_feedback/edit.html.twig', [
            'tech_feedback' => $techFeedback,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tech_feedback_delete", methods="DELETE")
     */
    public function delete(Request $request, TechFeedback $techFeedback): Response
    {
        if ($this->isCsrfTokenValid('delete'.$techFeedback->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($techFeedback);
            $em->flush();
        }

        return $this->redirectToRoute('tech_feedback_index');
    }
}
