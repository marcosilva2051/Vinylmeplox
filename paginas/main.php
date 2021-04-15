<?php
$title = "Home";

include '../templates/header.php';
if(@$_SESSION['login'] !== true){
    header('Location:../index.php');
    exit;  
}
if(@$_GET['act'] == ""){
    header('Location:main.php?act=feed');
    exit;  
}

?>

<div class="container" style="height:initial;width:100%;">

    <nav class="navbar navbar-expand-xl navbar-light " style="width:100%; background-color:white;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="logo pull-left" href="#"><img src="../assets/imgs/vinylmeplox.jpg" height="70" style="margin-top: 20px;"></a>
    <div class="collapse navbar-collapse"  id="navbarText">
        <ul class="nav navbar-nav navbar-right" style="margin-left:auto;" >
        <li class="nav-item">
            <a class="nav-link text-dark" href="main.php?act=feed">Feed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="main.php?act=perfil">Perfil de Utilizador</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="main.php?act=criar">Criar Banda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="main.php?act=gerir">Gerir Banda</a>
        </li>
        </ul>
        <?php if(@$_SESSION['login']== true){ ?>
    <div class ="hbutton">
        <button type="button" class="btn btn-danger mt-2"><a class="text-decoration-none text-light" href="logout.php">Log Out</a></button>
    </div>
    <?php } ?>
    </div>
    </nav>
</div>

<div class="container">
    <section class ="s2">
        <div class="header_temp">
            <?php if(@$_GET['act']=='criar'){?>
                <h3>Criar Banda</h3>
            <?php }?>
            <?php if(@$_GET['act']=='gerir'){?>
                <h3>Gerir bandas</h3>
            <?php }?>
            <?php if(@$_GET['act']=='mural'){?>
                <h3>Mural da banda</h3>
            <?php }?>
            <?php if(@$_GET['act']=='editbanda'){?>
                <h3>Editar banda</h3>
            <?php }?>
            <?php if(@$_GET['act']=='perfil'){?>
                <h3>Perfil do Utilizador</h3>
            <?php }?>
            <?php if(@$_GET['act']=='feed'){?>
                <h3>Bandas na plataforma</h3>
            <?php }?>

        </div>
        <div class="content">
            <?php if(@$_GET['act']=='criar')
            include 'novaBanda.php';
            ?>
            <?php if(@$_GET['act']=='gerir')
            include 'gerirBanda.php';
            ?>
            <?php if(@$_GET['act']=='mural')
            include 'moralBanda.php';
            ?>
            <?php if(@$_GET['act']=='editbanda')
            include 'editBanda.php';
            ?>
            <?php if(@$_GET['act']=='perfil')
            include 'perfil.php';
            ?>
            <?php if(@$_GET['act']=='feed')
            include 'feed.php';
            ?>
            <?php if(@$_GET['act']=='userprofile')
            include 'user_profile.php';
            ?>
            <?php 
        if(isset($_GET['msg'])){
                if($_GET['msg']=="errUsername"){                   
            ?>
        <div class="alert alert-danger" role="alert">
                Username já existe
        </div>

        <?php 
                }
                if($_GET['msg']=="upSucc"){                   
                    ?>
                <div class="alert alert-success" role="alert">
                        Banda atualizada 
                </div>
                <?php 
            }
        }
        ?>
        </div>
    </section>
    
</div>

