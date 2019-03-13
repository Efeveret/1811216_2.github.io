<?php
session_start();
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';



	$first = mysqli_real_escape_string($conn,$_POST['first']);//first is the name of the textbox
	$last = mysqli_real_escape_string($conn,$_POST['last']);
	$username = mysqli_real_escape_string($conn,$_POST['uid']);
	$pass = mysqli_real_escape_string($conn,$_POST['pwd']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);

    //Error Handlers
    //Check for empty fields
	if (empty($first) || empty($last)|| empty($username)|| empty($pass)|| empty($email)){
        header("Location: ../Register.php?signup=empty");
        exit();
        //Can add styling that makes text box red
    } else {
        $_SESSION['register'] = "sample";
	    //Check if input characters are valid
        //Check if names have numbers in them
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
            header("Location: ../Register.php?signup=invalid01");
            $_SESSION['register'] = "name101";
            exit();
        } else{
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../Register.php?signup=invalid_email");
                $_SESSION['register'] = "email101";
                exit();
            } else{
                //Check the database if there is a similar user
                $sql = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0){
                    header("Location: ../Register.php?signup=user_taken");
                    $_SESSION['register'] = "user101";
                    exit();
                } else{
                    //Hashing the password
                    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

                    //Inserting the user into the database
                    $sql = "INSERT INTO users (first_name, last_name, username, pass, email) VALUES ('$first', '$last', '$username', '$hashedPwd', '$email');";
                    $result = mysqli_query($conn,$sql);
                    header("Location: ../Register.php?signup=success");
                    exit();
                }
            }
        }
    }
} else{
    header("Location: ../Register.php");
    exit();
}