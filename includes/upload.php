<?php
session_start();
include 'dbh.inc.php';
$statusMsg = '';

$targetDir = "C:/inetpub/wwwroot/1811216/1811216_2.github.io/assets/uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $sql = "UPDATE `users` SET `proPic`= '".$fileName."' WHERE `id`= '$uid'";
            $insert =  mysqli_query($conn,$sql);

            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            }
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
    $_SESSION['u_pic'] = $fileName;
    header("Location: ../Profilepg.php");
    exit();
}else{
    header("Location: ../index.php?login=error1");
    exit();
}



