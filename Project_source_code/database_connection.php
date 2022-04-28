<?php

    //set up connection
    $server = "localhost";
    $user = "root";
    $pw = "";
    $db = "finalproject";

    //create connection
    $connect = mysqli_connect($server,$user,$pw,$db);

    if(!$connect)
    {
        die("Connection failed: " .mysqli_connect_error());
    }
?>