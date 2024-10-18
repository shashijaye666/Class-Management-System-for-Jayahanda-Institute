<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class
 *
 * @author Jaliya
 */
 class Default1 {
     
     
      private $database;

        public function __construct(){
        global $db;
        $this->database =& $db;
    }
     function GetGraceMinutes()
    {
       $sqlGraceMinutes = "SELECT graceminuites from tbdefault";         
       $resultRate = $this->database->getCol($sqlGraceMinutes);
       return $resultRate;
    }
    function GetGraceMinutes_h()
    {
       $sqlGraceMinutes_h = "SELECT h_graceminuites from tbdefault";         
       $resultRate_h = $this->database->getCol($sqlGraceMinutes_h);
       return $resultRate_h;
    }
    
     function GetGraceMinutes_s()
    {
       $sqlGraceMinutes_s = "SELECT s_graceminuites from tbdefault";         
       $resultRate_s = $this->database->getCol($sqlGraceMinutes_s);
       return $resultRate_s;
    }
}
?>