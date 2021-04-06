<?php


namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Utilisateur;
use App\Repository\ActiviteSequenceTheoriqueRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\CommentaireAtelierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @Route("/api/sequence_theorique/{id}/activites", name="consulterActivitesSequence", methods={"GET"})
     * @param ActiviteSequenceTheoriqueRepository $repository
     * @param $id
     * @return Response
     */
    public function consulterActivitesSequence(ActiviteSequenceTheoriqueRepository $repository, $id): Response
    {
        return $this->json($repository->findAllBySequencetheorique($id), 200, [], []);
    }

    /**
     * @Route("/api/sequence_theorique/{idSequence}/activites/{idActivite}", name="consulterActiviteSequence", methods={"GET"})
     * @param ActiviteSequenceTheoriqueRepository $repository
     * @param $idSequence
     * @param $idActivite
     * @return Response
     */
    public function consulterActiviteSequence(ActiviteSequenceTheoriqueRepository $repository, $idSequence, $idActivite): Response
    {
        return $this->json($repository->findOneBySequenceTheorique($idSequence, $idActivite), 200, [], []);
    }

    /**
     * @Route("/api/currentUser", name="getCurrentUser", methods={"GET"})
     */
    public function getCurrentUser(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->eraseCredentials();
        return $this->json($user);
    }

    /**
     * @Route("/api/currentUser", name="modifyCurrentUser", methods={"PUT"})
     */
    public function modifyCurrentUser(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $em,
        UtilisateurRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $json = $request->getContent();

        try {
            $userInfos = $serializer->deserialize($json, Utilisateur::class, 'json');

            $user = $repository->findOneBy(['login' => $this->getUser()->getUsername()]);
            $user->setNomUtilisateur($userInfos->getNomUtilisateur());
            $user->setPrenomUtilisateur($userInfos->getPrenomUtilisateur());
            $user->setEmail($userInfos->getEmail());

            $errors = $validator->validate($user);
            if ($errors != null && count($errors) > 0) {
                return $this->json($errors, 400);
            }

            $em->flush();

            return $this->json($user, 200, [], []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
               'status' => 400,
               'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route("/api/currentUser/password", name="modifyCurrentUserPassword", methods={"PUT"})
     */
    public function modifyCurrentUserPassword(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $em,
                                              UtilisateurRepository $repository, UserPasswordEncoderInterface $encoder): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $json = $request->getContent();

        try {
            $password = $serializer->deserialize($json, Utilisateur::class, 'json')->getPassword();

            $user = $repository->findOneBy(['login' => $this->getUser()->getUsername()]);

            $passEncode = $encoder->encodePassword($user, $password); //Encodage du mot de passe
            $user->setPassword($passEncode);

            $errors = $validator->validate($user);
            if ($errors != null && count($errors) > 0) {
                return $this->json($errors, 400);
            }

            $em->flush();

            return $this->json($user, 200, [], []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}