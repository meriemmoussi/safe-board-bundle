<?php

namespace SafeBoardBundle\Controller;

use SafeBoardBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReclamationController extends Controller
{
    public function addReclamationAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
//deserialize data: création d'un objet 'Refugee' à partir des données json envoyées
        $association = $this->get('jms_serializer')->deserialize($data, 'SafeBoardBundle\Entity\Reclamation', 'json');
//ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($association);
        $em->flush();
        return new Response('Reclamation ajouté avec succès');
    }

    public function getAllReclamationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->findAll();
        $data = $this->get('jms_serializer')->serialize($reclamation, 'json');
        $response = new Response($data);
        return $response;

    }

    public function updateReclamationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->find($id);
        $data = $request->getContent();
        $newdata = $this->get('jms_serializer')->deserialize($data, 'SafeBoardBundle\Entity\Reclamation', 'json');
        $reclamation->ssetNombreRec($newdata->getNombreRec());

        $em->persist($reclamation);
        $em->flush();
        return new JsonResponse(["msg" => "success"], 200);
    }

    public function deleteReclamationAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $refugee=$em->getRepository(Reclamation::class)->find($id);
        $em->remove($refugee);
        $em->flush();
        return new Response('Reclamation supprimé avec succès') ;
    }

}
