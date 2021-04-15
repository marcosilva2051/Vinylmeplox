<?php

include '../configs.php';
if(!isset($_GET['ID'])){
    header('Location:../main.php');
    exit;
}
$id = addslashes($_GET['ID']);
$sql = "SELECT * from users where ID = '$id'";
$resultados = $conn->query($sql);

if($resultados->num_rows ==0)
{
    header('Location:main.php');
    exit;
}
else
{
    $user = $resultados->fetch_assoc();
}

$userid= $user["ID"];

$sql="SELECT * FROM users_bandas where id_user ='$userid'";
$resultados = $conn->query($sql);

$arr_bandas = [];

while($row = $resultados->fetch_assoc()){
    $idb=$row['id_banda'];
    $sql="SELECT * FROM banda where ID='$idb'";
    $resultados3 = $conn->query($sql);
    $row2=$resultados3->fetch_assoc();
    array_push($arr_bandas,$row2);
}
$sql2= "SELECT * FROM mensagens where destinatario ='$userid'";
$resultado2 = $conn->query($sql2);

?>

<section id="intro">
    <article class="d-flex" style="height: 200px;"><div class ="ifoto" style="background: url('../uploads/<?= $user['foto']?>');"></div></article>
    <article class ="iname"><?= $user['nome'] ?></article>
    <article id = "artistas">
        <h3> Bandas </h3>
    <ul>
        <?php foreach ($arr_bandas as $value) {?>
        <li><a href="main.php?act=mural&bandaid=<?=$value['ID'] ?>"><?php echo $value['nome'] ?></a></li>
        <?php
            }
        ?>
    </ul>
    </article>
</section>

</div>