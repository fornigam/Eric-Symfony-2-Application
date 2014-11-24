<?php

namespace Collegelife\CommonBundle\Helpers;

use Collegelife\CommonBundle\Helpers\PagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of pagination
 *
 * @author user11
 */
class Pager implements PagerInterface {

    protected $em, $request, $repository, $totalRows, $rowsPerPage, $lastPage, $initIndex;
    protected $nextPage = 1;
    protected $previousPage = 1;
    protected $args = array();
    protected $returnVal = array();

    public function __construct(EntityManager $em, Request $request) {
        $this->em = $em;
        $this->request = $request;
    }

    public function setRepository($args) {
        $this->repository = $args;
    }

    public function getRepository() {
        if (count($this->repository) == 1) {
            return $this->repository[0];
        }
        //return $this->repository;
    }

    public function setArguments($args) {
        $this->args = $args;
    }

    public function getArguments($args = "all") {
        return ($args != "all") ? $this->args[$args] : $this->args;
    }

    public function setRowsPerPage() {
        $this->rowsPerPage = $this->request->getSession()->get("records_show_per_page");
    }

    public function getRowsPerPage() {
        return $this->rowsPerPage;
    }

    public function setParameters($args) {
        // set repository
        $this->setRepository($args['repository']);

        // set extra parameters
        $this->setArguments($args["args"]);

        // set rows per page
        $this->setRowsPerPage();
    }

    public function getTotalRows($params) {
        return $this->em->getRepository($this->getRepository())->getActiveRowsCount($params);
    }

    public function getTableData($initIndex) {
        return $this->em->getRepository($this->getRepository())->getRows($initIndex, $this->getRowsPerPage(), $this->getArguments("params"));
    }

    public function getPage() {
        //echo '<pre> ';
        //print_r($this->getRepository());
        //print_r($this->getArguments());
        //echo "<br/>Trigger:" . $this->getArguments("trigger");
        //echo "<br/>Page:" . $this->getArguments("page");

        /*
         * Pagination 
         * -------------------------------------------------
         */
        $this->totalRows = $this->getTotalRows($this->getArguments("params"));
        $this->lastPage = ceil($this->totalRows / $this->getRowsPerPage());

        if ($this->getArguments("trigger") == "next" && $this->getArguments("page") < $this->lastPage) {
            $this->nextPage = 1;
            $this->previousPage = $this->getArguments("page") - 1;
        } else {
            $this->nextPage = $this->getArguments("page") + 1;
            $this->previousPage = $this->getArguments("page") - 1;
        }

        if ($this->getArguments("trigger") == "prev" && $this->getArguments("page") > 1) {
            $this->previousPage = $this->getArguments("page") - 1;
        } else {
            $this->nextPage = $this->getArguments("page") + 1;
            $this->previousPage = $this->getArguments("page") - 1;
        }

        $this->initIndex = ($this->getArguments("page") > 1) ? ($this->getArguments("page") - 1) * $this->getRowsPerPage() : 0;
        //$entity = $this->getDoctrine()->getRepository("CollegelifeCommonBundle:City")->getRows($this->initIndex, $this->getRowsPerPage(), $this->getArguments("params"));
        $entity = $this->getTableData($this->initIndex);

        return array(
            "entity" => $entity,
            "current" => $this->getArguments("page"),
            "nextpage" => $this->nextPage,
            "lastpage" => $this->lastPage,
            "previouspage" => $this->previousPage,
            "totalrows" => $this->totalRows,
            "params" => $this->getArguments("params")
        );
    }
}
