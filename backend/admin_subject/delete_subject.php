<?php
require_once "/xampp/htdocs/QuanLySinhVien/database/dbhelper.php";
session_start();

if (!isset($_SESSION["adminID"]) || !isset($_SESSION["account"])){
    session_destroy();
    die();
    }

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "delete from subject where subjectID='$id'";
    execute($sql);

    $_SESSION["delete_success"] = true;
    header("Location: admin_subject.php");
    die();
}