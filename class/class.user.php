<?php
class user
{
    public $id;
    private $database;

    public function __construct(){
        global $db;
        $this->database =& $db;
    }

    function getUser($UserName)
    {
        $sql="Select * from tbuser where username ='".$UserName."' and userlevel <> 6 ";
        $res = $this->database->getRow($sql);
       // var_dump($res);
        return $res;
    }

    function getPosUser($UserName, $password)
    {
        $sql="Select * from tbuser where username ='".$UserName."' and password='".$password."' and userlevel = 6 ";
        $res = $this->database->getRow($sql);

        return $res;
    }










    function insertUser($fullname,$username,$password,$userlevel){
        $sql = "INSERT INTO tbuser(name,username,password,userlevel) VALUES('".$fullname."','". $username ."','". $password ."','". $userlevel."')";

        $update = $this->database->exec($sql);
        return $update;
    
      }




      function edit($fullname,$username,$password,$userlevel,$id){
        $edit="UPDATE tbuser SET name='".$fullname."', username='".$username."', password=md5('".$password."'),
            userlevel='".$userlevel."'WHERE id= '".$id."'";
        $updateqry = $this->database->exec($edit);
        return $updateqry;
    }



    function loaduser(){
        $sql="Select tbuser.id,tbuser.name,username,tbuserlevel.userlevel
        from tbuser
        INNER JOIN tbuserlevel ON tbuserlevel.id = tbuser.userlevel";
        $res = $this->database->getRows($sql);
        return $res;
    }






















    function userinfo($id){
        $select="SELECT * FROM tbuser WHERE id='".$id."'";
        $res = $this->database->getRows($select);
        return $res;

    }


    function delete($userid){


        $delete = "DELETE FROM tbuser WHERE Id =" . $userid;
        $deletequery = $this->database->exec($delete);
        return $deletequery;
    }

 
    function changepassword($id,$currentpassword,$password){

        $np = hash('md5',$password);
        $cp = hash('md5',$currentpassword);
        $sql="UPDATE tbuser SET password='".$np."' WHERE id= '".$id."' and password='".$cp."' ";
        $ret = $this->database->exec($sql);
        return $ret;
    }
}
?>