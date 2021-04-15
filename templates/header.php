<?php
    if(getcwd()=="C:\\xampp\htdocs\Projeto_Final")
        include 'configs.php';
    else
        include '../configs.php';
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
if(getcwd()=="C:\\xampp\htdocs\Projeto_Final"){
?>
    <link rel="stylesheet" href="assets/styles.css">
<?php }else{ ?>
    <link rel="stylesheet" href="../assets/styles.css">
<?php }?>
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title><?=$title?></title>
    <?php
    if($title == "Novo Utilizador")
    {
     ?>
    <script src = "../assets/userCheck.js"></script>
    <?php
    }
    ?>
    <?php
    if($title == "Home")
    {
     ?>
    <script src = "../assets/script.js"></script>
    <?php
    }
    ?>
</head>
<body>
<?php
if (basename($_SERVER['PHP_SELF'])!="main.php"){
     ?>
<header class="container" style="height: initial !important;">
<?php
    if($title == "Seja Benvindo ao VinylMePlox")
    {
     ?>
    <article class ="himg"><img src ="assets/imgs/vinylmeplox.jpg"></img></article>
    <?php }else{ ?>
        <article class ="himg"><img src ="../assets/imgs/vinylmeplox.jpg"></img></article>
    <?php }?>
    <?php }?>
</header>


