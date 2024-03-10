<?php
    $sqlConn = mysqli_connect("localhost","root","","ias_midterm");

    if(!$sqlConn) {
        die("Connection error!". mysqli_connect_error());
    }
?>