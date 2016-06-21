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
                $debugTrace = debug_backtrace();
                $errorMessage = "Db Error:" . $this->error . "\n" .
                        "Db Error No:" . $this->errno . "\n" .
                        "Query:" . $query . "\n" .
                        "File:" . $debugTrace[0]['file'] . "\n" .
                        "Line:" . $debugTrace[0]['line'] . "\n";
            } else {
                $errorMessage = "An error occured";
            }
            throw new Exception($errorMessage, $this->errno);
        }
        return $result;
    }

}
