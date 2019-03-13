<?php
include 'includes/dbh.inc.php';

if(isset($_POST['safe'])){
$_SESSION['ProjName'] = $_POST['choice'];

echo $_SESSION['ProjName'];
var_dump($_SESSION['ProjName']);
print_r($_SESSION['ProjName']);
}
