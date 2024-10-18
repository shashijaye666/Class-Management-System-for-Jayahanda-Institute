<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */


/**
 * Description of class
 *
 * @author Jaliya
 */
class CGuser {
     private $database;
            public function __construct(){
            global $db;
            $this->database =& $db;
            } 
            
            
               function checkUser($user,$password) {
                try {
            
                        $sql = "SELECT tbcgusermst.id,tbcgusermst.username, tbcgusermst.password
                        FROM tbcgusermst 
                        WHERE isactive = true and tbcgusermst.username='".$user ."' and password ='".$password."'";

                        $stmt = $this->database->getRows($sql);
                        return $stmt;
                       
                } 
                catch (Exception $e) {
                    LoggerServices::errorMessage($e);
                }
        return null;
    }
}

