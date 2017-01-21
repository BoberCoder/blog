<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Method({"GET", "POST"})
     * @Template("@App/security/LogIn.html.twig")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $this->redirectToRoute('homepage');

        return array(
            'last_username' => $lastUsername,
            'error'         => $error,
        );
    }

    /**
     * @Route("/registry", name="registry")
     * @Method({"GET", "POST"})
     * @Template("@App/security/SignUp.html.twig")
     */
    public function registryAction(Request $request)
    {
        $userData = new UserData();
        $form = $this->createForm('AppBundle\Form\UserDataType', $userData, array(
            'action' => $this->generateUrl('registry')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($userData, $userData->getPlainPassword());
            $userData->setPassword($password);

            $this->get('entity.service')->writeRecord($userData);

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        return array(
            'userDatum' => $userData,
            'form' => $form->createView(),
        );
    }
}
