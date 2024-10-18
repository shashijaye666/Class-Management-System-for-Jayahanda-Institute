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
 class Time{
                    function isWithInTime($start,$end,$time) {

                       if (($time >= $start )&& ($time <= $end)) {
                          // echo 'OK';
                           return TRUE;
                       } else {
                           //echo 'Not OK';
                           return FALSE;
                       }

           }
      
    }
?>
