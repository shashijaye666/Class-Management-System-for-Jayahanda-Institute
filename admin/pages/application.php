<?php 
include('../../library/config.php');

// if(isset($_POST['loadgasset'])){
//     $jobcategory = $_POST['jobcategory'];
//     $sup = new application();
//     echo json_encode($sup->getApplication($jobcategory));
// }


if(isset($_POST["job"]))  
 {
 	$sup = new application();
    echo json_encode($sup->GetJob());
 }


 if(isset($_POST["provincename"]))  
 {
 	$sup = new application();
    echo json_encode($sup->GetProvince());
 }
 


 if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sup=new application();
    echo json_encode($sup->getapplicatinform($id));
    }


if(isset($_POST['search'])){

        $fromdate=$_POST['fromdate'];
        $todate=$_POST['todate'];
        $jobcategory = $_POST['jobcategory'];
        $nic = $_POST['nic'];
        $province=$_POST['province'];
       
        $sup=new application();
     
     echo json_encode($sup->detailsSearch($fromdate,$todate,$jobcategory,$nic,$province));
     
      }  

      if(isset($_POST['rowId'])){
         $rowId = $_POST['rowId'];
         $sup=new application();
         echo json_encode($sup->getfiles($rowId));
         }
?>