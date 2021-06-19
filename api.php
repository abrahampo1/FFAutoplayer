<?php
$servername = "localhost";
$database = "logcalculator";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET["off"])){
    $sql = "UPDATE `ajustes` SET `value` = '1' WHERE `ajustes`.`id` = 1;";
    mysqli_query($link, $sql);
}
if(isset($_GET["on"])){
    $sql = "UPDATE `ajustes` SET `value` = '0' WHERE `ajustes`.`id` = 1";
    mysqli_query($link, $sql);
}
if(isset($_GET["data"])){
    $sql = "SELECT * FROM ajustes WHERE nombre = 'apagar'";
    $do = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($do);
    echo $result["value"];
}