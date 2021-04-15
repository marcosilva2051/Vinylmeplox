<?php
session_start();
if(@$_SESSION['login'] !== true){
    header('Location:../index.php');
    exit;
}
if(!isset($_SESSION["username"])) {
    header("location: ../index.php");
    die();
}  
session_destroy();
header("Location: ../index.php");
die();

?>