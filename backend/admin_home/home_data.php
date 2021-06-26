<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])) {
    session_destroy();
    die();
}

        $sql = "select queQuan as home, count(queQuan) as num
                from student group by queQuan order by studentID";

        $result = executeResult($sql);
    
        if (count($result) !== 0){
            $data = array();
            
            foreach ($result as $row) {
               $data[] = $row;
            }

            print json_encode($data, JSON_UNESCAPED_UNICODE);
        }
            

       