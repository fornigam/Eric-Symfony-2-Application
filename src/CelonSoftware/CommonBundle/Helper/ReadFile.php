<?php

Namespace CelonSoftware\CommonBundle\Helper;

class ReadFile {

    public static function getFile($dir, $filename) {
		$data = array();
        $file = fopen("{$dir}/{$filename}", "r");
        $arr = array();
        while (!feof($file)) {
//            echo "<br/>data" . fgets($file);
//            echo "<br/>===========================================<br/>";
            $data = explode(' ', fgets($file));
            $data[3] = str_replace("[", "", $data[3]);
            $data[4] = str_replace("]", "", $data[4]);
            $data[3] = preg_replace("/:/", " ", $data[3], 1);
			echo $data[3].$data[4];
			echo $date = \DateTime::createFromFormat("d/M/Y H:i:sO", $data[3].$data[4]);
			exit();
            $date = \DateTime::createFromFormat("d/M/Y H:i:sO", $data[3].$data[4]);
            $dateTime = $date->format('Y-m-d H:i:s');
			
            $ipAddress = $data[0];
            

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
