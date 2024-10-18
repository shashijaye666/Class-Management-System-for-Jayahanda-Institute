<?php
include('../library/config.php');

if (isset($_POST["request"])) {
    $func = $_POST["request"];
    $func($_POST);
}

function Saveteacher($request)
{
    $teachers = new teachers();
    $teachers->Id = $request["Id"];
    $teachers->TeacherName = $request["TeacherName"];
    $teachers->Subject = $request["Subject"];
    $teachers->educationallevel = $request["educationallevel"];
    $teachers->SubjectType = $request["SubjectType"];
    $teachers->Email = $request["Email"];
    $teachers->ContactNo = $request["ContactNo"];
    $teachers->IDNo = $request["IDNo"];
    $teachers->Active = $request["Active"];


    $res = $teachers->Saveteacher();

    echo json_encode($res);
}

function getTeacherById($request)
{
    $Student = new teachers();
    $res = $Student->getTeacherById($request['Id']);
    echo json_encode($res);
}

function loadteacher()
{
    $teachers = new teachers();
    $res = $teachers->loadteacher();
    echo json_encode($res);
}

function getTeacherByTeacherName($request)
{
    $Student = new teachers();
    $res = $Student->getTeacherByName($request['Name']);
    echo json_encode($res);
}




function getsubject($request)
{
    $teachers = new teachers();
    $res = $teachers->getsubject();
    echo json_encode($res);
}


function geteducation($request)
{
    $teachers = new teachers();
    $res = $teachers->geteducation();
    echo json_encode($res);
}