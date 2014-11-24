<?php
/*
 * Auther Name : Celon Software
 * Purpose : Overrride Registration controller to prevent unauthorize access
 */
 
namespace CelonSoftware\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseRegistrationController;

/**
 * Controller managing the registration
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class RegistrationController extends BaseRegistrationController {

    public function registerAction(Request $request) {
        if (true === $this->container->get('security.context')->isGranted('ROLE_USER')) {
            return new RedirectResponse(
                    $this->container->get('router')->generate("celon_software_admin_user_homepage")
            );
        }
        return parent::registerAction($request);
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction() {
        if (true === $this->container->get('security.context')->isGranted('ROLE_USER')) {
            return new RedirectResponse(
                    $this->container->get('router')->generate("celon_software_admin_user_homepage")
            );
        }
        return parent::checkEmailAction($request);
    }

    /**
     * Receive the confirmation token from user email provider, login the user
     */
    public function confirmAction(Request $request, $token) {
        if (true === $this->container->get('security.context')->isGranted('ROLE_USER')) {
            return new RedirectResponse(
                    $this->container->get('router')->generate("celon_software_admin_user_homepage")
            );
        }
        return parent::confirmAction($request);
    }

    /**
     * Tell the user his account is now confirmed
     */
    public function confirmedAction() {
        if (true === $this->container->get('security.context')->isGranted('ROLE_USER')) {
            return new RedirectResponse(
                    $this->container->get('router')->generate("celon_software_admin_user_homepage")
            );
        }
        return parent::confirmedAction($request);
    }

}
