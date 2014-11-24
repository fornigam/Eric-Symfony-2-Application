<?php
/*
 * Auther Name : Celon Software
 * Purpose : Overrride Security controller to prevent unauthorize access
 */

namespace CelonSoftware\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;

class SecurityController extends BaseSecurityController {

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data) {
	/*
	* Override reder login to prevent unauthenticated user
	*/
        if (true === $this->container->get('security.context')->isGranted('ROLE_USER')) {
            return new RedirectResponse(
                    $this->container->get('router')->generate("celon_software_admin_user_homepage")
            );
        }
        return parent::renderLogin($data);
    }

}
