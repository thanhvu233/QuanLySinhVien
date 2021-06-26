<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }


if (isset($_POST['data']) && $_POST['data'] !== '') {
    $data = trim($_POST['data']);

    if (preg_match('/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/', $data)) {
        $data = date_create_from_format("d/m/Y", $data);
        $data = date_format($data, "Y-m-d");
    }

    $sql = "select * from student where studentID like '%{$data}%' or
                ten like '%{$data}%' or lop like '%{$data}%' or
                email like '%{$data}%' or ngaySinh like '%{$data}%'";

                $index = 1;
                $studentList = executeResult($sql);
                if (count($studentList) !== 0)
                    foreach ($studentList as $std) {
                        $date = date_create ($std["ngaySinh"]);
                        $date = date_format ($date, "d/m/Y");
                        echo "<tr>
                            <td>".($index++)."</td>
                            <td>{$std["studentID"]}</td>
                            <td>{$std["ten"]}</td>
                            <td>{$std["lop"]}</td>
                            <td>{$std["email"]}</td>
                            <td>{$date}</td>
                            <td>{$std["queQuan"]}</td>
                            <td>
                                
                                <a href='edit_student.php?id={$std["studentID"]}' class='edit-btn' 
                                name='edit-btn'><i class='las la-pen'></i></a>
                                <a href='delete_student.php?id={$std["studentID"]}' class='delete-btn' 
                                        name='delete-btn'><i class='las la-trash-alt'></i></a>
                                
                            </td>
                        </tr>";
                    }
}
