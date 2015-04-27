<?php

namespace QF\PlatformBundle\Controller;

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
 * @Route("/track/")
 */
class TrackController extends Controller
{
    /**
     * Lists all Track entities.
     *
     * @Route("/", name="track__all")
     * @Method("GET")
     */
    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QFPlatformBundle:Track')->findAll();

        $newEntities = array();

        foreach ($entities as $entity) {
            if ($entity->getType() == 0) {
                $newEntity['id'] = $entity->getId();
                $newEntity['title'] = $entity->getName();
                $newEntity['creator'] = $entity->getCreator();
                $newEntity['date'] = $entity->getDate();
                $newEntity['type'] = $entity->getType();
                $listData = $em->getRepository('QFPlatformBundle:Evolution')->findBy(
                    array('track' => $entity),
                    array('dateChosen' => 'asc'),
                    10,
                    0
                );
                $newListData = array();
                foreach ($listData as $data) {
                    $newListData[] = $data->getValue();
                }
                unset($newEntity['listings']);
                unset($newEntity['binaries']);
                $newEntity['evolutions'] = $newListData;
                $newEntities[] = $newEntity;
            } else if ($entity->getType() == 1){
                $newEntity['id'] = $entity->getId();
                $newEntity['title'] = $entity->getName();
                $newEntity['creator'] = $entity->getCreator();
                $newEntity['date'] = $entity->getDate();
                $newEntity['type'] = $entity->getType();
                unset($newEntity['evolutions']);
                unset($newEntity['binaries']);
                $newEntities[] = $newEntity;
            } else {
                $newEntity['id'] = $entity->getId();
                $newEntity['title'] = $entity->getName();
                $newEntity['creator'] = $entity->getCreator();
                $newEntity['date'] = $entity->getDate();
                $newEntity['type'] = $entity->getType();
                $listData = $em->getRepository('QFPlatformBundle:Evolution')->findBy(
                    array('track' => $entity),
                    array('dateChosen' => 'asc'),
                    10,
                    0
                );
                $newListData = array();
                foreach ($listData as $data) {
                    $newListData[] = $data->getDateChosen();
                }
                unset($newEntity['evolutions']);
                unset($newEntity['listings']);
                $newEntity['binaries'] = $newListData;
                $newEntities[] = $newEntity;
            }
        }

        $serializedEntity = $this->container->get('serializer')->serialize($newEntities, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Finds a Track entity.
     *
     * @Route("/{id}", name="track__get")
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
     * @Route("/", name="track__create")
     * @Method("POST")
     */
    public function postAction(Request $request)
    {
        $entity = new Track();

        $test = true;
        $message = "";

        if ($request->getMethod() == 'POST') {
            if ($request->get('title') != "") {
                $entity->setName($request->get('title'));
            } else {
                $test = false;
                $message = "Title empty";
            }
            if ($request->get('creator') != "") {
                $entity->setCreator($request->get('creator'));
            } else {
                $test = false;
                $message = "Creator is empty";
            }
            if ($request->get('type') != "") {
                $entity->setType($request->get('type'));
            } else {
                $test = false;
                $message = "Type is empty";
            }

            $entity->setDate(new \DateTime());

            if ($test) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }

            $worked = array(
                "isSuccessful" => $test,
                "message" => $message
            );

            $serializedEntity = $this->container->get('serializer')->serialize($worked, 'json');

            return new Response($serializedEntity);
        }
    }

    /**
     * Edits an existing Track entity.
     *
     * @Route("/{id}", name="track__put")
     * @Method("PUT")
     */
    public function putAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Track')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message = "Unable to find Track entity";
        }

        if ($request->getMethod() == "PUT" && $test) {
            $changed = false;
            if ($request->get('title') != "" && $request->get('title') != $entity->getName()) {
                $entity->setName($request->get('title'));
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
     * Deletes a Track entity.
     *
     * @Route("/{id}", name="track__delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Track')->find($id);

        $test = true;
        $message = "";

        if (!$entity) {
            $test = false;
            $message = "Unable to find Track entity";
        } else {
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
