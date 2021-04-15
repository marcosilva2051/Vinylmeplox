<?php
    $title = "Seja Benvindo ao VinylMePlox";
 include('templates/header.php') ?>
    <div class="d-flex justify-content-center mt-5"> 
        <form method="POST" class="form-group w-50" action="actions.php?act=login">
            <h2> Log In </h2>
            <label for="nome">Username:</label><br>
            <input type="text"class="form-control "  id="username" name="username"autocomplete="off"><br>
            <label for="password">Password:</label><br>
            <input type="password"class="form-control " autocomplete="off"  id="password" name ="password">        
            <input class="btn btn-primary d-block mt-1" autocomplete="off" type="submit" value="Login">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-info mt-5" style="margin: 0 auto;"><a class="text-decoration-none text-light" href="paginas/novoUtilizador.php">Registar utilizador</a></button>
            </div>
        </form>
    </div>
    <?php 
    if(isset($_GET['msg'])){
            if($_GET['msg']=="loginErro"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Utilizador e password não coincidem
            </div>
        <?php 
            }
        }
        ?>
