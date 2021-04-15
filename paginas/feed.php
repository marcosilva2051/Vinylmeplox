<?php 
$sql = "SELECT * FROM banda";
$resultados = $conn->query($sql);
?>
<div class="containerF">
    <ul class="feedL">
    <?php while($linha = $resultados->fetch_assoc()){ ?>
        <li>
            <a href ="main.php?act=mural&bandaid=<?= $linha['ID'] ?>">
                <div class="feedImg" style="background: url('../uploads/<?= $linha['foto']?>');"></div>
                <div class="txt"><?= $linha['nome'] ?> </div>
            </a>
        </li>
    <?php } ?>
    </ul>
</div>

