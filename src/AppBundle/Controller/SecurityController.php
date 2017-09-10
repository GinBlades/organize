<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\LoginType;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get("security.authentication_utils");

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by user, to repopulate login field
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginType::class, [
            "_username" => $lastUsername
        ]);

        return $this->render("security/login.html.twig", [
            "last_username" => $lastUsername,
            "error" => $error,
            "loginForm" => $form->createView()
        ]);
    }
}
