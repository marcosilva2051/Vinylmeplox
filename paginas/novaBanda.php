
    <div class="d-flex justify-content-center mt-5"> 
        <form method="POST" class="formRegisto form-group w-50" action="../actions.php?act=novaBanda" enctype="multipart/form-data" >
            <label for="nome">Nome:</label><br>
            <input type="text"class="form-control nomeBanda " autocomplete="off"  id="nome" name="nome">
            <span class="bandaExiste text-danger"></span><br>
            <label for="nome">Genero:</label><br>
            <select class="form-control"  id="genero" name="genero">
                <option value = "Rock">Rock</option>
                <option value="Electronica">Electronica</option>
                <option value="Jazz">Jazz</option>
                <option value="Hip Hop">Hip Hop</option>
                <option value="Indie">Indie</option>
             </select>
            <label for="foto">Foto:</label><br>
            <input type="file" class="form-control " autocomplete="off"  id="foto" name="foto">
            <div class="d-flex justify-content-center mt-3">
                <input class="btn btn-primary d-block" type="submit" value="Registar" disabled>
            </div>
        </form>
    </div>
    <span class="alertMsg"></span>
    <?php 
    if(isset($_GET['msg'])){ 
            if($_GET['msg']=="insSucesso"){                   
        ?>
            <div class="alert alert-success" role="alert">
            Banda registada
            </div>
        <?php 
            }
        ?>
        <?php 
            if($_GET['msg']=="insErro"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Banda já se encontra registada
            </div>
        <?php 
            }
        ?>
        <?php 
            if($_GET['msg']=="Erro"){                   
        ?>
            <div class="alert alert-danger" role="alert">
            Erro ao inserir banda
            </div>
        <?php 
            }
        }
        ?>
</body>
</html>