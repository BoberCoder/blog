<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("news")
 */
class NewsController extends Controller
{
    /**
     * @Route("/", name="news_index")
     * @Method("GET")
     * @Template("@App/news/index.html.twig")
     */
    public function indexAction()
    {
        $news = $this->get('entity.service')->showAllRecords();
        return  array('news' => $news);
    }

    /**
     * @Route("/new", name="news_new")
     * @Method({"GET", "POST"})
     * @Template("@App/news/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm('AppBundle\Form\NewsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('entity.service')->createRecord($news);

            return $this->redirectToRoute('news_index');
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a news entity.
     *
     * @Route("/{id}", name="news_show")
     * @Method("GET")
     * @Template("@App/news/show.html.twig")
     */
    public function showAction(News $news)
    {
        $deleteForm = $this->createDeleteForm($news);

        return array(
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing news entity.
     *
     * @Route("/{id}/edit", name="news_edit")
     * @Method({"GET", "POST"})
     * @Template("@App/news/edit.html.twig")
     */
    public function editAction(Request $request, News $news)
    {
        $editForm = $this->createForm('AppBundle\Form\NewsType', $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_show', array('id' => $news->getId()));
        }

        return array(
            'news' => $news,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a news entity.
     *
     * @Route("/{id}", name="news_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, News $news)
    {
        $form = $this->createDeleteForm($news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('entity.service')->deleteRecord($news);
        }

        return $this->redirectToRoute('news_index');
    }

    /**
     * Creates a form to delete a news entity.
     *
     * @param News $news The news entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(News $news)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $news->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
