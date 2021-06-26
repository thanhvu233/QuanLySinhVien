<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

$data = $_POST['data'];
if (isset($_POST['data']) && $_POST['data'] !== '') {
    $data = trim($_POST['data']);

    $sql = "select subject.*
                            from ((examschedule
                            inner join subject on examschedule.subjectID = subject.subjectID)
                            inner join student on examschedule.studentID = student.studentID)
                            where student.studentID like '%{$data}%' or student.ten like '%{$data}%'
                            order by subject.subjectID";

            $index = 1;
            $subjectList = executeResult($sql);
            if (count($subjectList) !== 0)
                foreach ($subjectList as $std) {
                    echo "<tr>
                    <td>".($index++)."</td>
                    <td>{$std["maMon"]}</td>
                    <td>{$std["tenMon"]}</td>
                    <td>{$std["soTinChi"]}</td>
                    <td>{$std["hocPhi"]}</td>
                </tr>";
                }
            }
