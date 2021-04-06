<?php

namespace App\Controller;

use App\Entity\ActiviteSequenceTheorique;
use App\Entity\Atelier;
use App\Entity\CommentaireAtelier;
use App\Entity\SequenceTheorique;
use App\Form\AtelierType;
use App\Form\CommentaireAtelierType;
use App\Service\ContainerParametersHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**
 * @Route("/atelier")
 */
class AtelierController extends AbstractController
{
    /**
     * @Route("/", name="atelier_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ateliers = $this->getDoctrine()
            ->getRepository(Atelier::class)
            ->findAll();

        return $this->render('atelier/index.html.twig', [
            'ateliers' => $ateliers,
        ]);
    }

    /**
     * @Route("/new", name="atelier_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger, ContainerParametersHelper $pathHelpers): Response
    {
        $atelier = new Atelier();
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $form['image']->getData();
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            $dir = $pathHelpers->getApplicationRootDir()."/public/image/";
            $file->move($dir, $newFilename);

            $atelier->setImage($newFilename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($atelier);
            $entityManager->flush();

            return $this->redirectToRoute('atelier_index');
        }

        return $this->render('atelier/new.html.twig', [
            'atelier' => $atelier,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/supprimerCommentaire/{atelier}/{commentaire}", name="supprimerCommentaire", methods={"GET"})
     * @Entity("Atelier", expr="repository.find(atelier)")
     * @Entity("CommentaireAtelier", expr="repository.find(commentaire)")
     */
    public function supprimerCommentaire(Atelier $atelier, CommentaireAtelier $commentaireAtelier, Request $request): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($commentaireAtelier);
        $entityManager->flush($commentaireAtelier);



        $commentaireAtelier = new CommentaireAtelier();
        $form = $this->createForm(CommentaireAtelierType::class, $commentaireAtelier);
        $form->handleRequest($request);

        return $this->render('atelier/show.html.twig', [
            'atelier' => $atelier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="atelier_show", methods={"GET","POST"})
     */
    public function show(Atelier $atelier, Request $request): Response
    {

        $commentaireAtelier = new CommentaireAtelier();
        $form = $this->createForm(CommentaireAtelierType::class, $commentaireAtelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commentaireAtelier->setDate(new \DateTime());
            $commentaireAtelier->setProprietaire($this->getUser());
            $commentaireAtelier->setAtelier($atelier);
            $entityManager->persist($commentaireAtelier);
            $entityManager->flush();
        }
        return $this->render('atelier/show.html.twig', [
            'atelier' => $atelier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="atelier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Atelier $atelier, SluggerInterface $slugger, ContainerParametersHelper $pathHelpers): Response
    {
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            $dir = $pathHelpers->getApplicationRootDir()."/public/image/";
            $file->move($dir, $newFilename);

            $atelier->setImage($newFilename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($atelier);
            $entityManager->flush();

            return $this->redirectToRoute('atelier_index');

        }

        return $this->render('atelier/edit.html.twig', [
            'atelier' => $atelier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="atelier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Atelier $atelier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$atelier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($atelier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('atelier_index');
    }
}
