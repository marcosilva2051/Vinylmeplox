<?php

include '../configs.php';
if(!isset($_GET['bandaid'])){
    header('Location:../main.php');
    exit;
}
$banda_id = addslashes($_GET['bandaid']);
$sql = "SELECT * from banda where ID = '$banda_id'";
$resultados = $conn->query($sql);

if($resultados->num_rows ==0)
{
    header('Location:main.php');
    exit;
}
else
{
    $banda = $resultados->fetch_assoc();
}

$idb= $banda["ID"];

$sql="SELECT * FROM users_bandas where id_banda ='$idb'";
$resultados = $conn->query($sql);

$arr_users = [];

while($row = $resultados->fetch_assoc()){
    $idu=$row['id_user'];
    $sql="SELECT * FROM users where ID='$idu'";
    $resultados = $conn->query($sql);
    $row=$resultados->fetch_assoc();
    array_push($arr_users,$row);
}
$sql2= "SELECT * FROM mensagens where destinatario ='$idb'";
$resultado2 = $conn->query($sql2);

?>

<section id="intro">
    <article class="d-flex" style="height: 200px;"><div class ="ifoto" style="background: url('../uploads/<?= $banda['foto']?>');"></div></article>
    <article class ="iname"><?= $banda['nome'] ?></article>
    <article id = "artistas">
        <h3> Artistas </h3>
    <ul>
        <?php foreach ($arr_users as $value) {?>
        <li><a href="main.php?act=userprofile&&ID=<?=$value['ID']?>"><?php echo $value['nome'] ?></a></li>
        <?php
            }
        ?>
    </ul>
    </article>
</section>

<section id="msgBox">
    <h3> Comentários</h3>
    <div class="detailBox">
        <div class="actionBox">
            <ul class="commentList">
                <?php while($row = $resultado2->fetch_assoc()){
                    $id = $row['remetente'];
                    $sql3 = "SELECT * FROM users where ID = '$id'";
                    $res = $conn->query($sql3);
                    $user = $res->fetch_assoc();
                    ?>
                <li>
                    <div class="commenterImage" style="background: url('../uploads/<?= $user['foto']?>');">
                    </div>
                    <div class="commentText">
                        <p style="font-family: Helvetica_Bold;"><span class="date sub-text">[<?=$row['reg_data']?>]</span> <a href ="main.php?act=userprofile&&ID=<?=$user['ID']?>"> <?= $user['username'] ?></a> says : </p>
                        <p class="">"<?=$row['conteudo']?>"</p>

                    </div>
                </li>
                <?php }?>
            </ul>
            <div class="d-flex">
                <div style="display:none"><input type="text" id ="idbanda" value="<?= $idb ?>" placeholder="Escrever comentário" />
</div>
                <div class="form-group w-75">
                    <input class="form-control w-100 msg" type="text" placeholder="Escrever comentário" />
                </div>
                <div class="form-group">
                    <button class="btn btn-info" id="sendComment" disabled>Enviar</button>
                </div>
            </div>
        </div>
    </div>
</section>
</div>