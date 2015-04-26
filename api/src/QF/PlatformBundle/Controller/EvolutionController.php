<?php

namespace QF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QF\PlatformBundle\Entity\Evolution;

/**
 * Evolution controller.
 *
 * @Route("/evolution")
 */
class EvolutionController extends Controller
{

    /**
     * Lists all Evolution entities.
     *
     * @Route("/{idTrack}", name="evolution__all")
     * @Method("GET")
     */
    public function getAllAction($idTrack)
    {
        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('QFPlatformBundle:Track')->find($idTrack);

        $entities = $track->getEvolutions();

        $serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Finds a Track entity.
     *
     * @Route("/e/{id}", name="evolution__get")
     * @Method("GET")
     */
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

        $serializedEntity = $this->container->get('serializer')->serialize($entity, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Creates a new Evolution entity.
     *
     * @Route("/{idTrack}", name="evolution__post")
     * @Method("POST")
     */
    public function postAction(Request $request, $idTrack)
    {
        $entity = new Evolution();

        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('QFPlatformBundle:Track')->find($idTrack);

        $test = true;
        $message = "";

        if (!$track) {
            $test = false;
            $message = "Unable to find Track entity";
        }

        if($track->getType() != 0) {
            $test = false;
            $message = "This track is a not of the right type";
        }

        if ($request->getMethod() == 'POST' && $test) {
            $dateCreation = new \DateTime();
            $dateChosen = new \DateTime();

            if ($request->get('value') != "") {
                $replace = array(".",",");
                $entity->setValue(str_replace($replace,".",$request->get('value')));
            } else {
                $test = false;
                $message = "Value is empty";
            }
            if ($request->get('dateChosen') != "") {
                $entity->setDateChosen($dateChosen->setTimestamp($request->get('dateChosen')));
            } else {
                $test = false;
                $message = "DateChosen is empty";
            }
            if ($request->get('comment') != "") {
                $entity->setComment($request->get('comment'));
            }

            if ($test) {
                $entity->setDateCreation($dateCreation);

                $track->addEvolution($entity);
                $em->persist($track);

                $em->persist($entity);
                $em->flush();
            }
        }

        $worked = array(
            'isSuccesful' => $test,
            'message' => $message
        );

        $serializedEntity = $this->container->get('serializer')->serialize($worked, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Edits an existing Evolution entity.
     *
     * @Route("/{id}", name="evolution__put")
     * @Method("PUT")
     */
    public function putAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message = "Unable to find Evolution entity";
        }

        if ($request->getMethod() == "PUT" && $test) {
            $changed = false;
            $newDateChosen = new \DateTime();
            if ($request->get('value') != "" && $request->get('value') != $entity->getValue()) {
                $replace = array(".",",");
                $entity->setValue(str_replace($replace,".",$request->get('value')));
                $changed = true;
            }
            if ($request->get('dateChosen') != "" ) {
                $newDateChosen->setTimestamp($request->get('dateChosen'));
                if ($newDateChosen->diff($entity->getDateChosen())) {
                    $entity->setDateChosen($newDateChosen);
                    $changed = true;
                }
            }
            if ($request->get('comment') != "" && $request->get('comment') != $entity->getComment()) {
                $entity->setComment($request->get('comment'));
                $changed = true;
            }

            if ($changed) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }
        }

        $worked = array(
            'isSuccesful' => $test,
            'message' => $message
        );

        $serializedEntity = $this->container->get('serializer')->serialize($worked, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Deletes a Evolution entity.
     *
     * @Route("/{id}", name="evolution__delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message = 'Unable to find Evolution entity';
        }

        if ($test) {
            $em->remove($entity);
            $em->flush();
        }


        $worked = array(
            'isSuccesful' => $test,
            'message' => $message
        );

        $serializedEntity = $this->container->get('serializer')->serialize($worked, 'json');

        return new Response($serializedEntity);
    }

}
