<?php

namespace CelonSoftware\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CelonSoftwareAdminBundle extends Bundle {

    public function getParent() {
        return "FOSUserBundle";
    }

}
