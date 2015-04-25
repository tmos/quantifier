<?php

namespace QF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QF\PlatformBundle\Entity\Track;
use QF\PlatformBundle\Form\TrackType;
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
     * @Route("/tracks.xml", name="track_all")
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
     * @Route("/track/{id}", name="track__id")
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
    public function createAction(Request $request)
    {
        $entity = new Track();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('track__show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Track entity.
     *
     * @param Track $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Track $entity)
    {
        $form = $this->createForm(new TrackType(), $entity, array(
            'action' => $this->generateUrl('track__create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Track entity.
     *
     * @Route("/new", name="track__new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Track();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }



    /**
     * Displays a form to edit an existing Track entity.
     *
     * @Route("/{id}/edit", name="track__edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Track entity.
    *
    * @param Track $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Track $entity)
    {
        $form = $this->createForm(new TrackType(), $entity, array(
            'action' => $this->generateUrl('track__update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Track entity.
     *
     * @Route("/{id}", name="track__update")
     * @Method("PUT")
     * @Template("QFPlatformBundle:Track:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('track__edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('track_'));
    }

    /**
     * Creates a form to delete a Track entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('track__delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
