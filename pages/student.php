<?php
include('../library/config.php');

if (isset($_POST["request"])) {
    $func = $_POST["request"];
    $func($_POST);
}

function SaveStudent($request)
{
    $Student = new Student();
    $Student->Id = $request["Id"];
    $Student->StudentName = $request["StudentName"];
    $Student->Address = $request["Address"];
    $Student->Active = $request["Active"];
    $Student->ContactName = $request["ContactName"];
    $Student->ContactEmail = $request["ContactEmail"];
    $Student->ContactMobile = $request["ContactMobile"];
    $Student->ParentName = $request["ParentName"];
    $Student->ParentIDNo = $request["ParentIDNo"];
    $Student->ParentContactNo = $request["ParentContactNo"];

    $res = $Student->SaveStudent();

    echo json_encode($res);
}

function getStudentById($request)
{
    $Student = new Student();
    $res = $Student->getStudentById($request['Id']);
    echo json_encode($res);
}

function loadStudent()
{
    $Student = new Student();
    $res = $Student->getStudent();
    echo json_encode($res);
}

function getStudentByStudentName($request)
{
    $Student = new Student();
    $res = $Student->getStudentByName($request['Name']);
    echo json_encode($res);
}
