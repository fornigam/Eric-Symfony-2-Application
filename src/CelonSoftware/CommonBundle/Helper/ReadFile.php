<?php

/*
 * Helper class to parse uploaded file and return array of file data.
 */

/**
 * @author nigam
 */

Namespace CelonSoftware\CommonBundle\Helper;

class ReadFile {

    public static function getFile($dir, $filename) {

        $file = fopen("{$dir}/{$filename}", "r");
        $arr = array();
        while (!feof($file)) {

            $data = explode(' ', fgets($file));
            $data[3] = str_replace("[", "", $data[3]);
            $data[4] = str_replace("]", "", $data[4]);
            $data[3] = preg_replace("/:/", " ", $data[3], 1);
            $date = \DateTime::createFromFormat("d/M/Y H:i:sO", $data[3] . $data[4]);

            $ipAddress = $data[0];
            $dateTime = $date->format('Y-m-d H:i:s');

            $url = $data[6];
            $codeReturned = (isset($data[8])) ? $data[8] : "-";
            array_push
                    (
                    $arr, array(
                "ip" => $ipAddress,
                "dt" => $dateTime,
                "url" => $url,
                "responsecode" => $codeReturned
                    )
            );
        }
        return $arr;
    }

}
