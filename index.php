<!DOCTYPE html>
<?php

function dataTest($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = $email = $gender = $website = $emailerr = $namerr = $genderr = $websiterr = "";
$count = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["name"])) {
        $name = dataTest($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $namerr = "Please enter the name";
        } else {
            $count++;
        }
    }

    if (!empty($_POST["email"])) {
        $email = dataTest($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = "Please enter your email";
        } else {
            $count++;
        }
    }

    if (!empty($_POST["gender"])) {
        $gender = dataTest($_POST["gender"]);
        $count++;
    } else {
        $genderr = "Please enter your gender";
    }

    if (!empty($_POST["website"])) {
        $website = dataTest($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
            $websiterr = "Please enter your website";
        } else {
            $count++;
        }
    }
    if ($count == 4) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "employees";
        $conn = new mysqli("$servername", "$username", "$password", "$database");

        if ($conn->connect_error) {
            die("Connection failed" . $conn->connect_error);
        } else {
            $sql = "INSERT INTO info(Name , Email, Website,Gender) VALUES('$name','$email', '$website','$gender')";

            if ($conn->query($sql) === TRUE) {
                $id = $conn->insert_id;
                echo "info inserted successfully with id '$id'";
                $conn->close();
            }
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="grid">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label> Name:</label><br>
                <input type="text"  name="name"><br><br>
                <span><?php echo $namerr; ?></span><br><br>

                <label> Email:</label><br>
                <input type="email" name="email" ><br><br>
                <span><?php echo $emailerr; ?></span><br><br>

                <label> Website:</label><br>
                <input type="url" name="website"><br><br>
                <span><?php echo $websiterr; ?></span><br><br>

                <label>Gender:</label><br>
                <label> Male:</label><br>
                <input type="radio" name=gender value="male"><br><br>


                <label>Female:</label><br>
                <input type="radio" name=gender value="female"><br><br>

                <label>Other:</label><br>
                <input type="radio" name=gender value="other"><br><br>
                <br><br>

                <input type="submit"><br>
            </form>   
        </div>
        <a href="Page2.php">Page2</a>
        <input type="text" id="input" onkeyup="Hint(this.innerHTML);"><br>
        <span>Suggestions</span><span id="hint"></span>

        <?php
        $xml;
        libxml_use_internal_errors(true);
        $myxmlData = "<?xml version ='1.0' encoding='UTF-8'?>
                 <note>
                <to>Paula</to>
                <from>Karam</rom>
                <heading>am in live with you and i dont know what to do ,i think you are also in 
                love with me </heading>
                <body> will you marry me</body>
                </note>";

        if (!simplexml_load_string($myxmlData)) {
            foreach (libxml_get_errors() as $error) {
                echo "<br>" . $error->message;
            }
        }
        ?>
        <script>
            function Hint(str) {
                if (str.length == 0) {
                    document.getElementById("hint").innerHTML == "";
                    return;
                } else {
                    var xmlHttpp = new XMLHttpRequest();
                    xmlHttpp.onreadystatechange = function () {
                       if(this.readyState==4 && this.status==200){
                           document.getElementById("hint").innerHTML=this.responseText;
                       }
                    };
                    xmlHttpp.open("GET" , "gethint.php?q="+str, true);
                    xmlHttpp.send();
                }

            }
        </script>   
    </body>
</html>

