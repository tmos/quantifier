<?php

namespace QF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QF\PlatformBundle\Entity\Evolution;
use QF\PlatformBundle\Form\EvolutionType;

/**
 * Evolution controller.
 *
 * @Route("/")
 */
class EvolutionController extends Controller
{

    /**
     * Lists all Evolution entities.
     *
     * @Route("/evolutions/{id}", name="evolution__all")
     * @Method("GET")
     */
    public function getAllAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

        $entities = $track->getAllData();

        $serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');

        return new Response($serializedEntity);
    }

    /**
     * Finds a Track entity.
     *
     * @Route("/evolution/{id}", name="evolution__get")
     * @Method("GET")
     */
    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QFPlatformBundle:Evolution')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Evolution entity.
     *
     * @Route("/", name="evolution_create")
     * @Method("POST")
     * @Template("QFPlatformBundle:Evolution:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Evolution();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evolution_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Evolution entity.
     *
     * @param Evolution $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Evolution $entity)
    {
        $form = $this->createForm(new EvolutionType(), $entity, array(
            'action' => $this->generateUrl('evolution_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Evolution entity.
     *
     * @Route("/new", name="evolution_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Evolution();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Evolution entity.
     *
     * @Route("/{id}", name="evolution_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evolution entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Evolution entity.
     *
     * @Route("/{id}/edit", name="evolution_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evolution entity.');
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
    * Creates a form to edit a Evolution entity.
    *
    * @param Evolution $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Evolution $entity)
    {
        $form = $this->createForm(new EvolutionType(), $entity, array(
            'action' => $this->generateUrl('evolution_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Evolution entity.
     *
     * @Route("/{id}", name="evolution_update")
     * @Method("PUT")
     * @Template("QFPlatformBundle:Evolution:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evolution entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('evolution_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Evolution entity.
     *
     * @Route("/{id}", name="evolution_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QFPlatformBundle:Evolution')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evolution entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evolution'));
    }

    /**
     * Creates a form to delete a Evolution entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evolution_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
