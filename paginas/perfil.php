<?php
    $title = "Perfil";
    $id = $_SESSION['ID'];
    $sql= "SELECT * FROM users where ID= '$id'";
    $resultados = $conn->query($sql);
    $user=$resultados->fetch_assoc();
 ?>
    <div class ="dadosh">
        <button class="btn btn-info" id="editar"> Editar </button>
    </div>
    <div class="containerI">
        <div class="d-flex justify-content-center  w-100"> 
            <form method="POST" class="formRegisto form-group" action="../actions.php?act=editarUtilizador" enctype="multipart/form-data" >
                <label for="nome">Nome:</label><br>
                <input type="text"class="form-control " autocomplete="off"  id="nome" name="nome" value ="<?=$user['nome']?>" readonly><br>
                <label for="nome">Email:</label><br>
                <input type="email"class="form-control " autocomplete="off"  id="email" name="email" value ="<?=$user['email']?>"readonly>
                <span class="emailExiste text-danger"></span><br>
                <label for="username">Username:</label><br>
                <input type="text"class="form-control " autocomplete="off" id="username" name="username" value ="<?=$user['username']?>"readonly>
                <span class="usernameExiste text-danger"></span><br>   
                <label for="foto">Foto: <img height="150" src="../uploads/<?=$user['foto']?>"></label><br>
                <input type="file" class="form-control " autocomplete="off"  id="foto" name="foto" readonly>    
                <input class="btn btn-primary d-block mt-2" type="submit" value="Registar" disabled>
            </form>
        </div>
    </div>
    <span class="alertMsg"></span>
    <?php 
    if(isset($_GET['msg'])){
            if($_GET['msg']=="errFoto"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Erro ao inserir a foto
            </div>
        <?php 
            }
        ?>
        <?php 
            if($_GET['msg']=="errEmail"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Email já se encontra registado
            </div>
        <?php 
            }
        ?>
        <?php 
            if($_GET['msg']=="errUser"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Username já se encontra registado
            </div>
        <?php 
            }
        ?>

        <?php 
            if($_GET['msg']=="insSucesso"){                   
        ?>
            <div class="alert alert-success" role="alert">
            Utilizador atualizado
            </div>
        <?php 
            }
        ?>
        <?php 
            if($_GET['msg']=="insErro"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Erro ao atualizar Utilizador
            </div>
        <?php 
            }
        }
        ?>
</body>
</html>