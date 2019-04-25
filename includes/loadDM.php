 <?php
session_start();

include 'dbh.inc.php';

if(isset($_POST['submit'])){

    $Date = mysqli_real_escape_string($conn,$_POST['date']);
    $ssd = date('Y-m-d', strtotime(str_replace('-', '/', $Date)));
    $Start01 = mysqli_real_escape_string($conn,$_POST['start']);
    $Start = $Start01.":00";
    $End01 = mysqli_real_escape_string($conn,$_POST['end']);
    $End = $End01.":00";
    $yes = mysqli_real_escape_string($conn,$_POST['yes']);
    $tod = mysqli_real_escape_string($conn,$_POST['tod']);
    $pe = mysqli_real_escape_string($conn,$_POST['pe']);
    $ac = mysqli_real_escape_string($conn,$_POST['ac']);
    $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

    $sql = "INSERT INTO `daily_meeting`(`date`, `start_t`, `end_t`) VALUES ('$ssd','$Start','$End')";
    $result = mysqli_query($conn, $sql);
    $last_id = mysqli_insert_id($conn);

    $sql01 = "INSERT INTO `individual_tasks`(`user_id`, `have_done`, `to_do`, `issues`, `comments`, `dm_id`) VALUES ('$uid','$yes','$tod','$pe','$ac','$last_id')";
    $result01 = mysqli_query($conn, $sql01);

    header("Location: ../ProjectArea.php");
    exit();
}else{
    header("Location: ../index.php");
    exit();
}



