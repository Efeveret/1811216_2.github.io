<?php
session_start();

if (isset($_POST['submit'])) {
    include 'dbh.inc.php';

    $sprid = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $Pri = mysqli_real_escape_string($conn, $_POST['SED']);
    $Pri1 = mysqli_real_escape_string($conn, $_POST['itemsselect']);
    $task = mysqli_real_escape_string($conn, $_POST['statSelected']);
    $comment = mysqli_real_escape_string($conn, $_POST['SED1']);

    $sql = "SELECT * FROM `sprint_bl`, `product_backlog` WHERE product_backlog.backlogid = sprint_bl.pbl_id AND product_backlog.sprint_id = '$sprid' AND product_backlog.ProItem = '$Pri1'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $itemid = $row['sprintBL_id'];


    $sql = "INSERT INTO `sprintbl_tasks`(`task_name`, `comment`, `sib_id`, `statues`) VALUES ('$Pri','$comment','$itemid','$task')";
    $result = mysqli_query($conn, $sql);

    header("Location: ../Sprint_Backlog.php?done");
    exit();
}elseif (isset($_POST['submit01'])){
    include 'dbh.inc.php';
    $sprid = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $Pri1 = mysqli_real_escape_string($conn, $_POST['itemsselect']);
    $task = mysqli_real_escape_string($conn, $_POST['statSelected']);

    $sql = "SELECT * FROM `sprint_bl`, `product_backlog` WHERE product_backlog.backlogid = sprint_bl.pbl_id AND product_backlog.sprint_id = '$sprid' AND product_backlog.ProItem = '$Pri1'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $itemid = $row['sprintBL_id'];


        $sql = "UPDATE `sprintbl_tasks` SET `statues`= '$task' WHERE `sib_id`= '$itemid'";
    $result = mysqli_query($conn, $sql);

    header("Location: ../Sprint_Backlog.php?done");
    exit();
}else{
    header("Location: ../index.php?login=error1");
    exit();
}
