<?php

    require_once("database_settings.php");

    $driver = new mysqli_driver();
    $driver->report_mode = MYSQLI_REPORT_OFF;

    $connection = mysqli_connect($host_name,$username,$password,$database);

    if(mysqli_connect_errno()){
        echo "<p style='color:red' >Error No: ".mysqli_connect_errno()." </p>";
        echo "<p style='color:red' Error message: ".mysqli_connect_error()." ></p>";
    }


?>