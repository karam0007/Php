<!DOCTYPE html>
<?php
$id="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_POST["id"])){
        $id=$_POST['id'];
        
        $conn = new mysqli("localhost","root","","employees");
        if($conn->connect_error){
            die("error in connection".$conn->connect_error);
        }
        $query="SELECT * FROM info WHERE ID ='$id'";
        $result=$conn->query($query);
        if($result->num_rows >0){
           $row=$result->fetch_assoc();
            echo $row["Id"]."<br>" ;
            echo $row["Name"]."<br>" ;
            echo $row["Email"]."<br>" ;
            echo $row["Website"]."<br>" ;
            $conn->close();
        }
    }
}



?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="number" name="id">
        <input type="submit">
        </form>
        <a href="Page3.php">Page3</a>
        
    </body>
</html>
