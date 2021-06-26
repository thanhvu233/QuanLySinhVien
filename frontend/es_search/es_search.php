<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["userID"])){
session_destroy();
die();
}

if (isset($_POST['data']) && $_POST['data'] != ''){
    $str = $_POST["data"];
                        $term = $str[0];
                        $year = substr($str, 2);


                        $sql = "select examschedule.*, subject.*
                        from ((examschedule
                        inner join subject on examschedule.subjectID = subject.subjectID)
                        inner join student on examschedule.studentID = student.studentID)
                        where student.studentID='{$_SESSION['userID']}'and subject.namHoc='{$year}'
                        and subject.hocKy='{$term}' order by examschedule.esID";

                        $index = 1;
                        $esList = executeResult($sql);
                        if (count($esList) !== 0)
                            foreach ($esList as $std) {
                                $date = date_create($std["ngayThi"]);
                                $date = date_format($date, "d/m/Y");
                                echo "<tr>
                                        <td>" . ($index++) . "</td>
                                        <td>{$std["maMon"]}</td>
                                        <td>{$std["tenMon"]}</td>
                                        <td>{$date}</td>
                                        <td>{$std["gioBatDau"]}</td>
                                        <td>{$std["thoiGianLamBai"]}</td>
                                        <td>{$std["phongThi"]}</td>
                                    </tr>";

                                
                            }
}