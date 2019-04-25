<?php
session_start();

$user01 = $_SESSION['u_username'];

if (isset($_POST['submit05'])) {
    include 'dbh.inc.php';

    $choice = $_POST['choice05'];

    $sprid01 = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $BLitem = mysqli_real_escape_string($conn, $choice);

    $sql01 = "SELECT * FROM `product_backlog` WHERE `ProItem`= '$BLitem' AND `sprint_id`= '$sprid01'";
    $result01 = mysqli_query($conn, $sql01);
    $row = mysqli_fetch_assoc($result01);


    $pbiid = mysqli_real_escape_string($conn, $row['backlogid']);
    $sql02 = "SELECT * FROM `sprint_bl`, product_backlog WHERE sprint_bl.pbl_id = product_backlog.backlogid AND `pbl_id`= '$pbiid'";
    $result02 = mysqli_query($conn, $sql02);
    $check = mysqli_num_rows($result02);

    $priority = $row['Priority'];

    $sql03 = "SELECT backlogid, Priority FROM `product_backlog` WHERE `sprint_id`= '$sprid01' and Priority > '$priority' ";
    $result03 = mysqli_query($conn, $sql03);

    $Id2Change = array();

    for ($i = 0; $i < mysqli_num_rows($result03); $i++) {
        while ($row2 = mysqli_fetch_assoc($result03)) {

            $Id2Change[$i] = $row2['backlogid'];

            $change = $Id2Change[$i];

            Echo $change;


            $sql04 = "UPDATE `product_backlog` SET `Priority`= (Priority - 1) WHERE `backlogid`= '$change'";
            mysqli_query($conn, $sql04);
        }
    }



    $sqlITEMNAME = "SELECT * FROM `product_backlog` WHERE `sprint_id`= '$sprid01'";
    $resultITEM = mysqli_query($conn,$sqlITEMNAME);
    $row3 = mysqli_fetch_assoc($resultITEM);
    $ItemName = $row3['ProItem'];
    $sqlUpdate =  $sql = "INSERT INTO pb_update (`ProductBLID`,`INFO` ) VALUES ('$sprid01', '$user01 has deleted $ItemName ');";
    $resultUpdate = mysqli_query($conn,$sql);


    $sql05 = "DELETE FROM `product_backlog` WHERE `backlogid` = '$pbiid'";
    mysqli_query($conn, $sql05);
    header("Location: ../Product_Backlog_Ref.php");
    header("Location: ../Product_Backlog_Ref.php");



}elseif (isset($_POST['submit06'])) {
    include 'dbh.inc.php';

    $choice = $_POST['choice05'];

    $sprid01 = mysqli_real_escape_string($conn, $_SESSION['Sprint_id']);
    $BLitem = mysqli_real_escape_string($conn, $choice);

    $sql01 = "SELECT * FROM `product_backlog` WHERE `ProItem`= '$BLitem' AND `sprint_id`= '$sprid01'";
    $result01 = mysqli_query($conn, $sql01);
    $row = mysqli_fetch_assoc($result01);


    $pbiid = mysqli_real_escape_string($conn, $row['backlogid']);
    $sql02 = "SELECT * FROM `sprint_bl`, product_backlog WHERE sprint_bl.pbl_id = product_backlog.backlogid AND `pbl_id`= '$pbiid'";
    $result02 = mysqli_query($conn, $sql02);
    $check = mysqli_num_rows($result02);


    $newP = $_POST['New_Priority'];


    $priority = $row['Priority'];

    $sql03 = "SELECT backlogid, Priority FROM `product_backlog` WHERE `sprint_id`= '$sprid01' and Priority >= '$newP' ";
    $result03 = mysqli_query($conn, $sql03);

    $Id3Change = array();


    for ($i = 0; $i < mysqli_num_rows($result03); $i++) {
        while ($row2 = mysqli_fetch_assoc($result03)) {

            $Id3Change[$i] = $row2['backlogid'];

            $change = $Id3Change[$i];

            $sql04 = "UPDATE `product_backlog` SET `Priority`= (Priority + 1) WHERE `backlogid`= '$change'";
            mysqli_query($conn, $sql04);
        }
    }

    $sql06 = "UPDATE `product_backlog` SET `Priority`= '$newP' WHERE `backlogid`= '$pbiid'";
    mysqli_query($conn, $sql06);


    header("Location: ../Product_Backlog_Ref.php");


    $sqlReset = "SELECT * FROM `product_backlog` WHERE `sprint_id`= '$sprid01' ";
    $result07 = mysqli_query($conn, $sqlReset);

    echo mysqli_num_rows($result07);


    $Change = array();


    $num = mysqli_num_rows($result07);


    $sqlITEMNAME = "SELECT * FROM `product_backlog` WHERE `sprint_id`= '$sprid01'";
    $resultITEM = mysqli_query($conn, $sqlITEMNAME);
    $row3 = mysqli_fetch_assoc($resultITEM);

    $ItemName = $row3['ProItem'];


    $sqlUpdate = "INSERT INTO pb_update (`ProductBLID`,`INFO` ) VALUES ('$sprid01', '$user01 changed the priority of $ItemName to $newP');";
    $resultUpdate = mysqli_query($conn, $sqlUpdate);

    header("Location: ../Product_Backlog_Ref.php");


}




/*

    $_SESSION['count'] = 1;
    for ($c = 0; $c < $num; $c++) {
        while ($row2 = mysqli_fetch_assoc($result07)) {


            $NEWP = $_SESSION['count'];
            $Change[$c] = $row2['backlogid'];
            $change = $Change[$c];
            $sql08 = "UPDATE `product_backlog` SET `Priority`= '$NEWP'  WHERE `backlogid`='$change'";
            mysqli_query($conn, $sql08);

            $_SESSION['count']++;
        }
    }


*/











