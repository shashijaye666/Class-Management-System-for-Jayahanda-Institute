<?php
class Student
{
    public $Id;
    public $StudentName;
    public $Address;
    public $Active;
    public $ContactName;
    public $ContactEmail;
    public $ContactMobile;
    public $ParentName;
    public $ParentIDNo;
    public $ParentContactNo;


    private $database;

    public function __construct()
    {
        global $db;
        $this->database = &$db;
    }



    public function SaveStudent()
    {

        if (isset($this->Id) && $this->Id > 0) {

            //  to Update existing record

            $sql = "UPDATE Tbstudent SET Name = '" . $this->StudentName . "', Address = '" . $this->Address . "', Active = '" . $this->Active . "', 
        ContactName = '" . $this->ContactName . "', ContactEmail = '" . $this->ContactEmail . "', ContactMobile = '" . $this->ContactMobile . "', 
        parentname = '" . $this->ParentName . "',parentidno = '" . $this->ParentIDNo . "',  parentcontactmobile = '" . $this->ParentContactNo . "' 
        WHERE Id = " . intval($this->Id);

            $ret = $this->database->exec($sql);
            return ($ret > 0) ? 1 : 0;
            
        } else if (isset($this->Id) > 0) {
            // to Insert new record

            $sql = "INSERT INTO Tbstudent (Name, Address, Active, ContactName, ContactEmail, ContactMobile, parentname, parentidno, parentcontactmobile)
        VALUES ('" . $this->StudentName . "','" . $this->Address . "','" . $this->Active . "','" . $this->ContactName . "','" . $this->ContactEmail . "',
        '" . $this->ContactMobile . "','" . $this->ParentName . "','" . $this->ParentIDNo . "','" . $this->ParentContactNo . "')";
            $id = $this->database->insert($sql);
            return ($id > 0) ? $id : 0;
        }
    }

    function getStudent()
    {
        $sql = "Select Tbstudent.Id,Tbstudent.Name,Tbstudent.Address,Tbstudent.ContactEmail,Tbstudent.ContactMobile
        from Tbstudent
        WHERE Tbstudent.active = true";
        $res = $this->database->getRows($sql);
        return $res;
    }


    function getStudentById($id)
    {
        $sql = "Select *,CASE (Active) WHEN true THEN 1 ELSE 0 END AS Active1 from Tbstudent where Id = " . $id;
        $res = $this->database->getRows($sql);
        return $res;
    }



    function getStudentByName($Name)
    {
        $sql = "Select Tbstudent.Id,Tbstudent.Name,Tbstudent.Address,Tbstudent.ContactEmail,Tbstudent.ContactMobile
        from Tbstudent WHERE(Tbstudent.Name LIKE '%" . $Name . "%') ORDER BY Tbstudent.Name";
        $res = $this->database->getRows($sql);
        return $res;
    }
}
