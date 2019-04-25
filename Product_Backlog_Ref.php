<?php
echo"bro";
session_start();

if(!isset($_SESSION['u_username'])){
    header("Location: http://csdm-webdev.rgu.ac.uk/1811216/1811216_2.github.io/index.php?login=nouser");
}
?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Backlog Refinement</title>
    <link rel="stylesheet" href="assets/CSS/unsemantic-grid-responsive-tablet.css"/>
    <link rel="stylesheet" href="assets/CSS/style.css"/>
    <style>
        body {
            background-color: white;
            margin-bottom: 100px;

        }
        main{
            background-color: white;
            border: white;


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
        <h2>Product Backlog Refinement</h2>
    </div>

    <form>
        <p>Meeting Date [dd/mm/yyyy]:</p>
        <input type="text" name="ssd" id="datepicker">
        <p>Start Time:</p>
        <input type="text" name="first" style="width:236px;" required>
        <p>End Time:</p>
        <input type="text" name="first" style="width:236px;" required>
        <br>
        <br>
        <button type="submit" name="submit">Save</button>
        <br>
        <br>
    </form>




    <div>
        <h3>Product Backlog</h3><br>

        <form action="includes/AddProRefItems.php" method="POST">


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

                $sql = "SELECT * FROM `product_backlog` WHERE `sprint_id`='$sprid' Order by `Priority` ASC ";
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

            <aside>
                <button type="submit" name="submit01">Add</button><br><br><br><br>
            </aside>
        </form>

            <form action="includes/UpdatePB.php" method="post">
            <h3>If you wish to delete an item please select task name</h3> <br>

            <select name="choice05">
                <?php

                $sprid = mysqli_real_escape_string($conn,$_SESSION['Sprint_id']);

                $sql = "SELECT ProItem FROM `product_backlog` WHERE `sprint_id`='$sprid'";
                $result = mysqli_query($conn,$sql);

                for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                    while ($row = mysqli_fetch_assoc($result)){
                        //$abc = $row["Project_ID"];


                        echo "<option>".$row["ProItem"]."</option><br>";

                    }
                }
                ?>
            </select>

                <button type="submit" name="submit05">Delete</button>

            </form>
            <br><br>

            <h3> If you wish to alter the priority of an item please select below</h3>

        <br>
        <form action="includes/UpdatePB.php" method="post">
        <select name="choice05">
            <?php

            $sprid = mysqli_real_escape_string($conn,$_SESSION['Sprint_id']);

            $sql = "SELECT ProItem FROM `product_backlog` WHERE `sprint_id`='$sprid'";
            $result = mysqli_query($conn,$sql);

            for ($i = 0 ; $i < mysqli_num_rows($result);  $i++){
                while ($row = mysqli_fetch_assoc($result)){
                    //$abc = $row["Project_ID"];


                    echo "<option>".$row["ProItem"]."</option><br>";

                }
            }
            ?>
        </select>





                <button onclick="document.getElementById('id02').style.display='block'"> Update Priority</button>


        <div id="id02" class="modal">
            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
            <!-- Modal Content -->
                    <div class="container">
                        <label for="uname"><b>What priority would you like to assign</b></label><br><br>
                        <input type="text" name="New_Priority" required><br>
                        <button type="submit" name="submit06">Submit</button>
                    </form>
                    </div>
                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                    </div>
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

<br><br>
    <h3> Product Backlog log </h3>
<?php

$sqlx = "SELECT INFO FROM `pb_update` WHERE `ProductBLID`='$sprid'";
$resultx = mysqli_query($conn,$sqlx);



for ($i = 0 ; $i < mysqli_num_rows($resultx);  $i++) {
    while ($row3 = mysqli_fetch_assoc($resultx)) {
        //$abc = $row["Project_ID"];

        echo "<p>" . $row3['INFO'] . "</p><br>";

    }
}


?>



</main>
<footer>
</footer>

    <script>
    $( function() {
        $( "#datepicker" ).datepicker({
            showOn: "button",
            buttonImage: "assets/images/calendar-image-png-15.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    } );
    </script>





</body>
</html>