<?php

namespace App\Controller;


use App\Entity\Tech;
use App\Entity\TechFeedback;
use App\Form\TechFeedbackType;
use App\Form\TechType;
use App\Repository\TechRepository;
use App\Service\FileUploader;
use function array_push;
use DateTime;
use Doctrine\ORM\Mapping\Entity;
use function dump;
use function explode;
use function implode;
use function json_encode;
use function strip_tags;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function time;
use function trim;
use function var_dump;


class TechController extends AbstractController
{


    /**
     * @Route("/tech/{url}", name="selhoztehnika_show")
     * @param $url
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($url, Request $request)
    {

        $tech = $this->getDoctrine()
            ->getRepository('App:Tech')
            ->findOneBy([
               'url' => $url
            ]);
        $title  = $tech->getTitle();
        $name = $tech->getName();
        $price = $tech->getPrice();
        $firstImagePath = "{{ asset('". $tech->getImage() ."') }}";
        $complectations = $tech->getComplectation()->toArray();
        $slider = $tech->getSlider()->toArray();
        $video = $tech->getVideo()->toArray();
        $feedbacks = (null !== $tech->getFeedback() && !empty($tech->getFeedback()))? $tech->getFeedback()->toArray() : [];

        $techFeedback = new TechFeedback();
        $createFeedback = $this->createFormBuilder($techFeedback)
            /*->setAction($this->generateUrl('tech_feedback_new'))*/
            ->setMethod('POST')
            /*->add('tech', EntityType::class, ['class'=> Tech::class])*/
            ->add('feedback', TextareaType::class/*, ['label' => 'Ваш отзыв']*/)
            ->add('title', TextType::class/*, ['label' => 'Ваш отзыв']*/)
            ->add('name', TextType::class/*, ['label' => 'Ваш отзыв']*/)
            ->add('save', SubmitType::class, ['label' => 'Оставить отзыв'])
            ->getForm();

        $createFeedback->handleRequest($request);

//        $createFeedback->get('tech')->setData($tech);
        if ($createFeedback->isSubmitted() && $createFeedback->isValid()) {

//            $techFeedbackForm = $form->getData();
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $techFeedback->setTech($tech);
            $techFeedback->setCreated($dateTime);

            $em = $this->getDoctrine()->getManager();
            $em->persist($techFeedback);
            $em->flush();

            return $this->redirectToRoute('selhoztehnika_show', ['url' => $url]);
        }

//        $createFeedbackView = $this->renderView('tech_feedback/_form.html.twig', ['form' => $createFeedback->createView()]);

        $content = $this->renderView('tech/content.html.twig', [
            'table' => $tech->getParcePerformance(),
            'description' => $tech->getDescription(),
            'video' => $video,
            'feedbacks' => $feedbacks,
            'form_feedback' => $createFeedback->createView(),
            'manual' => $tech->getManual(),
            'complectations' => $complectations,
            'slider' => $slider,
            'dimentions' => $tech->getDimentions(),
            'price' => $price,
            'tech' => $tech,
        ]);

//        dump($tech->getComplectation()->toArray());

