<?php
session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Project Homepage!</title>
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
                <!--Title and subs-->
                <h1>DAWN</h1>
                <h2>Student Portal</h2>

                <!--Input for Sign-in-->
                <form class="signin-form" action="includes/signin.inc.php" method="POST">
                    <div id="form_inside">
                        <a href="#">Forgot User ID</a>
                        <br>
                        <input type="text" name="userid" placeholder="User ID" required>
                        <br>
                        <br>
                        <a href="#" >Forgot Password</a>
                        <br>
                        <input type="password" name="pwd" placeholder="Password" required>
                        <br>
                        <br>
                        <button id="sub" type="submit" class="signin_bu" name="submit">Login</button>
                        <br>
                        <br>
                        New user?
                        <a href="http://csdm-webdev.rgu.ac.uk/1811216/1811216_2.github.io/Register.php" class="">Create account here</a>
                    </div>
                </form>
                <!--Hidden Error messages for Sign-in-->
               <?php
               if (empty($_SESSION['Warning'])) {
                   //session_destroy();
                   exit;
               }
                   ?>
                   <div class="HiddenLIMF"  >
                       <br><p> Login Failed! </p>
                   </div>
                 <?php
                 unset($_SESSION['Warning']);

                 ?>
            </main>
        </body>
    </html>
