<?php

namespace SafeBoardBundle\Controller;

use SafeBoardBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Reclamation controller.
 *
 * @Route("reclamation")
 */
class ReclamationController extends Controller
{
    /**
     * Lists all reclamation entities.
     *
     * @Route("/", name="reclamation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('SafeBoardBundle:Reclamation')->findAll();
        $data = $this->get('jms_serializer')->serialize($reclamations, 'json');
        $response = new Response($data);
        return $response;

    }

    /**
     * Creates a new reclamation entity.
     *
     * @Route("/new", name="reclamation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $data = $request->getContent();
        $reclamation = $this->get('jms_serializer')->deserialize($data, 'SafeBoardBundle\Entity\Reclamation', 'json');
        $form = $this->createForm('SafeBoardBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);


            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();

            return new Response('Reclamation ajouté avec succès');



    }



    /**
     * Displays a form to edit an existing reclamation entity.
     *
     * @Route("/{id}/edit", name="reclamation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->find($id);
        $data = $request->getContent();
        $deleteForm = $this->createDeleteForm($reclamation);
        $editForm = $this->createForm('SafeBoardBundle\Form\ReclamationType', $reclamation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $newdata = $this->get('jms_serializer')->deserialize($data, 'SafeBoardBundle\Entity\Reclamation', 'json');
            $reclamation->setNombreRec($newdata->getNombreRec());
            $this->getDoctrine()->getManager()->flush();
            $em->persist($reclamation);
            $em->flush();
            return new JsonResponse(["msg" => "success"], 200);

        }

        return $this->render('reclamation/edit.html.twig', array(
            'reclamation' => $reclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reclamation entity.
     *
     * @Route("/{id}", name="reclamation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request,$id)
    { $em = $this->getDoctrine()->getManager();
        $reclamation=$em->getRepository(Reclamation::class)->find($id);
        $form = $this->createDeleteForm($reclamation);
        $form->handleRequest($request);



            $em->remove($reclamation);
            $em->flush();


        return new Response('Reclamation supprimé avec succès') ;

    }

    /**
     * Creates a form to delete a reclamation entity.
     *
     * @param Reclamation $reclamation The reclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamation $reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamation_delete', array('id' => $reclamation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
