<!DOCTYPE html>
<html lang="en">
    <head>
        <title>2020ht66501 HTML Form</title>
        <meta charset="utf-8">

        <style>
            #asterisk {
                color: red;
            }

            .inlinedisp {
                display:inline;
            }

            .width-15 {
                float: left;
                width: 15%;

            }
        </style>
    </head>

    <script src="./script.js"></script>

    <body>
        <?php
            // empty variables
            $name = $address = $zipcode = $country = $gender = $dob = $preferences = $phone =  $email = $pass1 = "";
            // form input
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name         =   validate_function($_POST["name"]);        // capturing POST data
                $address      =   validate_function($_POST["address"]);
                $zipcode      =   validate_function($_POST["zipcode"]);
                $country      =   validate_function($_POST["country"]);
                $gender       =   validate_function($_POST["gender"]);
                $dob          =   validate_function($_POST["dob"]);
                $preferences  =   validate_function($_POST["preferences"]);
                $phone        =   validate_function($_POST["phone"]);
                $email        =   validate_function($_POST["email"]);
                $pass1        =   validate_function($_POST["pass1"]);
            }
            /* function to trim spaces, remove slashes and special chars to make the form more secure otherwise it can be hacked by using special chars like greater than, less than and slash  */
            function validate_function($formdata) {
              $formdata = trim($formdata);
              $formdata = stripslashes($formdata);
              $formdata = htmlspecialchars($formdata);
              return $formdata;
            }
        ?>
        <form  method="post" name="profile" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <fieldset>
                <p><h1>Test JavaScript Form Validation</h1>
                <label class="width-15" for="name">Name<p class="inlinedisp" id="asterisk">*</p></label>
                <input required type="text" name="name" id="name" autocomplete="off" autofocus />
                <br/>
                <!-- I am using "required" here to enforce user to fill all data in form -->

                <label class="width-15" for="address">Address<p class="inlinedisp" id="asterisk">*</p></label>
                <input required type="text" name="address" id="address" autocomplete="off" />
                <br/>

                <label class="width-15" for="zipcode">Zip Code<p class="inlinedisp" id="asterisk">*</p></label>
                <input required type="text" name="zipcode" id="zipcode" autocomplete="off" />
                <br/>

                <label class="width-15" for="country">Country<p class="inlinedisp" id="asterisk">*</p></label>
                <select name="country" id="country" value="Please select">
                    <option value="none" selected disabled hidden>
                        Please select
                    </option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="India">India</option>
                    <option value="Srilanka">Srilanka</option>
                </select>
                <br/>

                <label class="width-15" for="gender">Gender<p class="inlinedisp" id="asterisk">*</p></label>
                <label><input type="radio" name="gender" value="m" required> Male</label>
                <label><input type="radio" name="gender" value="f"> Female</label>
                <br/>

                <label class="width-15" for="dob">Birthday<p class="inlinedisp" id="asterisk">*</p></label>
                <input required type="date" name="dob" id="dob" min="1900-01-01" max="2010-01-01">
                <br/>

                <label class="width-15" for="preferences">Preferences<p class="inlinedisp" id="asterisk">*</p></label>
                <label><input type="checkbox" name="preferences" value="Red"> Red</label>
                <label><input type="checkbox" name="preferences" value="Green"> Green</label>
                <label><input type="checkbox" name="preferences" value="Blue"> Blue</label>
                <br/>

                <label class="width-15" for="phone">Phone<p class="inlinedisp" id="asterisk">*</p></label>
                <input required pattern="[789][0-9]{9}" type="tel" name="phone" id="phone"/>
                <br/>

                <label class="width-15" for="email">Email<p class="inlinedisp" id="asterisk">*</p></label>
                <input required type="email" name="email" id="email" />
                <br/>

                <label class="width-15" for="pass1">Password (8 characeters)<p class="inlinedisp" id="asterisk">*</p></label>
                <input required pattern=".{8,}" type="password" name="pass1" id="pass1"/>
                <br/>

                <label class="width-15" for="pass2">Verify Password<p class="inlinedisp" id="asterisk">*</p></label>
                <input required pattern=".{8,}" type="password" name="pass2" id="pass2"  onfocusout="verifyPassword(this)"/>
                <br/>

                <input  type="submit" onclick="validateForm()" value="SEND" />
                <button  type="reset" value="CLEAR">Reset</button>
            </fieldset>


        </form>
        <?php

        ?>
        <?php
            if ( !empty($name) && !empty($address) && !empty($zipcode) && !empty($country) && !empty($gender) && !empty($dob) && !empty($preferences) && !empty($phone) && !empty($email) && !empty($pass1) ) {
                echo "<h4>inserting following data into mysql</h4>";
                echo "$name <br> $address <br> $zipcode <br> $country <br> $gender <br> $dob <br> $preferences <br> $phone <br> $email <br> $pass1";
                $servername = "localhost";
                $username = "root";
                $password = ""; // no password is set for root user
                $database = "employee";

                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $database);

                // Check connection
                if(!$conn) {
                die("<h4>ERROR: connection failed</h4>" . mysqli_connect_error());
                }
                echo "<h4>Mysql connection successful</h4>";

                // sql statement to insert records into table
                $q = "INSERT INTO `profile` (`name`,`address`,`zipcode`,`country`,`gender`,`preferences`,`phone`,`email`,`password`,`dob`) VALUES ('".$name."','".$address."','".$zipcode."','".$country."','".$gender."','".$preferences."','".$phone."','".$email."','".$pass1."','".$dob."')";

                // inserting now
                if(mysqli_query($conn, $q))
                 {
                            echo "<h4>Mysql insert successful</h4>";
                            echo "<h2>Employees List</h2>";
                           $output = mysqli_query($conn,"SELECT * FROM profile"); // retrieving records

                            // creating table to show the records
                          echo "<table border=1>
                            <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Zipcode</th>
                            <th>Country</th>
                            <th>Gender</th>
                            <th>Preferences</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Date Of Birth</th>
                            </tr>";
                          while($row = mysqli_fetch_array($output))
                          {
                          echo "
                                <tr>
                                    <td>".$row['name']."</td>
                                    <td>".$row['address']."</td>
                                    <td>".$row['zipcode']."</td>
                                    <td>".$row['country']."</td>
                                    <td>".$row['gender']."</td>
                                    <td>".$row['preferences']."</td>
                                    <td>".$row['phone']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['password']."</td>
                                    <td>".$row['dob']."</td>";
                            // calling delete.php when delete button is clicked
                            echo    "<td>
                                       <form action=delete.php method=post>
                                          <input type=hidden name=deletename  value=".$row['name'].">
                                          <input type=hidden name=deletephone value=".$row['phone'].">
                                          <input type=hidden name=deletedob   value=".$row['dob'].">
                                          <input type=submit name=submitdelete value=Delete>
                                       </form>
                                    </td>";
                            echo  "</tr>";
                          }
                          echo "</table>";
                }
                else{
                    echo "<h4>Insert failed: $q</h4>".mysqli_error($conn);
                }

                // Close connection
                mysqli_close($conn);
            }
        ?>
    </body>
</html>