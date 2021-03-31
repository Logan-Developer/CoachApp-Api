<?php


namespace App\Controller;

use App\Repository\ActiviteSequenceTheoriqueRepository;
use App\Repository\CommentaireAtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/ateliers/{id}/commentaires", name="afficherCommentaires", methods={"GET"})
     * @param CommentaireAtelierRepository $repository
     * @param $id
     * @return Response
     */
    public function afficherCommentaires(CommentaireAtelierRepository $repository, $id): Response
    {
        return $this->json($repository->findBy(['atelier' => $id]), 200, [], []);
    }

    /**
     * @Route("/api/sequencetheoriques/{id}/activites", name="consulterActivitesSequence", methods={"GET"})
     * @param ActiviteSequenceTheoriqueRepository $repository
     * @param $id
     * @return Response
     */
    public function consulterActivitesSequence(ActiviteSequenceTheoriqueRepository $repository, $id): Response
    {
        return $this->json($repository->findAllBySequencetheorique($id), 200, [], []);
    }

    /**
     * @Route("/api/sequencetheoriques/{idSequence}/activites/{idActivite}", name="consulterActiviteSequence", methods={"GET"})
     * @param ActiviteSequenceTheoriqueRepository $repository
     * @param $idSequence
     * @param $idActivite
     * @return Response
     */
    public function consulterActiviteSequence(ActiviteSequenceTheoriqueRepository $repository, $idSequence, $idActivite): Response
    {
        return $this->json($repository->findOneBySequenceTheorique($idSequence, $idActivite), 200, [], []);
    }
}