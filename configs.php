<?php
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'vinylmeplox';

$conn = new mysqli($server, $username, $password, $db);

if($conn->connect_error)
    die ('Erro na base de dados: '.$conn->connect_error);
?>