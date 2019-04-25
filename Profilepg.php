<?php
session_start();

if(!isset($_SESSION['u_username'])){
    header("Location: http://csdm-webdev.rgu.ac.uk/1811216/1811216_2.github.io/index.php?login=nouser");
}
?>
    <!DOCTYPE html>
        <html>
             <head>
                <title>My Profile</title>
                 <!--Add CSS links-->
                 <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css"/>
                 <link rel="stylesheet" href="assets/CSS/style.css"/>
                 <!--Override style CSS-->
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
                 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                 <link href = "fontello.css" rel = "stylesheet" type = "text/css" />
                 <script type="text/javascript" src="clock.js"></script>
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
                 <script>
                     $(function(){
                         $("#tabs").tabs();
                     });
                 </script>
             </head>
             <body onload="countdown();">
                    <header>
                        <!--Logged in set header-->
                        <p style='float: left; margin-top: 10px ; font-weight: bold;font-size: 34px; color: white;border: 1px solid white; border-radius: 10px; margin-left: 5px; width: 102px; padding: 3px 15px 3px 15px'>DAWN</p>
                        <?php

                        $user01 = "";
                        $user01 = $_SESSION['u_username'];
                        echo "<p style='margin-top: 10px; color: white; text-align: right; margin-right: 10px'> Welcome $user01</p>";
                        ?>
                        <!--Log out button-->
                        <form action="includes/logout.inc.php" method="POST">
                            <input type="submit" name="logout" value="Log-Out" style="float: right; color: red; margin-right: 10px ">
                        </form>
                    </header>
                    <main >
                        <!--Navigation Links-->
                        <section>
                            <nav id="top">
                                <br>
                                <div id='leftnavlink' style="margin-left: 2%;">
                                    <a class='primary_navlink' href="index.php">Home</a> |
                                    <a class='primary_navlink' href="#">About</a>
                                </div><br>
                            </nav>
                        </section>
                        <div id="clock" ></div>
                        <br>

                        <center>
                            <!--Webpage Header with User's Names-->
                            <div id='welcome' style="background-color: #999999; height: 150px">
                                <br>
                                <h2>Welcome to your Profile Page </h2>
                                <?php
                                include_once 'includes/dbh.inc.php';

                                $imageURL = "assets/uploads/".$_SESSION['u_pic'];

                                if (empty($_SESSION['u_pic'])) { ?>
                                    <img src="assets/images/default_user_icon.png" alt="Default Pic"
                                         onclick="document.getElementById('id02').style.display='block'"
                                         style="width: 100px; height: 100px;">

                                    <?php
                                }else{ ?>
                                    <img src="<?php echo $imageURL; ?>" alt="uploaded"
                                         onclick="document.getElementById('id02').style.display='block'"
                                         style="width: 100px; height: 100px; border-radius: 50%;">
                                    <?php
                                }

                                $user01 = "";
                                $user01 = $_SESSION['u_first']." ".$_SESSION['u_last'];
                                echo "<h2><font color='red'>$user01</font></h2>";
                                //echo "<p style='margin-top: 10px; color: white; text-align: right; margin-right: 10px'> Welcome $user01</p>";
                                ?>
                            </div>

                            <br><br><br><br><br><br><br><br>
                            <div id="tabs" class="Ctabs">
                                <ul >
                                    <li><a href="#tabs-1">New Project</a></li>
                                    <li><a href="#tabs-2">Current Projects</a></li>
                                </ul>
                            <!--Popup box to create new Project-->
                                <div id="tabs-1">
                                    <div>
                                        <strong>Would you like to build a new project?</strong><br><br>
                                        <!-- Button to open the modal login form -->
                                        <button onclick="document.getElementById('id01').style.display='block'">Build New Project</button>
                                    </div>
                                </div>



                            <!--Load Current user's Project Names-->
                                <div id="tabs-2">
                                    <div>
                                        <div id="yourprojects">
                                            <h3>Your Current Projects</h3><br>
                                            <center>
                                                <form onsubmit="return confirm('Are you sure?')" class="load_Proj" action="includes/loadProj.php" method="POST">
                                                    <select name="choice" multiple>
                                                        <?php

                                                        $uid = mysqli_real_escape_string($conn,$_SESSION['u_id']);

                                                        $sql = "SELECT project_table.Project_Name FROM user_project_table , project_table WHERE user_project_table.project_id = project_table.Project_ID AND user_project_table.user_id = '$uid'";
                                                        $result = mysqli_query($conn,$sql);

                                                        for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                                                            while ($row = mysqli_fetch_assoc($result)){
                                                                //$abc = $row["Project_ID"];
                                                                echo "<option>".$row["Project_Name"]."</option><br>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <button type="submit" name="safe">Load</button>
                                                    <button type="submit"  name="safe1" id="deleteItem">Delete</button>
                                                    <button type="submit" name="safe2">Leave Group</button>
                                                </form>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- The Modal -->



                            <div id="id01" class="modal">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                <!-- Modal Content -->
                                <form class="modal-content animate" action="includes/createProj.inc.php" method="POST">
                                    <center>
                                        <div class="container">
                                            <label for="uname"><b>Input New Project Name</b></label><br><br>
                                            <input type="text" name="NewProj" required><br>
                                            <button type="submit" name="submit">Submit</button>
                                        </div>
                                        <div class="container" style="background-color:#f1f1f1">
                                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                        </div>
                                    </center>
                                </form>
                            </div>


                            <div id="id02" class="modal">
                                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                                <!-- Modal Content -->
                                <form class="modal-content animate" action="includes/upload.php" method="POST" enctype="multipart/form-data">
                                    <center>
                                        <div class="container">
                                            <label for="uname"><b>Upload New Profile Pic:</b></label><br><br>
                                            <input type="file" name="file" required><br>
                                            <button type="submit" name="submit">Submit</button>
                                        </div>
                                        <div class="container" style="background-color:#f1f1f1">
                                            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                                        </div>
                                    </center>
                                </form>
                            </div>

                            <!--J-script for closing shadow upon clicking -->
                            <script>
                                // Get the modal
                                var modal = document.getElementById('id01');
                                var modals = document.getElementById('id02');

                                // When the user clicks anywhere outside of the modal, close it
                                window.onclick = function(event) {
                                    if ((event.target == modal) || (event.target == modals)) {
                                        modal.style.display = "none";
                                    }
                                }

                            </script>

                            <br><br><br>


                        </center>

                        <br/><br/><br/>

                                            </main>
                                             <footer>
                                                    <a href="#">FAQs</a>
                                                    <a href="#">Support</a>
                                                    <a href="#">About</a>
                                             </footer>
                                     </body>
                                </html>
