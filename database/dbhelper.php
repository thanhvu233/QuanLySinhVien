<?php
require_once ("config.php");

// insert, delete, update
function execute ($sql) {
    // ket noi den database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    //query
    mysqli_query($conn, $sql);

    //dong ket noi
    mysqli_close($conn);
}

// select
function executeResult ($sql) {
    // ket noi den database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    //query
    $resultset = mysqli_query($conn, $sql);
    $list = [];

        while ($row = $resultset->fetch_assoc())
        $list[] = $row;

        mysqli_close($conn);
        return $list;
      
}

