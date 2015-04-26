<?php

namespace QF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QF\PlatformBundle\Entity\Binaries;

/**
 * Binaries controller.
 *
 * @Route("/binaries")
 */
class BinariesController extends Controller
{

    /**
     * Lists all Binaries entities.
     *
     * @Route("/{idTrack}", name="binaries__all")
     * @Method("GET")
     */
    public function getAllAction($idTrack)
    {
        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('QFPlatformBundle:Track')->find($idTrack);

        $entities = $track->getBinaries();

        $serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Finds a Binaries entity.
     *
     * @Route("/b/{id}", name="binaries__get")
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
     * Creates a new Binaries entity.
     *
     * @Route("/{idTrack}", name="binaries__post")
     * @Method("POST")
     */
    public function postAction(Request $request, $idTrack)
    {
        $entity = new Binaries();

        $test = true;
        $message = "";

        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('QFPlatformBundle:Track')->find($idTrack);

        if(!$track) {
            $test = false;
            $message = "This track is a not of the right type";
        }

        if($track->getType() != 2) {
            $test = false;
            $message = "Track is a not a binaries track";
        }

        if ($request->getMethod() == 'POST' && $test) {
            $dateCreation = new \DateTime();
            $dateChosen = new \DateTime();

            if ($request->get('dateChosen') != "") {
                $entity->setDateChosen($dateChosen->setTimestamp($request->get('dateChosen')));
            } else {
                $test = false;
                $message = "Date is empty";
            }
            if ($request->get('comment') != "") {
                $entity->setComment($request->get('comment'));
            }

            if($test) {
                $entity->setDateCreation($dateCreation);

                $track->addBinaries($entity);
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
     * Edits an existing Binaries entity.
     *
     * @Route("/{id}", name="binaries__put")
     * @Method("PUT")
     */
    public function putAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Binaries')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message= 'Unable to find Binaries entity';
        }

        if ($request->getMethod() == "PUT" && $test) {
            $changed = false;
            $newDateChosen = new \DateTime();
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
     * Deletes a Binaries entity.
     *
     * @Route("/{id}", name="binaries__delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('QFPlatformBundle:Binaries')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message = 'Unable to find Binaries entity';
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
