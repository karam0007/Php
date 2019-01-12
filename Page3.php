<!DOCTYPE html>
<?php
session_start();
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
    </head>
    <body>
        <?php

        class customException extends Exception {

            public function errorMessage() {
                $errorMessage = "Error on line" . $this->errorMessage() . "in" . $this->getFile() . "<b>" . $this->getMessage() . "<b>";
                return $errorMessage;
            }

        }

        try {
            $email = "cammyy@ga,mil.....com";
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                throw new Exception($email);
            }
        } catch (customException $e) {
            echo $e->errorMessage();
        }
        ?>
    </body>
</html>
