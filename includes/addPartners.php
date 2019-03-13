<?php
session_start();
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $PartName = mysqli_real_escape_string($conn, $_POST['addPartners']);
    $Pid = mysqli_real_escape_string($conn, $_SESSION['ProjID']);

    $sql = "SELECT * FROM `users` WHERE username = '$PartName'";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $oid = mysqli_real_escape_string($conn, $row['id']);

    if($resultCheck < 1){
        header("Location: ../ProjectArea.php?user_doesnt_exist");
        exit();
    }else{

        $sql1 = "SELECT * FROM `user_project_table` WHERE `user_id`= '$oid' AND `project_id`= '$Pid'";
        $result1 = mysqli_query($conn,$sql1);
        $resultCheck1 = mysqli_num_rows($result1);

        if ($resultCheck1 > 0){
            header("Location: ../ProjectArea.php?user_aleady_in_project");
            exit();
        }else{
            $sql1 = "INSERT INTO `user_project_table`(`user_id`, `project_id`) VALUES ('$oid','$Pid')";
            $result1 = mysqli_query($conn,$sql1);
            header("Location: ../ProjectArea.php?success");
            exit();
        }

    }

}else{
    header("Location: ../ProjectArea.php");
    exit();
}