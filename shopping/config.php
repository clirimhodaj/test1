<?php
  $conn=new mysqli("localhost","root","admin","shopping");
  if($conn->connect_error){
    die("Connection Failed!".$conn->connect_error);
  }

 ?>
