<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Editor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\EditorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class EditorController extends AbstractController
{
    /**
     * @Route("/editor/list", name="editor_list")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $editors = $em->getRepository('App:Editor')->findAll();
        return $this->render('editor/index.html.twig', [
            'editors' => $editors,
        ]);
    }

    /**
     * @Route("/editor/infos/{idEditor}", name="editor_infos")
     * @ParamConverter("editor", options={"id"="idEditor"})
     * @param Editor $editor
     * @return Response
     */

    public function getInfos(Editor $editor): Response
    {
        return $this->render('editor/infos.html.twig', [
            'editor' => $editor
        ]);
    }

    /**
     * @Route("/editor/new", name="add_editor")
     * @Security("is_granted('ROLE_ADMIN') and is_granted('IS_AUTHENTICATED_FULLY')")
     * @param Request $request
     * @return Response
     *
     */

    public function addEditor(Request $request, EntityManagerInterface $em): Response
    {
        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($editor);
            $em->flush();

            $this->addFlash('success', 'Editeur ajouté !');
        }
        return $this->render('editor/form.html.twig', [
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/editor/edit{idEditor}", name="update_editor")
     * @Security("is_granted('ROLE_ADMIN') and is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("editor", options={"id"="idEditor"})
     * @param Request $request
     * @param Editor $editor
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     *
     */

    public function updateEditor(Request $request, Editor $editor, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($editor);
            $em->flush();

            $this->addFlash('success', 'Editeur modifié !');
        }
        return $this->render('editor/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/editor/delete{idEditor}", name="delete_editor")
     * @Security("is_granted('ROLE_ADMIN') and is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("editor", options={"id"="idEditor"})
     * @param Request $request
     * @param Editor $editor
     * @return Response
     *
     */

    public function deleteEditor(Editor $editor, EntityManagerInterface $em): Response
    {

        foreach($editor->getVideoGames() as $game) {
            $editor->removeVideoGame($game);
        }

        $em->remove($editor);
        $em->flush();

        $this->addFlash('success', 'Editeur supprimé !');

            return $this->redirectToRoute('editor_list');


    }
}


