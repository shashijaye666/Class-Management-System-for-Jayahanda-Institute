<?php
class ClassSchedule
{
    public $Id;
    public $Name;
    public $Subject;
    public $date;
    public $ClassTime;
    public $NoofHours;
    public $ZoomLink;


    private $database;

    public function __construct()
    {
        global $db;
        $this->database = &$db;
    }


    function loadTeachers()
    {
        $sql="Select * from tbteacher";
        $res = $this->database->getRows($sql);
        return $res;
    }


    public function SavetClassSchedule()
  
    {

        if (isset($this->Id) && $this->Id > 0) {

            // Update existing record

            $sql = "UPDATE tbclassshedule SET teacherid = '" . $this->Name . "', subjectid = '" . $this->Subject . "', date = '" . $this->date . "', 
        time = '" . $this->ClassTime . "', noofhours = '" . $this->NoofHours . "', zoomlink = '" . $this->ZoomLink . "' 
        WHERE Id = " . intval($this->Id);

            $ret = $this->database->exec($sql);
            return $ret;
        } else {
            // Insert new record

            $sql = "INSERT INTO tbclassshedule (teacherid, subjectid,date,time, noofhours,zoomlink)
        VALUES ('" . $this->Name . "','" . $this->Subject . "','" . $this->date . "','" . $this->ClassTime . "','" . $this->NoofHours . "',
        '" . $this->ZoomLink . "')";
            $id = $this->database->insert($sql);
            return ($id > 0) ? $id : 0;
            
        }
    }


    function loadclassshedule()
    {
        $sql = "Select tbclassshedule.id,tbteacher.name,tbsubject.subjectname,tbclassshedule.date,tbclassshedule.time,tbclassshedule.noofhours,tbclassshedule.zoomlink
        from tbclassshedule
        inner join tbteacher on tbclassshedule.teacherid = tbteacher.id
        inner join tbsubject on tbclassshedule.subjectid = tbsubject.id";
        $res = $this->database->getRows($sql);
        return $res;
    }

    function getClassSheduleById($id)
    {
        $sql = "Select * from tbclassshedule where Id = " . $id;
        $res = $this->database->getRows($sql);
        return $res;
    }

    function deletedata($id){
  

        $delete = "DELETE FROM tbclassshedule WHERE Id =" . $id;
        $deletequery = $this->database->exec($delete);
        return $deletequery;
    }



}
