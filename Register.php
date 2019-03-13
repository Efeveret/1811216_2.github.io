<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Register</title>
            <!---->
            <!--Add CSS links-->
            <link rel="stylesheet" href="assets/CSS/style.css">
            <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css">
            <!--Override style CSS-->
            <style>
                body{
                    background-image: url("assets/images/index_background.jpg");
                    background-repeat: no-repeat;
                }
            </style>
        </head>
        <body>
            <header>
            </header>
            <main>
                <h1>DAWN</h1>
                <h2>Registration Page</h2>
                <!--Inputting section for registration-->
                <form class="signup-form" action="includes/signup.inc.php" method="POST">
                    <div class="si_inside">
                        <p>*Given Name:</p>
                        <input type="text" name="first" style="width:236px;" required>
                        <p>*Family Name:</p>
                        <input type="text" name="last" style="width:236px; " required>
                        <p>*User ID:</p>
                        <input type="text" name="uid" style="width:236px; " required>
                        <p>*Password:</p>
                        <input type="password" name="pwd" style="width:236px; " required>
                        <p>*Email:</p>
                        <input type="text" name="email" style="width:236px;" required>
                        <br>
                        <br>
                        <button type="submit" name="submit">Register</button>
                        <br>
                        <br>
                        <a href="http://csdm-webdev.rgu.ac.uk/1811216/1811216_2.github.io/">Return to Previous Page</a>
                        <span class="PSTEXT">* Required Information</span>
                    </div>
                </form>
                <!--Hidden Error and Success Messages-->
                <div class="HiddenMs">
                <?php
                session_start();
                if (empty($_SESSION['register'])) {
                    exit;
                }
                if ($_SESSION['register']=="name101"){
                    echo "<p>Invalid Name (must not have numbers)</p>";
                    unset($_SESSION['register']);
                    exit;
                }else{
                    if ($_SESSION['register']=="email101"){
                       echo "<p>Invalid E-mail</p>";
                        unset($_SESSION['register']);
                       exit;
                    }else{
                        if ($_SESSION['register']=="user101"){
                           echo "<p>User already exists!</p>";
                            unset($_SESSION['register']);
                           exit;
                        }else{
                            echo "<p style='background-color: #6FDF81; color: black'>Successfuly Registered</p>";
                            unset($_SESSION['register']);
                            exit;
                        }
                    }
                }
                ?>
                </div>
            </main>
        </body>
    </html>