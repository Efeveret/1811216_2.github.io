<?php
session_start();
include_once 'dbh.inc.php';
if(isset($_POST['safe'])){



    $_SESSION['ProjName'] = $_POST['choice'];

    $proName = mysqli_real_escape_string($conn,$_SESSION['ProjName']);
    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

    $sql = "SELECT sprint_table.*, project_table.Project_Name FROM `sprint_table`, `user_project_table`, `project_table` WHERE user_project_table.project_id = project_table.Project_ID AND project_table.Project_ID=sprint_table.proj_id AND user_project_table.user_id = '$uid' AND project_table.Project_Name = '$proName'";
    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($result);

    $_SESSION['ProjID'] = $row['proj_id'];
    $_SESSION['ProjName'] = $row['Project_Name'];
    $_SESSION['Sprint_id'] = $row['Sprint_id'];
    $_SESSION['Sprint_num'] = $row['sprint_num'];

    header("Location: ../ProjectArea.php?loaded01");
    exit;


}elseif (isset($_POST['safe1'])) {


    $_SESSION['ProjName'] = $_POST['choice'];

    $proName = mysqli_real_escape_string($conn,$_SESSION['ProjName']);
    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

    $sql = "SELECT project_table.Project_ID FROM user_project_table , project_table WHERE user_project_table.project_id = project_table.Project_ID AND user_project_table.user_id = '$uid' AND project_table.Project_Name = '$proName'";
    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($result);

    $proID = mysqli_real_escape_string($conn,$row['Project_ID']);

    $sql1 = "DELETE FROM `project_table` WHERE `Project_ID` = '$proID'";
    $result1 = mysqli_query($conn,$sql1);

    $sql2 = "DELETE FROM `user_project_table` WHERE `user_id` = '$uid' AND `project_id`='$proID'";
    $result2 = mysqli_query($conn,$sql2);


    header("Location: ../Profilepg.php?dropped");
    exit;


} elseif (isset($_POST['safe2'])){

    $_SESSION['ProjName'] = $_POST['choice'];

    $proName = mysqli_real_escape_string($conn,$_SESSION['ProjName']);
    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

    $sql = "SELECT project_table.Project_ID FROM user_project_table , project_table WHERE user_project_table.project_id = project_table.Project_ID AND user_project_table.user_id = '$uid' AND project_table.Project_Name = '$proName'";
    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($result);

    $proID = mysqli_real_escape_string($conn,$row['Project_ID']);

    $sql2 = "DELETE FROM `user_project_table` WHERE `user_id` = '$uid' AND `project_id`='$proID'";
    $result2 = mysqli_query($conn,$sql2);
    header("Location: ../Profilepg.php?dropped");
    exit;
}

else{
    header("Location: ../index.php");
    exit();}