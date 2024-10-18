<?php

class database {
    private $db;       //The db handle
    public  $num_rows; //Number of rows
    public  $last_id;  //Last insert id
    public  $aff_rows; //Affected rows

    public function __construct()
    {
        $this->db = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME."
                                user=".DB_USER." password=".DB_PASS);
        if (!$this->db) exit();
    }

    public function close()
    {
        pg_close($this->db);
    }

    // For SELECT
    // Returns one row as object
    public function getRow($sql)
    {
        $result = pg_query($this->db, $sql);
        if ($result === false) {
            exit(pg_last_error($this->db)); // Pass $this->db to pg_last_error()
        }
        
        $row = pg_fetch_object($result);
        return $row;
    }

    // For SELECT
    // Returns an array of row objects
    // Gets number of rows
    public function getRows($sql)
    {
        $result = pg_query($this->db, $sql);
        if ($result === false) {
            exit(pg_last_error($this->db)); // Pass $this->db to pg_last_error()
        }
        
        $this->num_rows = pg_num_rows($result);
        $rows = array();
        while ($item = pg_fetch_object($result)) {
            $rows[] = $item;   
        }
        return $rows;
    }

    // For SELECT
    // Returns one single column value as a string
    public function getCol($sql)
    {
        $result = pg_query($this->db, $sql);
        if ($result === false) {
            exit(pg_last_error($this->db)); // Pass $this->db to pg_last_error()
        }

        $col = pg_fetch_result($result, 0);
        return $col;
    }

    // For SELECT
    // Returns array of all values in one column
    public function getColValues($sql)
    {
        $result = pg_query($this->db, $sql);
        if ($result === false) {
            exit(pg_last_error($this->db)); // Pass $this->db to pg_last_error()
        }

        $arr = pg_fetch_all_columns($result);
        return $arr;
    }

    // For INSERT
    // Returns last insert $id
    public function insert($sql, $id='id')
    {
        $sql = rtrim($sql, ';');
        $sql .= ' RETURNING '.$id;
        $result = pg_query($this->db, $sql);
        if ($result === false) {
            exit(pg_last_error($this->db)); // Pass $this->db to pg_last_error()
        }

        $this->last_id = pg_fetch_result($result, 0);
        return $this->last_id;
    }

    // For UPDATE, DELETE and CREATE TABLE
    // Returns number of affected rows
    public function exec($sql)
    {
        $result = pg_query($this->db, $sql);
        if ($result === false) {
            exit(pg_last_error($this->db)); // Pass $this->db to pg_last_error()
        }

        $this->aff_rows = pg_affected_rows($result);
        return $this->aff_rows;
    }

}
?>
