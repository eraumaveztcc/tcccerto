<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="menu" id="menu">
    <div>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a id="texto-ini" class="inicial-li" href="ControlerUsuario.php">Página Inicial</a>
                </li>
                <li>
                    <a id="texto-ini" href="?acao=biblioteca&tipuser=<?= $tipuser ?>">Biblioteca</a>
                </li>
                <li>
                    <a id="texto-ini" href="#">Criar sinopse</a>
                </li>

                <li>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            if (!isset($_SESSION['us_id'])){
                                echo "Visitante";
                            }else{
                                $id = $_SESSION['us_id'];
                                $crud = new UsuarioCrud();
                                $user = $crud->getUsuarioId($id);
                                $nome = $user->getUsNome();
                                echo $nome;
                            } ?>
                            <span class="glyphicon glyphicon-user" aria-hidden="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Formulário</a></li>
                            <?php

                            if ($tipuser == 2){
                                echo "<li><a href='ControlerAdmin.php'>Área do Admin</a></li>";
                            }else{
                                echo "";
                            }
                            ?>
                            <li><a href="?acao=login">Entrar</a></li>
                            <li><a href="?acao=cadastrar">Cadastrar</a></li>
                            <li><a href="?acao=logout">Sair</a></li>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</div>