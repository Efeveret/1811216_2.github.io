<?php
session_start();
include 'dbh.inc.php';

if (isset($_POST['submit01'])){
    $num = 1;
    $num = $_SESSION['Sprint_num'] +1;

    $NewSprNum = mysqli_real_escape_string($conn, $num);
    $proId = mysqli_real_escape_string($conn, $_SESSION['ProjID']);

    $sql = "INSERT INTO `sprint_table`(`sprint_num`, `proj_id`) VALUES ('$NewSprNum','$proId')";
    $result = mysqli_query($conn,$sql);
    $resultID = mysqli_insert_id($conn);




    $_SESSION['Sprint_id'] = $resultID;
    $_SESSION['Sprint_num'] = $NewSprNum;

    header("Location: ../ProjectArea.php?login=error1");
    exit();
}else {
    header("Location: ../index.php?login=error1");
    exit();
}