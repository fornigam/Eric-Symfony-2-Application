<?php

namespace Collegelife\CommonBundle\Helpers;

interface PagerInterface {
    /*
     * Set repository
     */

    public function setRepository($args);


    /*
     * Get repository
     */

    public function getRepository();


    /*
     * Set arguments
     */

    public function setArguments($args);

    /*
     * Get arguments
     */

    public function getArguments($args);

    /*
     * Set parameters sets arguments & repository parameters
     */

    public function setParameters($args);


    /*
     * Get no of rows per page
     */

    public function getRowsPerPage();

    /*
     * Set no of rows per page
     */

    public function setRowsPerPage();

    /*
     * Get total rows
     */

    public function getTotalRows($params);

    /*
     * Get table records with maximum records length
     */

    public function getTableData($initIndex);

    /*
     * Get Page data 
     */

    public function getPage();
}