        return $this->render('tech/tech.html.twig', [
            'title' =>  $title . ' от ' . $price . ' рублей',
            'name' => $name,
            'price' => $price,
            'tech' => $tech,
            'slider' => $slider,
            'firstImagePath' => $firstImagePath,
            'content' => $content,
        ]);
    }

    /**
     * @Route("/manager/tech", name="selhoztehnika_index")
     * @param TechRepository $techRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TechRepository $techRepository)
    {

        return $this->render('tech/index.html.twig', [
            'techs' => $techRepository->findAll()
        ]);
    }


    /**
     * @Route("/manager/tech/create/new", name="selhoztehnika_new")
     * @param Request $request
     *
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, FileUploader $fileUploader)
    {
        $tech = new Tech();
        $form = $this->createForm(TechType::class, $tech);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tech = $form->getData();
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $performance = $tech->getPerformance();

            // translate to Object and pack to JSON
            if (isset($performance)){

                $performance = explode(';', $performance);
                $performanceArr = [];
                foreach ($performance as $string) {
                    $row = explode(':', $string);
                    $performanceKey = trim(strip_tags($row[0]));
                    $performanceValue = trim(isset($row[1])? strip_tags($row[1]) : null);
                    if ($performanceValue) {
                        array_push($performanceArr, [$performanceKey => $performanceValue]);
                    } else if ($performanceKey){
                        array_push($performanceArr, [$performanceKey]);
                    }

                }
                $performanceJSON = json_encode($performanceArr);
                $tech->setPerformance($performanceJSON);
            }

            $tech->setCreated($dateTime);
            $tech->setUpdated($dateTime);

            $image = $tech->getImageBin();
            $imageSmall = $tech->getSmallImageBin();
            $imageMng = $tech->getMngImageBin();

            $fileUploader->setParticularPath('content/proizvodstvo-selhoztehniki/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $tech->setImage('assets/img/content/proizvodstvo-selhoztehniki/'.$imageUpload['name_md5']);

            $fileUploader->setParticularPath('content/_group/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $tech->setSmallImage('assets/img/content/_group/'.$imageSmallUpload['name_md5']);

            $fileUploader->setParticularPath('content/_mng/');
            $fileUploader->setWithThumbnail(false);
            $imageMngUpload = $fileUploader->upload($imageMng);
            $tech->setMngImage('assets/img/content/_mng/'.$imageMngUpload['name_md5']);
            $dimension = $tech->getDimentions();
            $dimension->setTech($tech);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tech);
            $em->persist($dimension);
            $em->flush();

            return $this->redirectToRoute('selhoztehnika_new');
        }

        $content = $this->renderView('tech/create.html.twig', ['form' => $form->createView()]);

        return $this->render('tech/new.html.twig', ['content' => $content]);


    }

    /**
     * @Route("/manager/tech/update/{url}", name="selhoztehnika_update")
     * @param Request $request
     * @param Tech $tech
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Tech $tech, FileUploader $fileUploader)
    {
        $tech->setPerformance($tech->getToStringPerformance());
        /*$tech->setImageBin(null);
        $tech->setSmallImageBin(null);
        $tech->setMngImageBin(null);*/
        $form = $this->createForm(TechType::class, $tech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

            $performance = $tech->getPerformance();

            // translate to Object and pack to JSON
            if (isset($performance)){

                $performance = explode(';', $performance);
                $performanceArr = [];
                foreach ($performance as $string) {
                    $row = explode(':', $string);
                    $performanceKey = trim(strip_tags($row[0]));
                    $performanceValue = trim(isset($row[1])? strip_tags($row[1]) : null);
                    if ($performanceValue) {
                        array_push($performanceArr, [$performanceKey => $performanceValue]);
                    } else if ($performanceKey){
                        array_push($performanceArr, [$performanceKey]);
                    }

                }
                $performanceJSON = json_encode($performanceArr);
                $tech->setPerformance($performanceJSON);
            }


            $tech->setUpdated($dateTime);

            $image = $tech->getImageBin();
            $imageSmall = $tech->getSmallImageBin();
            $imageMng = $tech->getMngImageBin();

            $fileUploader->setParticularPath('content/proizvodstvo-selhoztehniki/');
            $fileUploader->setWithThumbnail(false);
            $imageUpload = $fileUploader->upload($image);
            $tech->setImage('assets/img/content/proizvodstvo-selhoztehniki/'.$imageUpload['name_md5']);

            $fileUploader->setParticularPath('content/_group/');
            $fileUploader->setWithThumbnail(false);
            $imageSmallUpload = $fileUploader->upload($imageSmall);
            $tech->setSmallImage('assets/img/content/_group/'.$imageSmallUpload['name_md5']);

            $fileUploader->setParticularPath('content/_mng/');
            $fileUploader->setWithThumbnail(false);
            $imageMngUpload = $fileUploader->upload($imageMng);
            $tech->setMngImage('assets/img/content/_mng/'.$imageMngUpload['name_md5']);
            $dimension = $tech->getDimentions();
            $dimension->setTech($tech);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tech);
            $em->persist($dimension);
            $em->flush();

            return $this->redirectToRoute('selhoztehnika_show', ['url' => $tech->getUrl()]);
        }

        $content = $this->renderView('tech/create.html.twig', ['form' => $form->createView()]);

        return $this->render('tech/new.html.twig', ['content' => $content]);

    }
    public function delete(Request $request, Tech $id)
    {

    }
}
