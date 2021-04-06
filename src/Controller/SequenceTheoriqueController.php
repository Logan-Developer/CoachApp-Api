<?php

namespace App\Controller;

use App\Entity\ActiviteSequenceTheorique;
use App\Entity\Atelier;
use App\Entity\SequenceTheorique;
use App\Form\ActivitesequencetheoriqueType;
use App\Form\SequencetheoriqueType;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
/**
 * @Route("/sequencetheorique")
 */
class SequenceTheoriqueController extends AbstractController
{
    /**
     * @Route("/", name="sequencetheorique_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sequencetheoriques = $this->getDoctrine()
            ->getRepository(SequenceTheorique::class)
            ->findAll();

        return $this->render('sequencetheorique/index.html.twig', [
            'sequencetheoriques' => $sequencetheoriques,
        ]);
    }

    /**
     * @Route("/donneInfoAtelier/", name="donneInfoAtelier_ajax", methods={"GET"})
     */
    public function donneInfoAtelier_ajax(Request $request): Response
    {
          $em = $this->getDoctrine()->getManager();


        $ateliers =  $em->getRepository(Atelier::class)
            ->createQueryBuilder("a")
            ->where("a.id = :idAtelier")
            ->setParameter("idAtelier", $request->query->get("atelierid"))
            ->getQuery()
            ->getResult();


        $responseArray = array(
                "unitedeperformance" => $ateliers[0]->getUnitedeperformance(),
                "unitedintensite" => $ateliers[0]->getUnitedintensite(),
            );


      return new JsonResponse($responseArray);
    }


    /**
     * @Route("/new", name="sequencetheorique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sequencetheorique = new SequenceTheorique();
        $form = $this->createForm(SequencetheoriqueType::class, $sequencetheorique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sequencetheorique);
            $entityManager->flush();

            return $this->redirectToRoute('sequencetheorique_index');
        }

        return $this->render('sequencetheorique/new.html.twig', [
            'sequencetheorique' => $sequencetheorique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/activitesequencetheorique_haut/{sequencetheorique}/{activitesequencetheorique}", name="activitesequencetheorique_haut", methods={"GET","POST"})
     * @Entity("sequencetheorique", expr="repository.find(sequencetheorique)")
     * @Entity("activitesequencetheorique", expr="repository.find(activitesequencetheorique)")
     */
    public function activitesequencetheorique_haut(SequenceTheorique $sequencetheorique, ActiviteSequenceTheorique $activitesequencetheorique, Request $request): Response
    {

        if($activitesequencetheorique->getOrdre() >= 1)
        {
            $ordre = $activitesequencetheorique->getOrdre();
            $activitesequencetheoriqueDessus = $this->getDoctrine()
                ->getRepository(ActiviteSequenceTheorique::class)
                ->findOneBy(['idsequencetheorique' => $sequencetheorique->getId(),
                          'ordre' =>  $ordre -1]);

            $activitesequencetheorique->setOrdre($ordre -1);
            $activitesequencetheoriqueDessus->setOrdre($ordre);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activitesequencetheorique);
            $entityManager->persist($activitesequencetheoriqueDessus);
            $entityManager->flush();

        }

