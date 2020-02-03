<?php

namespace App\Controller;

use App\Entity\VideoGame;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $em)
    {
        $games = $em->getRepository('App:VideoGame')->findAll();
        return $this->render('home/index.html.twig', [
            'games' => $games,
        ]);
    }
}
