<?php

namespace QF\PlatformBundle\Controller;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QF\PlatformBundle\Entity\Track;
use Symfony\Component\HttpFoundation\Response;

/**
 * Track controller.
 *
 * @Route("/")
 */
class TrackController extends Controller
{
    /**
     * Lists all Track entities.
     *
     * @Route("/tracks", name="track__all")
     * @Method("GET")
     */
    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QFPlatformBundle:Track')->findAll();

        $serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Finds a Track entity.
     *
     * @Route("/track/{id}", name="track__show")
     * @Method("GET")
     */
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $serializedEntity = $this->container->get('serializer')->serialize($entity, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Creates a new Track entity.
     *
     * @Route("/track", name="track__create")
     * @Method("POST")
     */
    public function postAction(Request $request)
    {
        $entity = new Track();

        if ($request->getMethod() == 'POST') {
            $date = new \DateTime();
            if ($request->get('name') != "") {
                $entity->setName($request->get('name'));
            } else {
                throw new \Exception("Name empty");
            }
            if ($request->get('creator') != "") {
                $entity->setCreator($request->get('creator'));
            } else {
                throw new \Exception("Creator empty");
            }
            if ($request->get('date') != "") {
                $entity->setDate($date->setTimestamp($request->get('date')));
            } else {
                throw new \Exception("Date empty");
            }
            if ($request->get('type') != "") {
                $entity->setType($request->get('type'));
            } else {
                throw new \Exception("Type empty");
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('track__show', array('id' => $entity->getId())));
        } else {
            throw $this->createNotFoundException('POST not good');
        }

    }

    /**
     * Edits an existing Track entity.
     *
     * @Route("/track/{id}", name="track__update")
     * @Method("PUT")
     */
    public function putAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        if ($request->getMethod() == "PUT") {

            $em->flush();

            return $this->redirect($this->generateUrl('track__edit', array('id' => $id)));
        }

    }

    /**
     * Deletes a Track entity.
     *
     * @Route("/track/{id}", name="track__delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('QFPlatformBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $em->remove($entity);
        $em->flush();



        return $this->forward("QFPlatformBundle:Track:getAll");
    }
}
