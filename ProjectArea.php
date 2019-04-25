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
        <title>Project Area</title>
        <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css"/>
        <link rel="stylesheet" href="assets/CSS/style.css"/>

        <style>
            body {
                background-image: url("assets/images/alex-jodoin-246078-unsplash.jpg");
                background-repeat: no-repeat;
                background-size: 100% 150%;
                margin-bottom: 100px;
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
                <a href="Profilepg.php" style="text-underline: none">Profile Page</a><br><br>
            </div>

            <section class="container" id ="cont1" >
                <br>
                <div style="background-color: #a4a4a4;padding-top: 15px;padding-bottom: 15px">
                <h2> Project Overview</h2>
                <?php
                $ProjName = "";
                $SprintNum = 1;
                $ProjName = $_SESSION['ProjName'];
                $SprintNum = $_SESSION['Sprint_num'];
                echo "<h2>Project: $ProjName [Sprint $SprintNum]</h2>";
                ?>
                </div>
            </section>
            <section>
                <form action="includes/loadSprint.php" method="POST">
                <?php

                include 'includes/dbh.inc.php';

                $proid = mysqli_real_escape_string($conn,$_SESSION['ProjID']);
                $sprid = mysqli_real_escape_string($conn,$_SESSION['Sprint_id']);

                $sql = "SELECT * FROM `sprint_table` WHERE `proj_id`= '$proid'";
                $result = mysqli_query($conn,$sql);

                for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                    while ($row = mysqli_fetch_assoc($result)){
                        //$abc = $row["Project_ID"];
                        echo "<button type='submit' name='submit' value='".$row["sprint_num"]."'>".$row["sprint_num"]."</button>";
                    }
                }
                ?>
                </form>
            </section>
                <br><br>

            <!-- Button to open the modal login form -->
            <button onclick="document.getElementById('id01').style.display='block'">Add Project Partners</button>

            <!-- The Modal -->
            <div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
        class="close" title="Close Modal">&times;</span>

                <!-- Modal Content -->
                <form class="modal-content animate" action="includes/addPartners.php" method="POST">

                    <center>
                        <div class="container">
                            <label for="uname"><b>Input Partner's Username:</b></label><br><br>
                            <input list ="users" name="addPartners" required><br>
                            <datalist id="users">
                                <?php
                                $sqli = "SELECT `username` FROM `users`";
                                $resulti = mysqli_query($conn,$sqli);
                                for ($i = 0 ; $i < mysqli_num_rows($resulti);  $i++){
                                    while ($row = mysqli_fetch_assoc($resulti)){
                                        //$abc = $row["Project_ID"];
?>
                                        <option value="<?php echo $row['username']?>">
                                <?php
                                }
                                }
                                ?>


                            </datalist>

                            <button type="submit" name="submit">Submit</button>

                        </div>

                        <div class="container" style="background-color:#f1f1f1">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                        </div>
                    </center>
                </form>
            </div>
            <form class="load_partners">
                <?php

                $sql01 = "SELECT * FROM `user_project_table`,`users` WHERE user_project_table.user_id = users.id AND `project_id`= '$proid'";
                $result01 = mysqli_query($conn,$sql01);

                for ($i = 0; $i < mysqli_num_rows($result01);  $i++){
                    while ($row = mysqli_fetch_assoc($result01)){
                        echo "<a href='#' name='$i'>".$row["username"]."</a><br>";
                    }
                }
                ?>
            </form>
            <script>
                // Get the modal
                var modal = document.getElementById('id01');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>
                <br><br>

                        <div class="ScrumFeatures">
                            <form action="Sprint_Planning_Meeting.php">
                                <button type="submit">Sprint Planning Meeting</button>
                            </form>
                            <?php
                            $sql02 = "SELECT * FROM `sprint_plan_table` WHERE `sprint_id`= '$sprid'";
                            $result02 = mysqli_query($conn,$sql02);
                            $row02 = mysqli_fetch_assoc($result02);
                            $date1spm = $row02['start_date'];
                            $date2spm = $row02['end_date'];
                            $spmCom = $row02['comment'];
                            ?>
                            <div>
                                <p style='float: left; font-size: 23px;'><strong>Timeframe:</strong></p><br>
                                <p style='float: left; font-size: 23px;'>Sprint Start Date;  <?php echo $date1spm; ?></p><br>
                                <p style='float: left; font-size: 23px;'>Sprint End Date;  <?php echo $date2spm; ?></p><br><br>
                                <p style='float: left; font-size: 23px;'><strong>Project Overview:</strong></p><br>
                                <p style='float: left; font-size: 23px;text-align: left'><?php echo $spmCom; ?></p><br><br>

                            <?php

                            ?>
                            </div>
                            <form action="Daily_Meeting.php">
                                <button type="submit">Daily Meeting</button>
                            </form>
                            <?php
                            $sqlk = "SELECT * FROM user_project_table WHERE Project_ID='$proid'";
                            $resultk = mysqli_query($conn,$sqlk);
                            $row = mysqli_query($conn,"Select m.dm_id,us.first_name,us.last_name,m.date,m.start_t,m.end_t,i.have_done,i.to_do,i.issues,i.comments from daily_meeting m inner join individual_tasks i on m.dm_id=i.dm_id inner join users us on i.user_id=us.id order by m.dm_id desc");

                            echo "<table width='100%' border='1'>
                    <tr><td>SN</td><td>Full Name</td><td>Date</td><td>Start Time</td><td>End Time</td><td>Yesterday</td><td>Today</td><td>Issues</td><td>Comments</td></tr>";
                            $counter = 1;
                            while ($r = mysqli_fetch_assoc($row)){
                                echo "<tr><td>".$counter++."</td><td>".$r['first_name'].' '.$r['last_name']."</td><td>".$r['date']."</td><td>".$r['start_t']."</td><td>".$r['end_t']."</td><td>".$r['have_done']."</td><td>".$r['to_do']."</td><td>".$r['issues']."</td><td>".$r['comments']."</td></tr>";
                            }


                            echo "</table>";
                            ?>
                            <form action="Sprint_Review_Meeting.php">
                                <button type="submit">Sprint Review Meeting</button>
                            </form>
                            <?php
                            $sql04 = "SELECT * FROM `sprint_review_table` WHERE `sprint_id`= '$sprid'";
                            $result04 = mysqli_query($conn,$sql04);
                            $row04 = mysqli_fetch_assoc($result04);


                            $datespr = $row04['date'];
                            echo "<p style='float: left; font-size: 23px;'><strong>Date:</strong> $datespr</p><br>";

                            $start_time =$row04['start_t'];
                            $end_time=$row04['end_t'];
                            echo "<p style='float: left; font-size: 23px;'><strong>Times:</strong> $start_time - $end_time</p><br>";

                            $srd = $row04['sprint_rev_description'];
                            echo "<p style='float: left; font-size: 23px;'><strong>Sprint review description:</strong></p><br>";
                            echo "<p style='float: left; font-size: 23px;text-align: left; '>$srd</p>";
                            ?>
                            <form action="Sprint_Retrospective_Meeting.php">
                                <button type="submit">Sprint Retrospective</button>
                            </form>
                            <?php
                            $sql03 = "SELECT * FROM `sprint_retro_table` WHERE `sprint_id`= '$sprid'";
                            $result03 = mysqli_query($conn,$sql03);
                            $row03 = mysqli_fetch_assoc($result03);
                            $dat = $row03['date'];
                            $tims = $row03['start_t'];
                            $time = $row03['end_t'];
                            $comment = $row03['sprint_retro_description'];
                            ?>
                            <p style='float: left; font-size: 23px;'><strong>Date:</strong><?php echo $dat;?></p><br>
                            <p style='float: left; font-size: 23px;'><strong>Time:</strong><?php echo $tims." - ".$time;?></p><br>
                            <p style='float: left; font-size: 23px;'><strong>Review:</strong></p><br>
                            <p style='float: left; font-size: 23px;text-align: left;'><?php echo $comment;?></p><br>
                            <?php

                            ?><br><br>
                            <form action="Product_Backlog_Ref.php">
                                <button type="submit">Product Backlog Refinement</button>
                            </form><br>
                            <table style="width:100%">
                                <tr>
                                    <th>Priority</th>
                                    <th>Backlog Item</th>
                                    <th>Acceptance Criteria</th>
                                    <th>Effort Points</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                </tr>
                                <?php

                                $sqlZ = "SELECT * FROM `product_backlog` LEFT JOIN `sprint_bl` ON product_backlog.backlogid = sprint_bl.pbl_id LEFT JOIN `sprintbl_tasks` ON sprint_bl.sprintBL_id=sprintbl_tasks.sib_id WHERE sprint_id = '29' GROUP BY product_backlog.backlogid ";
                                $resultZ = mysqli_query($conn,$sqlZ);

                                for ($i = 0 ; $i < mysqli_num_rows($resultZ);  $i++){
                                    while ($row = mysqli_fetch_assoc($resultZ)){
                                        //$abc = $row["Project_ID"];

                                        echo "<tr>";
                                        echo "<td>".$row["Priority"]."</td>";
                                        echo "<td>".$row["ProItem"]."</td>";
                                        echo "<td>".$row["AccCrit"]."</td>";
                                        echo "<td>".$row["EffPoint"]."</td>";
                                        echo "<td>".$row["comment"]."</td>";
                                        echo "<td>".$row["statues"]."</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </table><br>

                            <p style='float: left; font-size: 23px;'><strong>Product Backlog log:</strong></p><br>
                            <?php

                            $sqlx = "SELECT INFO FROM `pb_update` WHERE `ProductBLID`='$sprid'";
                            $resultx = mysqli_query($conn,$sqlx);

                            for ($i = 0 ; $i < mysqli_num_rows($resultx);  $i++) {
                                while ($row3 = mysqli_fetch_assoc($resultx)) {
                                    //$abc = $row["Project_ID"];
                                    echo "<p style='float: left; font-size: 23px;'>" . $row3['INFO'] . "</p><br>";
                                }
                            }
                            ?>
                            <form action="Sprint_Backlog.php">
                                <button type="submit">Sprint Backlog</button>
                            </form>
                            <br><table style="width:100%">
                                <tr>
                                    <th>Sprint Items</th>
                                    <th>Tasks</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                </tr>
                                <?php

                                $sql5 = "SELECT * FROM `sprint_bl`, `product_backlog`, `sprintbl_tasks` WHERE product_backlog.backlogid = sprint_bl.pbl_id AND sprint_bl.sprintBL_id=sprintbl_tasks.sib_id AND product_backlog.sprint_id = '$sprid' ";
                                $result5 = mysqli_query($conn,$sql5);

                                for ($i = 0 ; $i < mysqli_num_rows($result5);  $i++){
                                    while ($row = mysqli_fetch_assoc($result5)){
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
                            </table>
                                <br>
                            <?php
                            $sqltt = "SELECT * FROM `sprint_table` WHERE `proj_id`= '$proid'";
                            $resulttt = mysqli_query($conn,$sqltt);
                            if (mysqli_num_rows($resulttt)==$_SESSION['Sprint_num']){
                            ?>
                                <form action="includes/newSprint.php" method="POST">
                                <button type="submit" style="background-color: #6FDF81" name="submit01">Next Sprint</button>
                            </form>
                            <?php
                            }
                            ?>

            <br><br><br><br><br>
                        </div>
        </main>
    <footer>

        <div class = "foot"; title = "FAQ"><a href = "#"> <i class="icon-help-circled"></i> </a></div>
        <div class = "foot"; title = "Contact"><a href = "#"> <i class="icon-mail-alt"></i> </a></div>
        <div class = "foot"; title = "Team"><a href = "#"><i class="icon-users"></i> </a></div>

    </footer>

    </body>
</html>