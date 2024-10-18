<?php
class teachers
{
    public $Id;
    public $TeacherName;
    public $Subject;
    public $educationallevel;
    public $SubjectType;
    public $Email;
    public $ContactNo;
    public $IDNo;
    public $Active;



    public $SubjectID;


    private $database;

    public function __construct()
    {
        global $db;
        $this->database = &$db;
    }



    public function Saveteacher()
    {
        if (isset($this->Id) && $this->Id > 0) {
            // to Update existing record
            $sql = "UPDATE tbteacher 
                    SET name = '" . $this->TeacherName . "', 
                        subjectid = '" . $this->Subject . "', 
                        active = '" . $this->Active . "', 
                        email = '" . $this->Email . "', 
                        contactno = '" . $this->ContactNo . "', 
                        idno = '" . $this->IDNo . "', 
                        teachereducationid = '" . $this->educationallevel . "', 
                        subjecttypeid = '" . $this->SubjectType . "' 
                    WHERE id = " . intval($this->Id);

            $ret = $this->database->exec($sql);
            return ($ret > 0) ? 1 : 0;  // Return 1 if update is successful
        } else {
            // to  Insert new record
            $sql = "INSERT INTO tbteacher (name, subjectid, teachereducationid, subjecttypeid, email, contactno, idno, active)
                    VALUES ('" . $this->TeacherName . "','" . $this->Subject . "','" . $this->educationallevel . "','" . $this->SubjectType . "',
                            '" . $this->Email . "','" . $this->ContactNo . "','" . $this->IDNo . "','" . $this->Active . "')";

            $id = $this->database->insert($sql);
            return ($id > 0) ? $id : 0;  // Return the inserted ID if successful
        }
    }


    function loadteacher()
    {
        $sql = "Select tbteacher.Id, tbteacher.name, tbsubject.subjectname,tbsubjecttype.subjecttype,tbteacher.email,tbteacher.contactno
    from tbteacher
    inner join tbsubject on tbteacher.subjectid = tbsubject.id
    inner join tbsubjecttype on tbteacher.subjecttypeid = tbsubjecttype.id
    WHERE tbteacher.active = true";
        $res = $this->database->getRows($sql);
        return $res;
    }


    function getTeacherById($id)
    {
        $sql = "Select *,CASE (Active) WHEN true THEN 1 ELSE 0 END AS Active1 from tbteacher where Id = " . $id;
        $res = $this->database->getRows($sql);
        return $res;
    }



    function getTeacherByName($Name)
    {
        $sql = "Select *
        from Tbstudent WHERE(Tbstudent.Name LIKE '%" . $Name . "%') ORDER BY Tbstudent.Name";
        $res = $this->database->getRows($sql);
        return $res;
    }





    function getsubject()
    {
        $sql = "Select * from Tbsubject";
        $res = $this->database->getRows($sql);
        return $res;
    }

    function geteducation()
    {
        $sql = "Select * from tbteachereducation";
        // var_dump($sql);
        $res = $this->database->getRows($sql);
        return $res;
    }
}
