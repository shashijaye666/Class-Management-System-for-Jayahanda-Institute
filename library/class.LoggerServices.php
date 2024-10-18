<?php
class LoggerServices {
  public static function errorMessage($e) {
    //error message
    $errorMsg = 'Error on line '.$e->getLine().' in '.$e->getFile() .': '.$e->getMessage();
    error_log($errorMsg);
  }
}
?>