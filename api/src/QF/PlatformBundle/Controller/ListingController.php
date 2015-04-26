<?php

namespace QF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QF\PlatformBundle\Entity\Listing;

/**
 * Listing controller.
 *
 * @Route("/listing")
 */
class ListingController extends Controller
{
    /**
     * Lists all Listing entities.
     *
     * @Route("/{idTrack}", name="listing__all")
     * @Method("GET")
     */
    public function getAllAction($idTrack)
    {
        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('QFPlatformBundle:Track')->find($idTrack);

        $entities = $track->getListings();

        $serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Finds a Listing entity.
     *
     * @Route("/l/{id}", name="listing__get")
     * @Method("GET")
     */
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Listing')->find($id);

        $serializedEntity = $this->container->get('serializer')->serialize($entity, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Creates a new Listing entity.
     *
     * @Route("/{idTrack}", name="listing__post")
     * @Method("POST")
     */
    public function postAction(Request $request, $idTrack)
    {
        $entity = new Listing();

        $test = true;
        $message = "";

        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('QFPlatformBundle:Track')->find($idTrack);

        if(!$track) {
            $test = false;
            $message = "Unable to find Track entity";
        }
        if($track->getType() != 1) {
            $test = false;
            $message = "This track is a not of the right type";
        }

        if ($request->getMethod() == 'POST' && $test) {
            $dateCreation = new \DateTime();
            $dateChosen = new \DateTime();

            if ($request->get('value') != "") {
                $entity->setValue($request->get('value'));
            } else {
                $test = false;
                $message = "Value is empty";
            }
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

                $track->addListing($entity);
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
     * Edits an existing Listing entity.
     *
     * @Route("/{id}", name="listing__put")
     * @Method("PUT")
     */
    public function putAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Listing')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message= 'Unable to find Listing entity';
        }

        if ($request->getMethod() == "PUT" && $test) {
            $changed = false;
            $newDateChosen = new \DateTime();

            if ($request->get('value') != "" && $request->get('value') != $entity->getValue()) {
                $entity->setValue($request->get('value'));
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
     * Deletes a Listing entity.
     *
     * @Route("/{id}", name="listing__delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('QFPlatformBundle:Listing')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message = 'Unable to find Listing entity';
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