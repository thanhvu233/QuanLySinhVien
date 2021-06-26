<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }


if (isset($_POST['data']) && $_POST !== '') {
    $data = trim($_POST['data']);

    $sql = "select subjectID, maMon, tenMon, soTinChi,thu, ca, phong, giangVien
            from subject where maMon like '%{$data}%' or tenMon like '%{$data}%' 
            or giangVien like '%{$data}%' order by subjectID";

            $index = 1;
            $subjectList = executeResult($sql);
            if (count($subjectList) !== 0)
                foreach ($subjectList as $std) {
                    echo "<tr>
                        <td>".($index++)."</td>
                        <td>{$std["maMon"]}</td>
                        <td>{$std["tenMon"]}</td>
                        <td>{$std["soTinChi"]}</td>
                        <td>{$std["thu"]}</td>
                        <td>{$std["ca"]}</td>
                        <td>{$std["phong"]}</td>
                        <td>{$std["giangVien"]}</td>
                        <td>
                            
                            <a href='edit_subject.php?id={$std["subjectID"]}' class='edit-btn' 
                            name='edit-btn'><i class='las la-pen'></i></a>
                            <button class='delete-btn' onclick='deleteConfirm()' 
                            name='delete-btn'><i class='las la-trash-alt'></i></button>
                            
                        </td>
                    </tr>";
                }
            }
