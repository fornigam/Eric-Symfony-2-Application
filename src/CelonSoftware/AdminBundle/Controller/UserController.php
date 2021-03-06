<?php

/*
 * User module provides home page, upload log file and list of log file. 
 */

/**
 * @author nigam
 */

namespace CelonSoftware\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CelonSoftware\CommonBundle\Helper\ReadFile;
use CelonSoftware\CommonBundle\Entity\Log;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class UserController extends Controller {
    /*
     * Home page
     */

    public function indexAction(Request $request) {
        return $this->render('CelonSoftwareAdminBundle:User:index.html.twig');
    }

    /*
     * Upload log file
     */

    public function uploadAction(Request $request) {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException("Unable access this page");
        }
        $form = $this->__frmLog();
        return $this->render('CelonSoftwareAdminBundle:User:upload.html.twig', array("form" => $form->createView()));
    }

    /*
     * Post data to logreader action to insert in database.
     */

    public function logreaderAction(Request $request) {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException("Unable access this page");
        }

        $form = $this->__frmLog();
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST' && $form->get("submit")->isClicked()) {
            $req = $request->files;
            $file = $req->get("frmLog");
            $filename = "myfile.txt";
            foreach ($file as $uploadedFile) {
                $uploadedFile->move($this->container->getParameter("temp_dir"), $filename);
            }
            $res = ReadFile::getFile($this->container->getParameter("temp_dir"), $filename);
            /*
             * Insert log data in database
             */
            if (count($res) > 0) {
                foreach ($res as $row) {
                    $objLog = new Log();
                    $objLog->setLogurl(trim($row['url']));
                    $objLog->setLogdip($row['ip']);
                    $objLog->setLogdate(new \DateTime($row['dt']));
                    $objLog->setLogcode($row['responsecode']);
                    $this->getDoctrine()->getManager()->persist($objLog);
                }
                $this->getDoctrine()->getManager()->flush();
            }

            $this->get("session")->getFlashBag()->add("message", "Data Uploaded");
            return $this->redirect($this->generateUrl("celon_software_admin_log_list"));
        }
        return $this->render('CelonSoftwareAdminBundle:User:upload.html.twig', array("form" => $form->createView()));
    }

    /*
     * List log file data
     */

    public function listAction(Request $request) {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException("Unable access this page");
        }
        $data = $this->getDoctrine()->getManager()->getRepository("CelonSoftwareCommonBundle:Log")->findAll();
        return $this->render('CelonSoftwareAdminBundle:User:list.html.twig', array("entity" => $data));
    }

    /*
     * Using CreateNameBuilder of form factory to create file upload form.
     */

    private function __frmLog() {
        $form = $this->get('form.factory')
                ->createNamedBuilder('frmLog')
                ->add('file', "file", array("label" => "File", "required" => false, "data_class" => null))
                ->add("submit", "submit", array("label" => "Upload Log", "attr" => array("class" => "btn btn-lg btn-primary btn-block", "id" => "btnLog", "name" => "btnLog")))
                ->getForm();
        return $form;
    }

}
