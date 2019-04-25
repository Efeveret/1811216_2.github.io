<?php
session_start();

if (isset($_POST['submit01'])) {

    include 'dbh.inc.php';//connection file
    $sprid = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $Pri = mysqli_real_escape_string($conn, $_POST['Pri']);
    $TaskI = mysqli_real_escape_string($conn, $_POST['Task']);
    $AC = mysqli_real_escape_string($conn, $_POST['AC']);
    $EF = mysqli_real_escape_string($conn, $_POST['EF']);
    $Comment = mysqli_real_escape_string($conn, $_POST['Comment']);

    $sql = "INSERT INTO `product_backlog`(`Priority`, `ProItem`, `AccCrit`, `EffPoint`, `comment`, `sprint_id`) VALUES ('$Pri', '$TaskI', '$AC', '$EF', '$Comment', '$sprid')";
    $result = mysqli_query($conn,$sql);


         header("Location: ../Sprint_Planning_Meeting.php?loadSuccess");
                    exit();

}elseif (isset($_POST['submit02'])){
    include 'dbh.inc.php';

        $choice = $_POST['choice01'];

    $sprid01 = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $BLitem = mysqli_real_escape_string($conn, $choice);

    $sql01 = "SELECT * FROM `product_backlog` WHERE `ProItem`= '$BLitem' AND `sprint_id`= '$sprid01'";
    $result01 = mysqli_query($conn,$sql01);
    $row = mysqli_fetch_assoc($result01);


    $pbiid = mysqli_real_escape_string($conn, $row['backlogid']);
    $sql02 = "SELECT * FROM `sprint_bl`, product_backlog WHERE sprint_bl.pbl_id = product_backlog.backlogid AND `pbl_id`= '$pbiid'";
    $result02 = mysqli_query($conn,$sql02);
    $check = mysqli_num_rows($result02);

if ($check>0){

    header("Location: ../Sprint_Planning_Meeting.php?alreadyexists");
    exit();
} else{
    $_SESSION['PB_id'] = $row['backlogid'];
    $spitem = mysqli_real_escape_string($conn, $_SESSION['PB_id']);

    $sql02 = "INSERT INTO `sprint_bl`(`pbl_id`) VALUES ('$spitem')";
    $result02 = mysqli_query($conn,$sql02);
}


    header("Location: ../Sprint_Planning_Meeting.php?loadSuccess");
    exit();
}elseif (isset($_POST['submitF'])){

    include 'dbh.inc.php';

    $sid = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $ssd = mysqli_real_escape_string($conn, $_POST['ssd']);
    $ssd = date('Y-m-d', strtotime(str_replace('-', '/', $ssd)));
    $sed = mysqli_real_escape_string($conn, $_POST['sed']);
    $sed = date('Y-m-d', strtotime(str_replace('-', '/', $sed)));
    $srmd = mysqli_real_escape_string($conn, $_POST['srmd']);
    $srmd = date('Y-m-d', strtotime(str_replace('-', '/', $srmd)));
    $sretromd = mysqli_real_escape_string($conn, $_POST['sretromd']);
    $sretromd = date('Y-m-d', strtotime(str_replace('-', '/', $sretromd)));
    $over = mysqli_real_escape_string($conn, $_POST['desc']);

    $sql03 = "INSERT INTO `sprint_plan_table`(`sprint_id`, `comment`, `start_date`, `end_date`) VALUES ('$sid','$over','$ssd','$sed')";
    $result = mysqli_query($conn,$sql03);

    $sql04 = "INSERT INTO `sprint_review_table`( `sprint_id`, `date`) VALUES ('$sid', '$srmd')";
    $result = mysqli_query($conn,$sql04);

    $sql05 = "INSERT INTO `sprint_retro_table`( `sprint_id`,`date`) VALUES ('$sid', '$sretromd')";
    $result = mysqli_query($conn,$sql05);

    header("Location: ../ProjectArea.php?loadedspm");
    exit();




}else{
    header("Location: ../index.php?login=error1");
    exit();
}

