<?php
   try{
      //host
      $host = "localhost";

      //dbname
      $dbname = "cleanblog";

      //user
      $user = "root";
      // root2 or root33 the output is: SQLSTATE[HY000] [1045] Access denied for user 'root33'@'localhost' (using password: NO)
      //URL: http://localhost/clean-blog/config/config.php

      //pass (password)
      $pass = "";

      $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // added in code from: *php error and error handling mannual*

   } catch(PDOException $e) {
      echo $e->getMessage();
   }


   //<?php
   //host:- $host = "localhost";

   // dbname:- $dbname = "cleanblog";

   // user:- $user = "root";

   // pass:- $pass = "";

   // $conn = new PDO("mysql:host=$host;dbmame=$dbname", $user, $pass);

   // if($conn = true) {
   //  echo "conn works fine";
   // } else {
   //  echo "conn error";
   // }
      //output:
      // if this code is run directly using URL: http://localhost/clean-blog/config/config.php, then output is:conn works fine
      // URL for XAMPP Apache + MariaDB + PHP + Perl : http://localhost/dashboard/
      // URL for CleanBlog : http://localhost/clean-blog/auth/login.php