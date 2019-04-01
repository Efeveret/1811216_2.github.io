<?php

if (isset($_POST['submit'])){
    session_start();
    include 'dbh.inc.php';

    $Pri = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $Pri = mysqli_real_escape_string($conn, $_POST['Pri']);
    $Pri = mysqli_real_escape_string($conn, $_POST['Pri']);
    $Pri = mysqli_real_escape_string($conn, $_POST['Pri']);
    $Pri = mysqli_real_escape_string($conn, $_POST['Pri']);
//jhjkj
    $sql = "INSERT INTO `sprint_retro_table`( `sprint_id`, `sprint_retro_description`, `date`, `start_t`, `end_t`) VALUES ('','','','','')";
}