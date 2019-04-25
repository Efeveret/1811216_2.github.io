<?php
session_start();

include 'dbh.inc.php';//connection file

if(!$conn)
{	
echo 'Not Connected to Server';
}

if(!mysqli_select_db($conn,'db1811216_cmm04p'))
{
	echo 'Database not Selected';
}
$sprID = $_SESSION['Sprint_id'];

$ssd = date('Y-m-d', strtotime(str_replace('-', '/', $Date)));
$Start = $_POST['start'].":00";
$End = $_POST['end'].":00";

$Text = $_POST['Text1'];

$sql = "UPDATE `sprint_review_table` SET `sprint_rev_description`= '$Text',`start_t`='$Start',`end_t`='$End' WHERE `sprint_id`= '$sprID'";
$result = mysqli_query($conn,$sql);


header("Location: ../ProjectArea.php");
exit();



