<?php 
$x = verify_id($conn);
if($x !=-1){
    $aux = addslashes($x);
    $sql2="SELECT * FROM banda where ID='$aux'";
    $resultados = $conn->query($sql2);
    $banda = $resultados->fetch_assoc();
}else{
    header('Location:main.php');
    exit;
}
function verify_id($lig){
    $aux=-1;
    $id = $_SESSION['ID'];
    $sql = "SELECT id_banda from users_bandas where id_user='$id'";
    $resultados = $lig->query($sql);
    if($resultados->num_rows > 0)
    {
        while($banda = $resultados->fetch_assoc()){
            if($banda['id_banda']==$_GET['bandaid'])
                $aux=$_GET['bandaid'];
        }
    }else{
        header('Location:main.php');
        exit;
    }
    return $aux;
}
?>

<div class="d-flex justify-content-center mt-5"> 
        <form method="POST" class="formRegisto form-group w-50" action="../actions.php?act=editBanda" enctype="multipart/form-data">
            <h2> Editar Banda </h2>
            <label for="nome">ID</label><br>
            <input type="text"class="form-control " autocomplete="off"  id="IDeb" name="ID" value ="<?= $banda['ID'] ?>" readonly><br>
            <label for="nome">Nome:</label><br>
            <input type="text"class="form-control nomeBanda " autocomplete="off"  id="nomeeb" name="nome" value ="<?= $banda['nome'] ?>">
            <span class="bandaExiste text-danger"></span><br>
            <select class="form-control"  id="genero" name="genero" value ="<?= $banda['genero'] ?>">
                <option value = "Rock" <?php if($banda['genero'] == "Rock")
                echo "selected"; ?>>Rock</option>
                <option value="Electronica" <?php if($banda['genero'] == "Electronica")
                echo "selected"; ?>>Electronica</option>
                <option value="Jazz" <?php if($banda['genero'] == "Jazz")
                echo "selected"; ?>>Jazz</option>
                <option value="Hip Hop" <?php if($banda['genero'] == "Hip Hop")
                echo "selected"; ?>>Hip Hop</option>
                <option value="Indie" <?php if($banda['genero'] == "Indie")
                echo "selected"; ?>>Indie</option>
             </select>
            <label for="foto">Foto:</label><br>
            <input type="file" class="form-control " autocomplete="off"  id="foto" name="foto">
            <input class="btn btn-primary d-block mt-2" type="submit" value="Registar" disabled>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-info mt-5" style="margin: 0 auto;"><a href="main.php?act=gerir" class="text-decoration-none text-light">Voltar à página inicial</a></button>
            </div>
        </form>
    </div>