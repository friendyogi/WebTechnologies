<!DOCTYPE html>
<html lang="en">
    <head>
        <title>2020ht66501 HTML Form</title>
        <meta charset="utf-8">
    </head>
     <body>
        <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "employee";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);

            // Check connection
            if(!$conn) {
            die("<h4>ERROR: connection failed</h4>" . mysqli_connect_error());
            }
            echo "<h4>Mysql connection successful</h4>";

            // empty variable
            $deletename = $deletephone = $deletedob = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $deletename        =   validate_function($_POST["deletename"]); // catching variables from POST
                $deletephone       =   validate_function($_POST["deletephone"]);
                $deletedob         =   validate_function($_POST["deletedob"]);
            }
            function validate_function($formdata) {
              $formdata = trim($formdata);
              $formdata = stripslashes($formdata);
              $formdata = htmlspecialchars($formdata);
              return $formdata;
            }
            echo "<h4>Deleting records for name:</h4> $deletename";
            $result = mysqli_query($conn,"DELETE FROM profile WHERE name = '$deletename' AND phone = '$deletephone' AND dob = '$deletedob'");

            if($result)
            {
            	echo "<h4>DELETE FROM profile WHERE name = '$deletename' AND phone = '$deletephone' AND dob = '$deletedob'</h4>";
                echo "<h4>Mysql delete successful</h4>";
                mysqli_close($conn);
            }
            else
            {
                echo "<h4>Error while deleting record from mysql</h4>".mysqli_error($conn);
            }
        ?>
         <p><a href="index.php">Click here</a>to go to home page</p>
    </body>
</html>