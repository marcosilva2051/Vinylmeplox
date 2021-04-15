<?php 
$userid = $_SESSION['ID'];
$sql = "SELECT * from users_bandas where id_user = '$userid'";
$resultados = $conn->query($sql);
?>
<table class="table">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Género</th>
            <th scope="col">Foto</th>
            <th scope="col">Editar/Apagar</th>
        </tr>
        <?php
            while($linha = $resultados->fetch_assoc()){
                $sql = "SELECT * FROM banda where ID =".$linha['id_banda'];
                $res = $conn->query($sql);
                $linha2 = $res->fetch_assoc();
        ?>
        <tr>
            <td><a href="main.php?act=mural&bandaid=<?=$linha2['ID']?>"><?php echo $linha2['nome'] ?></a></td>
            <td><?php echo $linha2['genero'] ?></td>
            <td><img src ="../uploads/<?=$linha2['foto'] ?>" height="50"></img></td>
            <td>
                <a href="main.php?act=editbanda&bandaid=<?= $linha2['ID'] ?>" id="tr">
                    <img src="../assets/imgs/edit.png" alt="Editar" height="20">
                </a>    
                <a href="../actions.php?act=deleteBanda&ID=<?php echo $linha2['ID'] ?>">
                    <img class="del" src="../assets/imgs/delete.png" alt="Eliminar" height="20">
                </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    
