<?php
session_start();

if(!isset($_SESSION['u_username'])){
    header("Location: http://csdm-webdev.rgu.ac.uk/1811216/1811216_2.github.io/index.php?login=nouser");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sprint Review Meeting</title>
    <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css"/>
    <link rel="stylesheet" href="assets/CSS/style.css"/>

    <style>
        body {
            background-image: url("assets/images/alex-jodoin-246078-unsplash.jpg");
            background-repeat: no-repeat;
            background-size: 100% 180%;

        }
        main{
            background-color: white;


        }
    </style>
</head>
<body>
<header>
    <p style='float: left; margin-top: 10px ; font-weight: bold;font-size: 34px; color: white;border: 1px solid white; border-radius: 10px; margin-left: 5px; width: 102px; padding: 3px 15px 3px 15px'>DAWN</p>
    <?php
    $user01 = "";
    $user01 = $_SESSION['u_username'];
    echo "<p style='margin-top: 10px; color: white; text-align: right; margin-right: 10px'> Welcome $user01</p>";
    ?>
    <form action="includes/logout.inc.php" method="POST">
        <input type="submit" name="logout" value="Log-Out" style="float: right; color: red; margin-right: 10px ">
    </form>
</header>
<main>
    <div  style="margin-left: 2%;">
        <br>
        <a href="ProjectArea.php" style="text-underline: none">Back: Project Overview</a><br><br>
    </div>
    <div id='welcome' style="background-color: #999999; height: 150px">
        <h2>Sprint Review Meeting</h2>
    </div>

    <form action = "includes/insertreview.php" method = "post">
        <p>Start Time:</p>
        <input type="text" name="start" style="width:236px;" required>
        <p>End Time:</p>
        <input type="text" name="end" style="width:236px;" required>
        <p>Product Owner Comments/Feedback:</p>
        <textarea name="Text1" cols="40" rows="5"></textarea>
        <br>
        <br>
        <button type="submit" name="submit">Save</button>
        <br>
        <br>
    </form>


</main>
<footer>

</footer>
</body>
</html>