        return $this->ReturnSequence($sequencetheorique);
    }

    /**
     * @Route("/activitesequencetheorique_bas/{sequencetheorique}/{activitesequencetheorique}", name="activitesequencetheorique_bas", methods={"GET","POST"})
     */
    public function activitesequencetheorique_bas(SequenceTheorique $sequencetheorique, ActiviteSequenceTheorique $activitesequencetheorique, Request $request): Response
    {
        $activitesequencetheoriques = $this->getDoctrine()
            ->getRepository(ActiviteSequenceTheorique::class)
            ->findBy(['idsequencetheorique' => $sequencetheorique->getId()]);

        if($activitesequencetheorique->getOrdre() < count($activitesequencetheoriques)-1)
        {
            $ordre = $activitesequencetheorique->getOrdre();
            $activitesequencetheoriqueDessous = $this->getDoctrine()
                ->getRepository(ActiviteSequenceTheorique::class)
                ->findOneBy(['idsequencetheorique' => $sequencetheorique->getId(),
                    'ordre' =>  $ordre +1]);

            $activitesequencetheorique->setOrdre($ordre +1);
            $activitesequencetheoriqueDessous->setOrdre($ordre);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activitesequencetheorique);
            $entityManager->persist($activitesequencetheoriqueDessous);
            $entityManager->flush();
        }
        return $this->ReturnSequence($sequencetheorique);
    }

    /**
     * @Route("/activitesequencetheorique_supprimer/{sequencetheorique}/{activitesequencetheorique}", name="activitesequencetheorique_supprimer", methods={"GET","POST"})
     */
    public function activitesequencetheorique_supprimer(SequenceTheorique $sequencetheorique, ActiviteSequenceTheorique $activitesequencetheorique, Request $request): Response
    {
       // $this->getUser();
        $expr = Criteria::expr();
        $criteria = Criteria::create();
        $criteria->where($expr->gt('ordre',  $activitesequencetheorique->getOrdre()));
        $criteria->andWhere($expr->eq('idsequencetheorique',  $sequencetheorique));
        $criteria->orderBy(['ordre' => Criteria::DESC]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($activitesequencetheorique);
        $entityManager->flush($activitesequencetheorique);

        $activitesequencetheoriqueDessous = $this->getDoctrine()
            ->getRepository(ActiviteSequenceTheorique::class)
            ->matching($criteria);

        $entityManager = $this->getDoctrine()->getManager();
        foreach($activitesequencetheoriqueDessous as $uneActivitesequencetheorique)
        {
            $uneActivitesequencetheorique->setOrdre($uneActivitesequencetheorique->getOrdre() -1 );
        }
        $entityManager->flush();

        return $this->ReturnSequence($sequencetheorique);
    }

    private function ReturnSequence(SequenceTheorique $sequencetheorique)
    {
        $ateliers=$this->getDoctrine()
            ->getRepository(Atelier::class)
            ->findAll();
        $atelier = $ateliers[0];
        $activitesequencetheorique = new ActiviteSequenceTheorique();
        $activitesequencetheorique->setIdatelier($atelier);
        $form = $this->createForm(ActivitesequencetheoriqueType::class, $activitesequencetheorique);

        /*Récupération de la dernière version des activités de cette séquence*/
        $activitesequencetheoriques = $this->getDoctrine()
            ->getRepository(ActiviteSequenceTheorique::class)
            ->findBy(['idsequencetheorique' => $sequencetheorique->getId()]
                ,['ordre' => 'ASC']);

        return $this->render('sequencetheorique/show.html.twig', [
            'sequencetheorique' => $sequencetheorique,
            'activitesequencetheoriques' => $activitesequencetheoriques,
            'form' => $form->createView(),
            'atelier' => $atelier
        ]);
    }


    /**
     * @Route("/{id}", name="sequencetheorique_show", methods={"GET","POST"})
     */
    public function show(SequenceTheorique $sequencetheorique, Request $request): Response
    {


        //Gestion depuis le formulaire
        $activitesequencetheorique = new ActiviteSequenceTheorique();
        $form = $this->createForm(ActivitesequencetheoriqueType::class, $activitesequencetheorique);
        $form->handleRequest($request);
        dump($activitesequencetheorique);



        if ($form->isSubmitted() && $form->isValid()) {

            /*Récupération de la liste des activités de cette séquence pour le count*/
            $activitesequencetheoriques = $this->getDoctrine()
                ->getRepository(ActiviteSequenceTheorique::class)
                ->findBy(['idsequencetheorique' => $sequencetheorique->getId()]);

            //Paramétrage de l'activité
            $activitesequencetheorique->setOrdre(count($activitesequencetheoriques));
            $activitesequencetheorique->setIdsequencetheorique($sequencetheorique);

            //Svg en BDD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activitesequencetheorique);
            $entityManager->flush();

            //MàJ du formulaire
            $activitesequencetheorique = new ActiviteSequenceTheorique();
            $form = $this->createForm(ActivitesequencetheoriqueType::class, $activitesequencetheorique);
        }

        //On charge l'atelier pour avoir ses infos
        $atelier = $activitesequencetheorique->getIdatelier();
        if(is_null($atelier))
        {
            $ateliers=$this->getDoctrine()
                ->getRepository(Atelier::class)
                ->findAll();
            $atelier = $ateliers[0];
            $form = $this->createForm(ActivitesequencetheoriqueType::class, $activitesequencetheorique);
        }

        /*Récupération de la dernière version des activités de cette séquence*/
        $activitesequencetheoriques = $this->getDoctrine()
            ->getRepository(ActiviteSequenceTheorique::class)
            ->findBy(['idsequencetheorique' => $sequencetheorique->getId()]);

        return $this->render('sequencetheorique/show.html.twig', [
            'sequencetheorique' => $sequencetheorique,
            'activitesequencetheoriques' => $activitesequencetheoriques,
            'form' => $form->createView(),
            'atelier' => $atelier
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sequencetheorique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SequenceTheorique $sequencetheorique): Response
    {
        $form = $this->createForm(SequencetheoriqueType::class, $sequencetheorique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sequencetheorique_index');
        }

        return $this->render('sequencetheorique/edit.html.twig', [
            'sequencetheorique' => $sequencetheorique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sequencetheorique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SequenceTheorique $sequencetheorique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sequencetheorique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sequencetheorique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sequencetheorique_index');
    }
}
