<?php

if (isset($_POST['submit'])){
    session_start();
    include 'dbh.inc.php';

    $Pri = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $st01 = mysqli_real_escape_string($conn, $_POST['st']);
    $st = $st01.":00";
    $et01 = mysqli_real_escape_string($conn, $_POST['et']);
    $et = $et01.":00";
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $sql = "UPDATE `sprint_retro_table` SET `sprint_retro_description`='$comment', `start_t`='$st',`end_t`='$et' WHERE `sprint_id`= '$Pri'";
    $result = mysqli_query($conn,$sql);

    header("Location: ../ProjectArea.php");
    exit();
}