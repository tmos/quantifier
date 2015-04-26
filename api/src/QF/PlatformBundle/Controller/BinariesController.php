<?php

namespace QF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QF\PlatformBundle\Entity\Binaries;
use QF\PlatformBundle\Form\BinariesType;

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
     * @Route("/", name="binaries")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QFPlatformBundle:Binaries')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Binaries entity.
     *
     * @Route("/", name="binaries_create")
     * @Method("POST")
     * @Template("QFPlatformBundle:Binaries:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Binaries();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('binaries_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Binaries entity.
     *
     * @param Binaries $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Binaries $entity)
    {
        $form = $this->createForm(new BinariesType(), $entity, array(
            'action' => $this->generateUrl('binaries_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Binaries entity.
     *
     * @Route("/new", name="binaries_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Binaries();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Binaries entity.
     *
     * @Route("/{id}", name="binaries_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Binaries')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Binaries entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Binaries entity.
     *
     * @Route("/{id}/edit", name="binaries_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Binaries')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Binaries entity.');
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
    * Creates a form to edit a Binaries entity.
    *
    * @param Binaries $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Binaries $entity)
    {
        $form = $this->createForm(new BinariesType(), $entity, array(
            'action' => $this->generateUrl('binaries_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Binaries entity.
     *
     * @Route("/{id}", name="binaries_update")
     * @Method("PUT")
     * @Template("QFPlatformBundle:Binaries:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QFPlatformBundle:Binaries')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Binaries entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('binaries_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Binaries entity.
     *
     * @Route("/{id}", name="binaries_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QFPlatformBundle:Binaries')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Binaries entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('binaries'));
    }

    /**
     * Creates a form to delete a Binaries entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('binaries_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
