<?php
include 'configs.php';
session_start();

$act = $_GET['act'];

 if($act == 'login'){
    $user = addslashes(htmlspecialchars($_POST['username']));
    $pass = md5(sha1(addslashes($_POST['password'])));
    $sql = "SELECT * FROM users";
    $resultados = $conn->query($sql);
    
    while($linha = $resultados->fetch_assoc())
    {
        if($user == $linha['username'] && $pass == $linha['password']){
            session_start();
            $_SESSION['login']= true;
            $_SESSION['username']= $_POST['username'];
            $_SESSION['password']= $_POST['password'];
            $_SESSION['admin']= $linha['admin'];
            $_SESSION['ID']= $linha['ID'];
            header('Location: paginas/main.php?act=feed');
            exit;
        }else{
            header('Location:index.php?msg=loginErro');
        }
    }
    
}
else if($act == 'novoUtilizador'){
    $nome = addslashes(htmlspecialchars($_POST['nome']));
    $user = addslashes(htmlspecialchars($_POST['username']));
    $pass = md5(sha1(addslashes($_POST['password'])));
    $email = addslashes(htmlspecialchars($_POST['email']));
    $foto = 'default.png';
    
    $sql = "INSERT INTO users (nome, username, password ,email,foto) VALUES ('$nome', '$user', '$pass','$email','$foto')";
    if($conn->query($sql) === true)
        header('Location: paginas/novoUtilizador.php?msg=insSucesso');
    else
        header('Location: paginas/novoUtilizador.php?msg=insErro');

}
else if($act == 'novaBanda'){
    $nome = addslashes(htmlspecialchars($_POST['nome']));
    $genero = addslashes(htmlspecialchars($_POST['genero']));
    $filename = $_FILES['foto']['name'];
    if($filename == ""){
        $filename = "default.png";
    }else{
        $target_dir = 'uploads/';
        $target_file = $target_dir.basename( $_FILES['foto']['name'] );
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType == 'webp' || $imageFileType == 'jpg' || $imageFileType == 'jpeg' || $imageFileType == 'png' )
        {
            move_uploaded_file($_FILES['foto']['tmp_name'],$target_file);
        }else{
            header('Location: paginas/main.php?act=perfil&msg=errFoto');
            exit;
        }
    }
        
        $sql = "SELECT COUNT(*) AS total FROM banda where nome = '$nome'";
        $resultados = $conn->query($sql);
        $linha = $resultados->fetch_assoc();
        if($linha['total']==0)
            {
                $sql = "INSERT INTO banda (nome, genero, foto) VALUES ('$nome', '$genero','$filename')";
                if($conn->query($sql) === true)
                {
                    $sql = "SELECT ID from banda where nome = '$nome'";
                    $resultados = $conn->query($sql);
                    $linha = $resultados->fetch_assoc();
                    $userid = $_SESSION['ID'];
                    $bandaid = $linha['ID'];
                    $sql = "INSERT INTO users_bandas (id_user, id_banda) VALUES ('$userid', '$bandaid')";
                    $conn->query($sql);
                    header('Location: paginas/main.php?act=criar&msg=insSucesso');
                }
                else
                    header('Location: paginas/main.php?act=criar&msg=Erro');
            }else{
                header('Location: paginas/main.php?act=criar&msg=insErro');
            }
        $sql = "SELECT COUNT(*) AS total FROM banda where nome = '$nome'";
        
}
else if($act == 'existeEmail'){ //verifica se o email já existe no sistema
    $email = addslashes(htmlspecialchars($_POST['emailUser']));
    $sql_u = "SELECT COUNT(*) AS total FROM users where email = '$email'";
    $resultados = $conn->query($sql_u);
    $linha_u = $resultados->fetch_assoc();

    if($linha_u['total']==0)
    {
        $resposta = array(
            'msg' => false
        );
        echo json_encode($resposta);
    }

    else{
        $resposta = array(
            'msg' => true
        );
        echo json_encode($resposta);
    }
}

else if($act == 'existeUsername'){ //  verfica se o username do utilizador existe
    $value = addslashes(htmlspecialchars($_POST['username']));
    $sql_u = "SELECT COUNT(*) AS total FROM users where username = '$value'";
    $resultados = $conn->query($sql_u);
    $linha_u = $resultados->fetch_assoc();

    if($linha_u['total']==0)
    {
        $resposta = array(
            'msg' => false
        );
        echo json_encode($resposta);
    }

    else{
        $resposta = array(
            'msg' => true
        );
        echo json_encode($resposta);
    }
}
else if($act == 'existeBanda'){ //  verfica se o banda do utilizador existe
    $value = addslashes(htmlspecialchars($_POST['nome']));
    $sql_u = "SELECT COUNT(*) AS total FROM banda where nome = '$value'";
    $resultados = $conn->query($sql_u);
    $linha_u = $resultados->fetch_assoc();

    if($linha_u['total']==0)
    {
        $resposta = array(
            'msg' => false
        );
        echo json_encode($resposta);
    }

    else{
        $resposta = array(
            'msg' => true
        );
        echo json_encode($resposta);
    }
}

