<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;

class UserController extends AbstractController
{
    /**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/user/list", name="user_list")
     */
    public function index(EntityManagerInterface $em)
    {
        $users = $em->getRepository('App:User')->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }


    /**
     * @Route("/user/new", name="add_user")
     * @param Request $request
     * @param EntityManagerInterface $em
     */

    public function addUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Utilisateur créé !');
        }


        return $this->render('user/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/update/{idUser}", name="update_user")
     * @ParamConverter("user", options={"id"="idUser"})
     * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $em
     */

    public function updateUser(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Utilisateur modifié !');
        }
        return $this->render('user/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/delete{idUser}", name="delete_user")
     * @ParamConverter("user", options={"id"="idUser"})
     * @param Request $request
     * @param User $user
     * @return Response
     *
     */

    public function deleteUser(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Utilisateur supprimé !');
        return $this->redirectToRoute('user_list');

    }

    /**
     * @Route("/user/updateProfile/{idUser}", name="updateProfile_user")
     * @ParamConverter("user", options={"id"="idUser"})
     * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $em
     */

    public function updateUserProfile(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Utilisateur créé !');
        }
        return $this->render('user/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }


}


