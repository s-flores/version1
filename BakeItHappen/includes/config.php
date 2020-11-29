<?php
    ob_start();
    session_start();
    

    $timezone = date_default_timezone_set("America/Los_Angeles");

    $con = mysqli_connect("localhost", "root", "", "BakeItHappen");

    if(mysqli_connect_errno()){
        echo "failed to connect: " . mysqli_connect_error();
    }


