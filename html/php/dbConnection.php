<?php
     
     $host="localhost";
     $db="countrydb";
     $username="root";
     $pass="";
     $conn= mysqli_connect(
         hostname:$host,
         username:$username,
         password:$pass,
         database:$db
         );

         ini_set('display_errors', '0');
         // check connection
         if (!$conn) {
             die("Connection failed: " . mysqli_connect_error());
         }
   ?>
