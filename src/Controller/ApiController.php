<?php


namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use App\Repository\TheoreticalSequenceActivityRepository;
use App\Repository\UserRepository;
use App\Repository\WorkshopCommentaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/workshops/{id}/commentaries", name="showCommentaries", methods={"GET"})
     * @param WorkshopCommentaryRepository $repository
     * @param $id
     * @return Response
     */
    public function showCommentaries(WorkshopCommentaryRepository $repository, $id): Response
    {
        return $this->json($repository->findBy(['workshop' => $id]), 200, [], []);
    }

    /**
     * @Route("/api/theoretical_sequences/{id}/activities", name="showSequenceActivities", methods={"GET"})
     * @param TheoreticalSequenceActivityRepository $repository
     * @param $id
     * @return Response
     */
    public function showSequenceActivities(TheoreticalSequenceActivityRepository $repository, $id): Response
    {
        return $this->json($repository->findAllByTheoreticalSequence($id), 200, [], []);
    }

    /**
     * @Route("/api/theoretical_sequences/{sequenceId}/activities/{ActivityId}", name="showSequenceActivity", methods={"GET"})
     * @param TheoreticalSequenceActivityRepository $repository
     * @param $sequenceId
     * @param $activityId
     * @return Response
     */
    public function showSequenceActivity(TheoreticalSequenceActivityRepository $repository, $sequenceId, $activityId): Response
    {
        return $this->json($repository->findOneByTheoreticalSequence($sequenceId, $activityId), 200, [], []);
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
                                      UserRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $json = $request->getContent();

        try {
            $userInfos = $serializer->deserialize($json, User::class, 'json');

            $user = $repository->findOneBy(['login' => $this->getUser()->getUsername()]);
            $user->setLastname($userInfos->getLastname());
            $user->setFirstname($userInfos->getFirstname());
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
                                              UserRepository $repository, UserPasswordEncoderInterface $encoder): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $json = $request->getContent();

        try {
            $password = $serializer->deserialize($json, User::class, 'json')->getPassword();

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