<?php
session_start();
include 'dbh.inc.php';

if (isset($_POST['submit'])){


    $sprNum = mysqli_real_escape_string($conn, $_POST['submit']);
    $proid = mysqli_real_escape_string($conn,$_SESSION['ProjID']);

    $sql01 = "SELECT * FROM `sprint_table` WHERE `sprint_num`= '$sprNum' AND `proj_id`= '$proid'";
    $result01 = mysqli_query($conn,$sql01);
    $row = mysqli_fetch_assoc($result01);

    $_SESSION['Sprint_id'] = $row['Sprint_id'];
    $_SESSION['Sprint_num'] = $row['sprint_num'];

    header("Location: ../ProjectArea.php?CHANGED");
    exit();
}else{
    header("Location: ../index.php?login=error1");
    exit();
}