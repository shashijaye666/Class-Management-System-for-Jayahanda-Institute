<?php
include('../library/config.php');

if(isset($_POST["request"])){
    $func = $_POST["request"];
    $func($_POST);
}

function validateUserLogin($request)
{
    $user = new user();
    $res = $user->getUser($request['UserName']);
    $Pwdhash = hash('md5',$request['PassWord']);
    //var_dump($Pwdhash);
    $result=0;
    
    if(!$res)
    {
        $result=0;
    }else{
        if(strcasecmp($res->password,  $Pwdhash) == 0){
            $userlevel=new userlevel();
            $level=$userlevel->getUserLevel($res->userlevel);
            $_SESSION['UserId']= $res->id;
            $_SESSION['UserLevel']= $level->userlevel;
            $result=1;
        } else{
            $result=0;
        }
    }

    echo json_encode($result);
}


function insertuser($request)
{
    $user = new user();
    // $Pwdhash = hash('md5',$request['PassWord']);
    $id = $user->insertUser($request["name"],$request["username"],hash('md5',$request['password']),$request["userlevel"],$request["status"],$request["date"]);
    if($id > 0)
       echo json_encode(1);
    else
       echo json_decode(0);
 }


 
if(isset($_POST["loadUser"])){
    $us = new user();
    echo json_encode($us->loaduser());
 }


 if(isset($_POST['id'])){

    $id = $_POST['id'];
    $us = new user();
    echo json_encode($us->userinfo($id));
 
  }

  if(isset($_POST["del"])){

    $userid=$_POST['did'];
    $us = new user();
    echo json_encode($us->delete($userid));
  
   }
 
 function update($request){

    $us = new user();
    $id =$us->edit($request['name'],$request['username'],$request['password'],$request['userlevel'],$request['status'],$request['id']);
    if($id > 0)
    echo json_encode(1);
 else
    echo json_decode(0);
 
  }

  function getuserlevels()
{
    $level = new userlevel();
    $res = $level->getuserlevels();
    echo json_encode($res);
}

function changepassword($request)
{
    $user = new user();
    $ret = $user->changepassword($_SESSION['UserId'], $request["currentpass"], $request["newpass"]);
    if($ret > 0)
       echo json_encode(1);
    else
       echo json_decode(0);
 }
?>