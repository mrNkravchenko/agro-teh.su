<?php

namespace App\Controller;

use App\Entity\Email;
use App\Form\EmailType;
use App\Repository\EmailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EmailController extends AbstractController
{

    /**
     * @Route("/callback", name="callback", methods="POST")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendEmail(Request $request, \Swift_Mailer $mailer)
    {

        $params = $request->request->all();
        $name = $params['name'];
        $phone = $params['phone'];
        $email = $params['email'];
        $comment = $params['comment'];
        $page = isset($params['page']) ?? $params['page'];
        $type = isset($params['type']) ? $params['type'] : 'callback';
        $sender = isset($params['sender'])? $params['sender'] : 'no-reply@agro-teh.su';
        $recipient = isset($params['recipient'])? $params['recipient'] : 'mail@agro-teh.su';

        $check = 0;


        switch ($type) {

            case 'callback':
                $message = (new \Swift_Message('Hello Email'))
                    ->setFrom($sender)
                    ->setTo($recipient)
                    ->setSubject('Обратный звонок')
                    ->setBody(
                        $this->renderView(
                        // templates/emails/registration.html.twig
                            'email/callback.html.twig',
                            [
                                'name' => $name,
                                'phone' => $phone,
                                'email' => $email,
                                'comment' => $comment,
                            ]
                        ),
                        'text/html'
                    );
                $check = $mailer->send($message);
                break;

        }

        if ($check) {
            $email = new Email();
            $em = $this->getDoctrine()->getManager();

            $email->setSender($sender);
            $email->setRecipient($recipient);
            $email->setContent(json_encode(
                [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'comment' => $comment,
            ]
            ));

            $em->persist($email);
            $em->flush();
        }


        return $this->json(['status' => $check, 'params' => $params]);

    }

    /**
     * @Route("/manager/email/", name="email_index", methods="GET")
     * @param EmailRepository $emailRepository
     * @return Response
     */
    public function index(EmailRepository $emailRepository): Response
    {
        return $this->render('email/index.html.twig', ['emails' => $emailRepository->findAll()]);
    }

    /**
     * @Route("/manager/email/new", name="email_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $email = new Email();
        $form = $this->createForm(EmailType::class, $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();

            return $this->redirectToRoute('email_index');
        }

        return $this->render('email/new.html.twig', [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/email/{id}", name="email_show", methods="GET")
     * @param Email $email
     * @return Response
     */
    public function show(Email $email): Response
    {
        return $this->render('email/show.html.twig', ['email' => $email]);
    }

    /**
     * @Route("/manager/email/{id}/edit", name="email_edit", methods="GET|POST")
     * @param Request $request
     * @param Email $email
     * @return Response
     */
    public function edit(Request $request, Email $email): Response
    {
        $form = $this->createForm(EmailType::class, $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('email_edit', ['id' => $email->getId()]);
        }

        return $this->render('email/edit.html.twig', [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/email/{id}", name="email_delete", methods="DELETE")
     * @param Request $request
     * @param Email $email
     * @return Response
     */
    public function delete(Request $request, Email $email): Response
    {
        if ($this->isCsrfTokenValid('delete'.$email->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($email);
            $em->flush();
        }

        return $this->redirectToRoute('email_index');
    }
}
