<?php
class userlevel
{
    private $database;

    public function __construct(){
        global $db;
        $this->database =& $db;
    }

    function getUserLevel($UserId)
    {
        $sql="Select * from tbuserlevel where id ='".$UserId."' ";
        $res = $this->database->getRow($sql);
        return $res;
    }

    function getuserlevels(){
        $sql="Select * from tbuserlevel ";
        $res = $this->database->getRows($sql);
        return $res;
    }
}

?>