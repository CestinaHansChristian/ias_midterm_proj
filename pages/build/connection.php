<?php
    $sqlConn = mysqli_connect("localhost","root","","ias_midterm",4306);

    if(!$sqlConn) {
        die("Connection error!". mysqli_connect_error());
    }
?>