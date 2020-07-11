<?php

namespace SafeBoardBundle\Controller;

use SafeBoardBundle\Entity\Association;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SafeBoardBundle\Service\Validate;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class AssociationController extends Controller
{
    public function addAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data = $request->getContent();
//deserialize data: création d'un objet 'Refugee' à partir des données json envoyées
        $association = $this->get('jms_serializer')->deserialize($data, 'SafeBoardBundle\Entity\Association', 'json');
//ajout dans la base
        $em = $this->getDoctrine()->getManager();
        $em->persist($association);
        $em->flush();
        return new Response('Association ajouté avec succès');
    }

    public function getAllAssociationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $association = $em->getRepository(Association::class)->findAll();
        $data = $this->get('jms_serializer')->serialize($association, 'json');
        $response = new Response($data);
        return $response;
    }

    public function getAssociationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $association = $em->getRepository(Association::class)->findAll();
        $data = $this->get('jms_serializer')->serialize($association, 'json');
        $response = new Response($data);
        return $response;
    }

    public function updateAssociationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $association = $em->getRepository(Association::class)->find($id);
        $data = $request->getContent();
        $newdata = $this->get('jms_serializer')->deserialize($data, 'SafeBoardBundle\Entity\Association', 'json');
        $association->setEmail($newdata->getEmail());
        $association->setNomA($newdata->getNomA());
        $em->persist($association);
        $em->flush();
        return new JsonResponse(["msg" => "success"], 200);
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $refugee=$em->getRepository(Association::class)->find($id);
        $em->remove($refugee);
        $em->flush();
        return new Response('Association supprimé avec succès') ;
    }

}
