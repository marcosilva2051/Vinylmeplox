<?php
    $title = "Novo Utilizador";
 include('../templates/header.php');
 ?>
    <div class="d-flex justify-content-center mt-5"> 
        <form method="POST" class="formRegisto form-group w-50" action="../actions.php?act=novoUtilizador" >
            <h2> Log In </h2>
            <label for="nome">Nome:</label><br>
            <input type="text"class="form-control " autocomplete="off"  id="nome" name="nome"><br>
            <label for="nome">Email:</label><br>
            <input type="email"class="form-control " autocomplete="off"  id="email" name="email">
            <span class="emailExiste text-danger"></span><br>
            <label for="username">Username:</label><br>
            <input type="text"class="form-control " autocomplete="off" id="username" name="username">
            <span class="usernameExiste text-danger"></span><br>
            <label for="password">Password:</label><br>
            <input type="password"class="form-control password " autocomplete="off"  id="password" name ="password"> 
            <label for="password2">Confirme a Password:</label><br>
            <input type="password"class="form-control password2 " autocomplete="off"  id="password2" name ="password2">
            <span class="passCheck text-danger"></span><br>        
            <input class="btn btn-primary d-block mt-2" type="submit" value="Registar">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-info mt-5 " style="margin: 0 auto;"><a href="../index.php" class="text-decoration-none text-light">Voltar à página inicial</a></button>
            </div>
        </form>
    </div>
    <span class="alertMsg"></span>
    <?php 
    if(isset($_GET['msg'])){
            if($_GET['msg']=="errPass"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Passwords não coincidem
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
            Utilizador registado
            </div>
        <?php 
            }
        ?>
        <?php 
            if($_GET['msg']=="insErro"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Erro ao inserir Utilizador
            </div>
        <?php 
            }
        }
        ?>
</body>
</html>