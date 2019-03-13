<?php
session_start();

if (isset($_POST['submit'])) {

    include 'dbh.inc.php';//connection file
    $_SESSION['Warning'] = FALSE;
    $uid = mysqli_real_escape_string($conn, $_POST['userid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if(empty($uid)||empty($pwd)){
        header("Location: ../index.php?login=empty");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE username='$uid' OR email='$uid'  ";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1){
            $_SESSION['Warning'] = TRUE;
            header("Location: ../index.php?login=error");
            exit();


        }else{
            if($row = mysqli_fetch_assoc($result)){
                //De-hashing password
                //$hashedPwdCheck = password_verify($pwd. $row['pass']);
                $hashedPWDCheck = password_verify($pwd,$row['pass']);

                if ($hashedPWDCheck == false){
                    $_SESSION['Warning'] = TRUE;
                    header("Location: ../index.php?login=error ");
                    exit();

                }elseif ($hashedPWDCheck == true){
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['u_first'] = $row['first_name'];
                    $_SESSION['u_last'] = $row['last_name'];
                    $_SESSION['u_username'] = $row['username'];
                    $_SESSION['u_pwd'] = $row['pass'];
                    $_SESSION['u_email'] = $row['email'];

                    header("Location: ../Profilepg.php?signin=success");
                    //header("Location: ../ProjectArea.php?signup=success");
                    exit();
                }
            }
        }
        }

}else{
    header("Location: ../index.php?login=error1");
    exit();}
