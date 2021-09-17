<?php
session_start();

if(isset($_GET["view"])){
    require_once "pweb/telas/" . $_GET["view"] .".php";
} else if (isset($_GET["action"]) && isset($_GET["class"])){
    $verificador = "verificador".$_GET["class"];
    $action = $_GET["action"];
    require_once "pweb/verificacao" . $verificador . ".php";
    $verificador = new $verificador();
    $verificador->$action();
} else if(isset($_SESSION["loggedUser"])){
    require_once "pweb/telas/principal.php";
} else{
    require_once "pweb/telas/login.php";
}