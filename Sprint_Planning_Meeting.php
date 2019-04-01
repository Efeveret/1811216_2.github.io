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
                <title>Sprint Planning Meeting</title>
                <!--Add CSS links-->
                <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css"/>
                <link rel="stylesheet" href="assets/CSS/style.css"/>
                <!--Override style CSS-->
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <link rel="stylesheet" href="/resources/demos/style.css">
                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script>
                    $( function() {
                        $( "#datepicker" ).datepicker({
                            showOn: "button",
                            buttonImage: "assets/images/calendar-image-png-15.png",
                            buttonImageOnly: true,
                            buttonText: "Select date"
                        });
                    } );
                    $( function() {
                        $( "#datepicker01" ).datepicker({
                            showOn: "button",
                            buttonImage: "assets/images/calendar-image-png-15.png",
                            buttonImageOnly: true,
                            buttonText: "Select date"
                        });
                    } );
                    $( function() {
                        $( "#datepicker02" ).datepicker({
                            showOn: "button",
                            buttonImage: "assets/images/calendar-image-png-15.png",
                            buttonImageOnly: true,
                            buttonText: "Select date"
                        });
                    } );
                    $( function() {
                        $( "#datepicker03" ).datepicker({
                            showOn: "button",
                            buttonImage: "assets/images/calendar-image-png-15.png",
                            buttonImageOnly: true,
                            buttonText: "Select date"
                        });
                    } );
                </script>
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






            <body style="padding-bottom: 10%">


                <header>
                    <!--Logged in set header-->
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
                    <!--Navigation Links-->
                    <div  style="margin-left: 2%;">
                        <br>
                        <a href="ProjectArea.php" style="text-underline: none">Back: Project Overview</a><br><br>
                    </div>

                    <!--Webpage Header-->
                    <div id='welcome' style="background-color: #999999; height: 150px"><br>
                        <h2>Sprint Planning Meeting</h2>
                    </div>

                    <!--Inputting section for SPM-->
                    <form action="includes/AddProItems.php" method="POST">
                        <p>Sprint Start Date:</p>
                        <input type="text" name="ssd" id="datepicker">
                        <p>Sprint End Date:</p>
                        <input type="text" name="sed" id="datepicker01">
                        <p>Sprint Review Meeting Date:</p>
                        <input type="text" name="srmd" id="datepicker02">
                        <p>Sprint Retrospective Meeting Date:</p>
                        <input type="text" name="sretromd" id="datepicker03">
                        <br>
                        <br>

                        <!--Product Backlog Table-->
                        <div>
                            <h3>Product Backlog</h3><br>
                            <center>
                                <table style="width:100%">
                                    <tr>
                                        <th>Priority</th>
                                        <th>Task Name</th>
                                        <th>Acceptance Criteria</th>
                                        <th>Effort Points</th>
                                        <th>Comments</th>
                                    </tr>
                                    <?php

                                    include_once 'includes/dbh.inc.php';

                                    $sprid = mysqli_real_escape_string($conn,$_SESSION['Sprint_id']);

                                    $sql = "SELECT * FROM `product_backlog` WHERE `sprint_id`='$sprid'";
                                    $result = mysqli_query($conn,$sql);

                                    for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                                        while ($row = mysqli_fetch_assoc($result)){
                                            //$abc = $row["Project_ID"];

                                            echo "<tr>";
                                            echo "<td>".$row["Priority"]."</td>";
                                            echo "<td>".$row["ProItem"]."</td>";
                                            echo "<td>".$row["AccCrit"]."</td>";
                                            echo "<td>".$row["EffPoint"]."</td>";
                                            echo "<td>".$row["comment"]."</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td><input type="text" name="Pri" ></td>
                                        <td><input type="text" name="Task" ></td>
                                        <td><input type="text" name="AC" ></td>
                                        <td><input type="text" name="EF" ></td>
                                        <td><input type="text" name="Comment" ></td>
                                    </tr>
                                </table>
                            </center>

                            <aside>
                                <button type="submit" name="submit01">Add</button><br><br><br><br>
                            </aside>
                        </div>
                        <!--Sprint Backlog Table-->
                        <div>
                            <h3>Sprint Backlog</h3><br>
                            <div>
                                <select name="choice01">
                                    <?php


                                    $sprid = mysqli_real_escape_string($conn,$_SESSION['Sprint_id']);

                                    $sql = "SELECT * FROM `product_backlog` WHERE `sprint_id`='$sprid'";
                                    $result = mysqli_query($conn,$sql);

                                    for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                                        while ($row = mysqli_fetch_assoc($result)){
                                            //$abc = $row["Project_ID"];


                                            echo "<option>".$row["ProItem"]."</option><br>";

                                        }
                                    }
                                    ?>
                                </select>
                                <aside>
                                    <button type="submit" name="submit02">Add</button>
                                </aside><br>
                                <table style="width:100%">
                                    <tr>
                                        <th>Sprint Items</th>
                                    </tr>
                                    <!--auto generated table-->
                                    <?php

                                    $sprid01 = mysqli_real_escape_string($conn,$_SESSION['Sprint_id']);

                                    $sql01 = "SELECT * FROM `sprint_bl`, `product_backlog` WHERE product_backlog.backlogid = sprint_bl.pbl_id AND product_backlog.sprint_id = '$sprid01'";
                                    $result = mysqli_query($conn,$sql01);

                                    for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                                        while ($row = mysqli_fetch_assoc($result)){
                                            //$abc = $row["Project_ID"];

                                            echo "<tr>";
                                            echo "<td>".$row["ProItem"]."</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>


                            </div>
                            <br><br>
                        </div>
                        <button type="submit" name="submitF">Save</button>
                        <br>
                        <br>
                    </form>


                </main>


                <footer>

                </footer>
            </body>






        </html>