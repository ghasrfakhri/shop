<?php

class MyMysqli extends mysqli {

    /**
     * 
     * @param type $query
     * @return mysqli_result
     */
    public function query($query) {
        $result = parent::query($query);
        if ($result === false) {
            if (DEBUG) {
                echo "Db Error:" . $this->error . "<br>";
                echo "Db Error No:" . $this->errno . "<br>";
                echo "Query:" . $query . "<br>";
                $debugTrace = debug_backtrace();
                echo "File:" . $debugTrace[0]['file'] . "<br>";
                echo "Line:" . $debugTrace[0]['line'] . "<br>";

                var_dump($debugTrace);
                exit();
            } else {
                echo "An error occured";
                exit();
            }
        }
        return $result;
    }

}
