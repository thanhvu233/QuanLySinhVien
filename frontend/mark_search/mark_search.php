<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["userID"])){
session_destroy();
die();
}

if (isset($_POST['data1']) && $_POST['data1'] != ''){
    $str = $_POST["data1"];
    $term = $str[0];
    $year = substr($str, 2);


    $sql = "select transcript.*, subject.*
    from ((transcript
    inner join subject on transcript.subjectID = subject.subjectID)
    inner join student on transcript.studentID = student.studentID)
    where student.studentID='{$_SESSION['userID']}' and subject.namHoc='{$year}'
    and subject.hocKy='{$term}' order by transcript.transcriptID";
    $index = 1;
    $markList = executeResult($sql);
    if (count($markList) !== 0)
        foreach ($markList as $std) {
            echo "<tr>
            <td>" . ($index++) . "</td>
            <td>{$std["maMon"]}</td>
            <td>{$std["tenMon"]}</td>
            <td>{$std["diemCC"]}</td>
            <td>{$std["diemKT"]}</td>
            <td>{$std["diemTH"]}</td>
            <td>{$std["diemBT"]}</td>
            <td>{$std["diemThi"]}</td>
            <td>{$std["diemTK_so"]}</td>
            <td>{$std["diemTK_chu"]}</td>
            <td>{$std["ketQua"]}</td>
        </tr>";
        }
}