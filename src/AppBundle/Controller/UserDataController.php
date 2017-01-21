<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("userdata")
 */
class UserDataController extends Controller
{
    /**
     * @Route("/", name="userdata_index")
     * @Method("GET")
     * @Template("AppBundle:userdata:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userDatas = $this->get('entity.service')->showAllRecords('AppBundle:UserData');

        return array(
            'userDatas' => $userDatas,
        );
    }

    /**
     * @Route("/{id}/edit", name="userdata_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserData $userDatum)
    {
        $deleteForm = $this->createDeleteForm($userDatum);
        $editForm = $this->createForm('AppBundle\Form\UserDataType', $userDatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userdata_edit', array('id' => $userDatum->getId()));
        }

        return $this->render('userdata/edit.html.twig', array(
            'userDatum' => $userDatum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="userdata_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserData $userDatum)
    {
        $form = $this->createDeleteForm($userDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userDatum);
            $em->flush($userDatum);
        }

        return $this->redirectToRoute('userdata_index');
    }

    /**
     * @param UserData $userDatum The userDatum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserData $userDatum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userdata_delete', array('id' => $userDatum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
