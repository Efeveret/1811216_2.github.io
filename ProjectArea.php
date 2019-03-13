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
                <a href="Profilepg.php" style="text-underline: none">Profile Page</a><br><br>
            </div>

            <section class="container" id ="cont1" style="background-color: #9c9c9c; height: 150px">
                <br>
                <h2> Project Overview</h2>
                <?php
                session_start();
                $ProjName = "";
                $ProjName = $_SESSION['ProjName'];
                echo "<h2>Project: $ProjName [Sprint 1]</h2>";
                ?>
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
                            <input type="text" name="addPartners" required><br>


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
                session_start();
                include_once 'includes/dbh.inc.php';

                $Pid = mysqli_real_escape_string($conn,$_SESSION['ProjID']);


                $sql = "SELECT * FROM `user_project_table`,`users` WHERE user_project_table.user_id = users.id AND `project_id`= '$Pid'";
                $result = mysqli_query($conn,$sql);




                for ($i = 0; $i < mysqli_num_rows($result);  $i++){
                    while ($row = mysqli_fetch_assoc($result)){

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
                <h3 style="text-align: left; margin-left: 10px">1st Scrum Calender:</h3>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                        <div class="ScrumFeatures">
                            <form action="Sprint_Planning_Meeting.php">
                                <button type="submit">Sprint Planning Meeting</button>
                            </form>
                            <form action="Daily_Meeting.php">
                                <button type="submit">Daily Meeting</button>
                            </form>
                            <form action="Sprint_Review_Meeting.php">
                                <button type="submit">Sprint Review Meeting</button>
                            </form>
                            <form action="Sprint_Retrospective_Meeting.php">
                                <button type="submit">Sprint Retrospective</button>
                            </form><br><br>
                            <form action="Product_Backlog_Ref.php">
                                <button type="submit">Product Backlog Refinement</button>
                            </form><br><br>
                            <form action="Sprint_Backlog.php">
                                <button type="submit">Sprint Backlog</button>
                            </form>
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