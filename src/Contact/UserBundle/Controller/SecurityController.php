<?php

namespace Contact\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('@ContactUser/Security/login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername()
        ));
    }

}
