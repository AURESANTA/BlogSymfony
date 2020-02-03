<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Form\VideoGameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class VideoGameController extends AbstractController
{
    /**
     * @Route("/game", name="video_game")
     */
    public function index()
    {
        return $this->render('video_game/index.html.twig', [
            'controller_name' => 'VideoGameController',
        ]);
    }

    /**
     * @Route("/game/infos/{idVideoGame}", name="game_infos")
     * @ParamConverter("videoGame", options={"id"="idVideoGame"})
     * @param VideoGame $videoGame
     * @return Response
     */

    public function getInfos(VideoGame $videoGame):Response
    {
        return $this->render('video_game/infos.html.twig', [
            'game' => $videoGame
        ]);
    }

    /**
     * @route("/game/new", name="add_game")
     * @Security("is_granted('ROLE_ADMIN') and is_granted('IS_AUTHENTICATED_FULLY')")
     * @param Request $request
     * @return Response
     */

    public function addGame(Request $request, EntityManagerInterface $em):Response
    {
        $videoGame = new VideoGame();
        $form = $this->createForm(VideoGameType::class, $videoGame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $em->persist($videoGame);
            $em->flush();

            $this->addFlash('success', 'Jeu ajouté !');
        }

        return $this->render('video_game/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/game/edit/{idVideoGame}", name="update_game")
     * @Security("is_granted('ROLE_ADMIN') and is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter ("videoGame", options={"id"="idVideoGame"})
     * @param VideoGame $videoGame
     * @param Request $request
     * @return Response
     */

    public function updateGame(Request $request, VideoGame $videoGame, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(VideoGameType::class, $videoGame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($videoGame);
            $em->flush();

            $this->addFlash('success', 'Jeu modifié !');
        }

        return $this->render('video_game/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/game/deletebis/{idVideoGame}", name="deletebis_game")
     * @ParamConverter ("videoGame", options={"id"="idVideoGame"})
     * @Security("is_granted('ROLE_ADMIN') and is_granted('IS_AUTHENTICATED_FULLY')")
     * @param VideoGame $videoGame
     * @param Request $request
     * @return Response
     *
     */

    public function deletebisGame(VideoGame $videoGame, EntityManagerInterface $em): Response
    {
        $em->remove($videoGame);
        $em->flush();

        $this->addFlash('success', 'Jeu supprimé !');

        return $this->redirectToRoute('home');
    }
}
