<?php
session_start();

if(!isset($_SESSION['u_username'])){
    header("Location: http://csdm-webdev.rgu.ac.uk/1811216/1811216_2.github.io/index.php?login=nouser");
}
include 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sprint Backlog</title>
    <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css"/>
    <link rel="stylesheet" href="assets/CSS/style.css"/>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "input" ).checkboxradio();
            $( "fieldset" ).controlgroup();
        } );
    </script>
    <style>
        body {
background-color: white;
            margin-bottom: 100px;

        }
        main{
            border: white;
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
        <h2>Sprint Backlog</h2>
    </div>

    <form action="includes/addTasks.php" method="POST">
        <fieldset>
            <h3>Sprint Backlog</h3><br><br>
        <table style="width:100%">
            <tr>
                <th>Sprint Items</th>
                <th>Tasks</th>
                <th>Status</th>
                <th>Comment</th>
            </tr>

            <?php

            include_once 'includes/dbh.inc.php';

            $sprid = mysqli_real_escape_string($conn,$_SESSION['Sprint_id']);

            $sql = "SELECT * FROM `sprint_bl`, `product_backlog`, `sprintbl_tasks` WHERE product_backlog.backlogid = sprint_bl.pbl_id AND sprint_bl.sprintBL_id=sprintbl_tasks.sib_id AND product_backlog.sprint_id = '$sprid'";
            $result = mysqli_query($conn,$sql);

            for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                while ($row = mysqli_fetch_assoc($result)){
                    //$abc = $row["Project_ID"];

                    echo "<tr>";
                    echo "<td>".$row["ProItem"]."</td>";
                    echo "<td>".$row["task_name"]."</td>";
                    echo "<td>".$row["statues"]."</td>";
                    echo "<td>".$row["comment"]."</td>";
                    echo "</tr>";
                }
            }
            ?>

            <tr>
                <td>
                    <select name="itemsselect">
                        <?php


                        $sql = "SELECT * FROM `sprint_bl`, `product_backlog` WHERE product_backlog.backlogid = sprint_bl.pbl_id AND product_backlog.sprint_id = '$sprid'";
                        $result = mysqli_query($conn,$sql);

                        for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                            while ($row = mysqli_fetch_assoc($result)){
                                //$abc = $row["Project_ID"];
                                echo "<option>".$row["ProItem"]."</option>";
                            }
                        }

                        ?>
                    </select>
                </td>
                <td><input type="text" name="SED" required></td>
                <td>
                    <select name="statSelected">
                        <option style="width: 60px">Not Started</option>
                        <option style="width: 60px">Work in Progress</option>
                        <option style="width: 60px">Completed</option>
                    </select>
                </td>
                <td><input type="text" name="SED1" required></td>
            </tr>
        </table>
        </fieldset>
        <button type="submit" name="submit">Add Task</button>
        </form><br>
    <form action="includes/addTasks.php" method="POST">
        <p><strong>Update item status:</strong></p>
        <p>Select Item</p>
        <select name="itemsselect" required>
            <?php


            $sql = "SELECT * FROM `sprint_bl`, `product_backlog` WHERE product_backlog.backlogid = sprint_bl.pbl_id AND product_backlog.sprint_id = '$sprid'";
            $result = mysqli_query($conn,$sql);

            for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                while ($row = mysqli_fetch_assoc($result)){
                    //$abc = $row["Project_ID"];
                    echo "<option>".$row["ProItem"]."</option>";
                }
            }

            ?>
        </select>
        <p>Select Status</p>
        <select name="statSelected" required>
            <option style="width: 60px">Not Started</option>
            <option style="width: 60px">Work in Progress</option>
            <option style="width: 60px">Completed</option>
        </select><br>
        <button type="submit" name="submit01">Update item status</button>
    </form>
        <br>
        <br>


</main>
<footer>

</footer>
</body>
</html>