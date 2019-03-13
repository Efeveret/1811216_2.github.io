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
                    <!--Logged in set header-->
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
                    <!--Navigation Links-->
                    <div  style="margin-left: 2%;">
                        <br>
                        <a href="ProjectArea.php" style="text-underline: none">Back: Project Overview</a><br><br>
                    </div>

                    <!--Webpage Header-->
                    <div id='welcome' style="background-color: #999999; height: 150px">
                        <h2>Sprint Planning Meeting</h2>
                    </div>

                    <!--Inputting section for SPM-->
                    <form>
                        <p>Sprint Start Date:</p>
                        <input type="text" name="SSD" style="width:236px;" required>
                        <p>Sprint End Date:</p>
                        <input type="text" name="SED" style="width:236px; " required>
                        <p>Sprint Review Meeting Date:</p>
                        <input type="text" name="SRMD" style="width:236px; " required>
                        <p>Sprint Retrospective Meeting Date:</p>
                        <input type="text" name="SRepMD" style="width:236px; " required>
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
                                    <tr>
                                        <td><input type="text" name="SED" required></td>
                                        <td><input type="text" name="SED" required></td>
                                        <td><input type="text" name="SED" required></td>
                                        <td><input type="text" name="SED" required></td>
                                        <td><input type="text" name="SED" required></td>
                                    </tr>
                                </table>
                            </center>

                            <aside>
                                <button type="submit" name="submit">Add</button><br><br><br><br>
                            </aside>
                        </div>
                        <!--Sprint Backlog Table-->
                        <div>
                            <h3>Sprint Backlog</h3><br>
                            <form>
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

                                <aside>
                                    <button type="submit" name="submit">Add</button>
                                </aside>
                            </form>
                            <br><br>
                        </div>
                        <button type="submit" name="submit">Save</button>
                        <br>
                        <br>
                    </form>


                </main>


                <footer>

                </footer>
            </body>






        </html>