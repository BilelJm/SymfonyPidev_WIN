<?php

namespace App\Controller;



use App\Filter\Search;
use App\Form\ContactType;
use App\Form\SearchType;
use App\Repository\CategoryRepository;
use App\Repository\RegionRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgrammeRepository;
use Knp\Component\Pager\PaginatorInterface;







class ProgController extends AbstractController
{
    /**
     * @Route("/prog", name="prog")
     */
    public function index(): Response
    {
        return $this->render('prog/index.html.twig', [
            'controller_name' => 'ProgController',
        ]);
    }

    /**
     * @Route("/programmes", name="programmes")
     */
    public function programmes(ProgrammeRepository $programmeRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data= new Search();
        $form=$this->createForm(SearchType::class,$data);

        $form->handleRequest($request);
        $programme = $programmeRepository->findSearch($data);
        $programme = $paginator->paginate($programme, $request->query->getInt('page', 1), 2);
        return $this->render('programme/programmes.html.twig', [
            'programmes' => $programme,
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('prog/about.html.twig', [
            'controller_name' => 'ProgController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */

        public function contact(Request $request , \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            $message = (new \Swift_Message('You Got Mail!'))
                ->setFrom($contactFormData['email'])

                ->setTo('28401mansurahails@randomail.io')

                ->setBody(
                    $contactFormData['message'],
                    'text/plain'
                );

            $mailer->send($message);

            return $this->redirectToRoute('contact');

        }
        return $this->render('emails/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/calendar", name="calendar")
     */
    public function calendar(ProgrammeRepository $programmeRepository): Response
    {
        $programmes=$programmeRepository->findAll();

        $tab=[];
        foreach ($programmes as $programme){

            $tab[]=[
                'title' => $programme->getTitre(),
                'date' => $programme->getDate()->format('Y-m-d'),
                'description' => $programme->getDescription(),
                'adresse' => $programme->getAdresse(),
                'guide' => $programme->getGuide(),
                'transport' => $programme->getTransport(),
            ];


        }

        $data= json_encode($tab);

        return $this->render('programme/calendar.html.twig', compact('data')

        );
    }
    /**
         * @Route("/chart", name="chart")
     */
    public function chart(CategoryRepository $categoryRepository,ProgrammeRepository $programmeRepository,RegionRepository $regionRepository): Response
    {
        $categories=$categoryRepository->findAll();
        $catNom=[];
        $catcolor=[];
        $catcount=[];

        foreach ($categories as $category){
            $catNom[]= $category->getTitre();
            $catcolor[]=$category->getColor();
            $catcount[]=count($category->getProgrammes());
        }
        $regions=$regionRepository->findAll();
        $regNom=[];
        $regcolor=[];
        $regcount=[];

        foreach ($regions as $region){
            $regNom[]= $region->getNom();
            $regcolor[]=$region->getColor();
            $regcount[]=count($region->getProgrammes());
        }

        $programmes=$programmeRepository->countByDate();
        $dates=[];
        $progcount=[];

        foreach ($programmes as $programme){
            $dates[]= $programme['date'];
            $progcount[]= $programme['count'];
        }




        return $this->render('programme/chart.html.twig', [
            'catNom'=>json_encode($catNom),
            'catcolor'=>json_encode($catcolor),
           'catcount'=>json_encode($catcount),
            'regNom'=>json_encode($regNom),
            'regcolor'=>json_encode($regcolor),
            'regcount'=>json_encode($regcount),
            'dates'=>json_encode($dates),
            'progcount'=>json_encode($progcount)


        ]);
    }


}
