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

    $sql = "select examschedule.*, subject.tenMon
    from ((examschedule
    inner join subject on examschedule.subjectID = subject.subjectID)
    inner join student on examschedule.studentID = student.studentID)
    where student.studentID like '%{$data}%' or student.ten like '%{$data}%' 
    or examschedule.ngayThi like '%{$data}%' or subject.tenMon like '%{$data}%'
    order by examschedule.esID";
    
    $index = 1;
    $esList = executeResult($sql);
    if (count($esList) !== 0)
        foreach ($esList as $std) {
            $date = date_create($std["ngayThi"]);
            $date = date_format($date, "d/m/Y");
            echo "              <tr>
                                    <td>".($index++)."</td>
                                    <td>{$std["tenMon"]}</td>
                                    <td>{$date}</td>
                                    <td>{$std["gioBatDau"]}</td>
                                    <td>{$std["thoiGianLamBai"]}</td>
                                    <td>{$std["phongThi"]}</td>
                                    <td>{$std["hocKy"]}</td>
                                    <td>{$std["namHoc"]}</td>
                                    <td>
                                        
                                        <a href='edit_es.php?id={$std["esID"]}' class='edit-btn' 
                                        name='edit-btn'><i class='las la-pen'></i></a>
                                        <a href='delete_es.php?id={$std["esID"]}' class='delete-btn' 
                                        name='delete-btn'><i class='las la-trash-alt'></i></button>
                                        
                                    </td>
                                </tr>";
        }
}
