<?php
session_start();
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $Pname = mysqli_real_escape_string($conn,$_POST['NewProj']);
    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

    $resultID = 0;

        if(empty($Pname)){
            header("Location: ../Profilepg.php=is_empty");
            exit();
        }else{
            //identify if the user has that same project name among their own project
            $sql = "SELECT project_table.Project_Name FROM user_project_table , project_table WHERE user_project_table.project_id = project_table.Project_ID AND user_project_table.user_id = '$uid' AND project_table.Project_Name = '$Pname'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0){
                header("Location: ../Profilepg.php?signup=table_taken");
                exit();
            }else{
                //if
                $sql = "INSERT INTO project_table (`Project_Name`) VALUES ('$Pname');";
                $result = mysqli_query($conn,$sql);
                $resultID = mysqli_insert_id($conn);

                $sql01 = "INSERT INTO `user_project_table`(`user_id`, `project_id`) VALUES ('$uid','$resultID')";
                $result01 = mysqli_query($conn,$sql01);

                $sql02 = "INSERT INTO `sprint_table`(`sprint_num`, `proj_id`) VALUES ('1','$resultID')";
                $result02 = mysqli_query($conn,$sql02);
                $resultID02 = mysqli_insert_id($conn);







                if (empty($result01)){
                    header("Location: ../Profilepg.php=failed_Input");
                    exit();
                }else{
                    $_SESSION['ProjName'] = $Pname;
                    $_SESSION['ProjID'] = $resultID;
                    $_SESSION['Sprint_id'] = $resultID02;
                    $_SESSION['Sprint_num'] = 1;

                    header("Location: ../ProjectArea.php");
                    exit();
                }



            }
        }
    }else{
    header("Location: ../index.php");
    exit();
}