else if($act == 'editBanda'){ // editar banda
    $id = addslashes(htmlspecialchars($_POST['ID']));
    $nome = addslashes(htmlspecialchars($_POST['nome']));
    $genero = addslashes(htmlspecialchars($_POST['genero']));

    $filename = $_FILES['foto']['name'];

    if($filename == "")
    {
        if(verify_name($nome,$id,$conn) == true){
            $sql = "UPDATE banda set nome='$nome',genero='$genero' WHERE ID ='$id'";
            $resultados = $conn->query($sql);
            header('Location: paginas/main.php?act=gerir&msg=upSucc');
        }else{
            header('Location: paginas/main.php?act=gerir&msg=errUsername');
        }
    }else{
        $target_dir = 'uploads/';

        $target_file = $target_dir.basename( $_FILES['foto']['name'] );
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType == 'webp' || $imageFileType == 'jpg' || $imageFileType == 'jpeg' || $imageFileType == 'png' )
        {
            move_uploaded_file($_FILES['foto']['tmp_name'],$target_file);
        }else{
            die("Ficheiro não permitido");
        }
        if(verify_name($nome,$id,$conn) == true){
            $sql = "UPDATE banda set nome='$nome',genero='$genero',foto='$filename' WHERE ID ='$id'";
            $resultados = $conn->query($sql);
            header('Location: paginas/main.php?act=gerir&msg=upSucc');
        }else{
            header('Location: paginas/main.php?act=gerir&msg=errUsername');
        }
    }
    

}

else if($act == 'deleteBanda'){ // apaga banda
    $id = addslashes(htmlspecialchars($_GET['ID']));
    $sql = "DELETE from banda where ID='$id'";
    $resultados = $conn->query($sql);

    if($resultados == true)
        header('Location: paginas/main.php?act=gerir');


}

else if($act == 'existeEmail2'){ //verifica se o email já existe no sistema
    $email = addslashes(htmlspecialchars($_POST['emailUser']));
    $id = addslashes(htmlspecialchars($_SESSION['ID']));
    $sql_u = "SELECT COUNT(*) AS total FROM users where email = '$email' AND ID <>'$id'";
    $resultados = $conn->query($sql_u);
    $linha_u = $resultados->fetch_assoc();

    if($linha_u['total']==0)
    {
        $resposta = array(
            'msg' => false
        );
        echo json_encode($resposta);
    }

    else{
        $resposta = array(
            'msg' => true
        );
        echo json_encode($resposta);
    }
}

else if($act == 'existeUsername'){ //verifica se o username já existe no sistema
    $username = addslashes(htmlspecialchars($_POST['username']));
    $id = addslashes(htmlspecialchars($_SESSION['ID']));
    $sql_u = "SELECT COUNT(*) AS total FROM users where username = '$username' AND ID <>'$id'";
    $resultados = $conn->query($sql_u);
    $linha_u = $resultados->fetch_assoc();

    if($linha_u['total']==0)
    {
        $resposta = array(
            'numero' => 2,
            'msg' => false,
            'total' => $linha_u['total']
        );
        echo json_encode($resposta);
    }

    else{
        $resposta = array(
            'numero' => 2,
            'msg' => true,
            'total' => $linha_u['total']
        );
        echo json_encode($resposta);
    }
}
else if($act == 'editarUtilizador'){ //verifica se o username já existe no sistema
    $username =  addslashes(htmlspecialchars($_POST['username']));
    $nome = addslashes(htmlspecialchars($_POST['nome']));
    $email = addslashes(htmlspecialchars($_POST['email']));
    $id = $_SESSION['ID'];
    $filename = $_FILES['foto']['name'];
    if($filename != "")
    {
        $target_dir = 'uploads/';
        $target_file = $target_dir.basename( $_FILES['foto']['name'] );
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType == 'webp' || $imageFileType == 'jpg' || $imageFileType == 'jpeg' || $imageFileType == 'png' )
        {
            move_uploaded_file($_FILES['foto']['tmp_name'],$target_file);
        }else{
            header('Location: paginas/main.php?act=perfil&msg=errFoto');
            exit;
        }
        $sql_u = "UPDATE users set username ='$username', nome = '$nome', email = '$email',foto='$filename' where ID='$id'";
        $resultados = $conn->query($sql_u);
    }else{
        $sql_u = "UPDATE users set username ='$username', nome = '$nome', email = '$email' where ID='$id'";
        $resultados = $conn->query($sql_u);
    }

    if($resultados)
        header('Location: paginas/main.php?act=perfil&msg=insSucesso');
    else
        header('Location: paginas/main.php?act=perfil&msg=insErro');
    
    exit;
}
else if($act == 'enviaMensagem'){ // envia mensage
    $msg = addslashes(htmlspecialchars($_POST['msg']));
    $idbanda = addslashes(htmlspecialchars($_POST['idbanda']));
    $id_user = addslashes(htmlspecialchars($_SESSION['ID']));

    $sql = "INSERT INTO mensagens(remetente,destinatario,conteudo) VALUES ('$id_user','$idbanda','$msg')";
    $resultados = $conn->query($sql);

    if($resultados)
    {
        echo "S";
    }else{
        echo "E";
    }

}


function verify_name($name,$id,$lig){ // verifica se o nome da banda já existe
    $name = addslashes($name);
    $sql = "SELECT * FROM banda where nome ='$name' and ID <> '$id'";
    $resultados = $lig->query($sql);
    $aux = false;
    if($resultados->num_rows == 0)
        $aux = true;
    
    return $aux;
}
?>