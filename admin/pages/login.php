<?php 
include('../../library/config.php');

if(isset($_POST['login'])){
   $username=trim($_POST['username']);
   $password=trim($_POST['password']);
   $log=new login();
   $user=$log->userlogin($username,$password);

   //$dbs= $obj->id;
   $_SESSION['UserId']= $user[0]->id;
if ( $user!=''){
   echo json_encode($user[0]->id);
}
else{
   
}
}
?>