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
    <title>Sprint Backlog</title>
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
    session_start();
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
        <h2>Sprint Backlog</h2>
    </div>

    <form>
            <h3>Sprint Backlog</h3><br><br>
        <table style="width:100%">
            <tr>
                <th>Sprint Items</th>
                <th>Tasks</th>
                <th>Not Started</th>
                <th>Work in Progress</th>
                <th>Completed</th>
                <th>Acceptance Criteria</th>
            </tr>
            <tr>
                <td><input type="text" name="SED" required></td>
                <td><input type="text" name="SED" required></td>
                <td><input type="text" name="SED" required></td>
                <td><input type="text" name="SED" required></td>
                <td><input type="text" name="SED" required></td>
                <td><input type="text" name="SED" required></td>
            </tr>
        </table>
        </form>
        <button type="submit" name="submit">Save</button>
        <br>
        <br>
    </form>


</main>
<footer>

</footer>
</body>
</html>