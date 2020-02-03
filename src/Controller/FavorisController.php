<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation;
use App\Entity\VideoGame;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FavorisController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/favorites", name="favorites")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function index()
    {
        $favorites = $this->getUser()->getFavorite();

        return $this->render('favoris/index.html.twig', [
            'favorites' => $favorites,
        ]);
    }

    /**
     * @Route("/favorites/new/{id}", name="add_favorite")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @ParamConverter("jeuxVideo", options={"id"="id"})
     */

    public function addFavoriteGame(VideoGame $videoGame)
    {
        $this->getUser()->addFavorite($videoGame);
        $this->entityManager->persist($this->getUser());
        $this->entityManager->flush();

        $this->addFlash('success', 'Ajouté en favori !');

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/favorites/delete/{id}", name="delete_favorite")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @ParamConverter("jeuxVideo", options={"mapping"={"id"="id"}})
     */

    public function deleteFavoriteGame(VideoGame $videoGame)
    {
        $this->getUser()->removeFavorite($videoGame);
        $this->entityManager->persist($this->getUser());
        $this->entityManager->flush();

        $this->addFlash('success', 'Supprimé des favoris !');

        return $this->redirectToRoute('favorites');
    }
}