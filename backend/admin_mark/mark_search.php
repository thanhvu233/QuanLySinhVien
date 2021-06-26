<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])) {
    session_destroy();
    die();
}

if (isset($_POST['data']) && $_POST['data'] !== '') {
    $data = trim($_POST['data']);

    $sql = "select transcript.*, subject.tenMon
    from ((transcript
    inner join subject on transcript.subjectID = subject.subjectID)
    inner join student on transcript.studentID = student.studentID)
    where student.studentID like '%{$data}%' or student.ten like '%{$data}%'
    order by transcript.transcriptID";

    $index = 1;
    $markList = executeResult($sql);
    if (count($markList) !== 0)
        foreach ($markList as $std) {
            echo "<tr>
            <td>" . ($index++) . "</td>
            <td>{$std["tenMon"]}</td>
            <td>{$std["diemCC"]}</td>
            <td>{$std["diemKT"]}</td>
            <td>{$std["diemTH"]}</td>
            <td>{$std["diemBT"]}</td>
            <td>{$std["diemThi"]}</td>
            <td>{$std["diemTK_so"]}</td>
            <td>{$std["diemTK_chu"]}</td>
            <td>{$std["ketQua"]}</td>
            <td>
                
                <a href='edit_mark.php?id={$std["transcriptID"]}' class='edit-btn' 
                name='edit-btn'><i class='las la-pen'></i></a>
                <a href='delete_mark.php?id={$std["transcriptID"]}' class='delete-btn' 
                                        name='delete-btn'><i class='las la-trash-alt'></i></a>
                
            </td>
        </tr>";
        }
}
