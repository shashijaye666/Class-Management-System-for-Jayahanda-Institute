<?php
include('../library/config.php');

if(isset($_POST["request"])){
    $func = $_POST["request"];
    $func($_POST);
}

function loadTeachers()
{
    $property = new ClassSchedule();
    $res = $property->loadTeachers();
    echo json_encode($res);
}


function SavetClassSchedule($request)
{
    $ClassSchedule = new ClassSchedule();
    $ClassSchedule->Id = $request["Id"];
    $ClassSchedule->Name = $request["Name"];
    $ClassSchedule->Subject = $request["Subject"];
    $ClassSchedule->date = $request["date"];
    $ClassSchedule->ClassTime = $request["ClassTime"];
    $ClassSchedule->NoofHours = $request["NoofHours"];
    $ClassSchedule->ZoomLink = $request["ZoomLink"];

    $res = $ClassSchedule->SavetClassSchedule();

    echo json_encode($res);
}

function loadclassshedule()
{
    $Student = new ClassSchedule();
    $res = $Student->loadclassshedule();
    echo json_encode($res);
}

function getClassSheduleById($request)
{
    $Student = new ClassSchedule();
    $res = $Student->getClassSheduleById($request['Id']);
    echo json_encode($res);
}

function deletedata($request)
{
    // Check if 'Id' exists in the request
    if (isset($request['Id'])) {
        $Student = new ClassSchedule();
        $res = $Student->deletedata($request['Id']);
        echo json_encode($res);
    } else {
        echo json_encode("Id not provided"); // Debugging message
    }
}


?>