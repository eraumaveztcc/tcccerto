<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<div class="ui center aligned page grid">
<div class="ui eight wide column left aligned form segment grid" style ="margin-top: 15%; margin-bottom: 13%">
    <form class="ui form" method="post" action="?acao=editar&iduser=<?=$usuario->us_id?>">
        <h2 class="ui dividing header"> Editar </h2>
        <div class="field">
            <input  value="<?= $usuario->us_nome ?>" type="text" name="nome" required>
            <span><i class="fa fa-user"  aria-hidden="true" ></i></span>
        </div>
        <div class="field">
            <input value="<?= $usuario->us_email ?>" type="email" name="email" required >
            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
        </div>
        <div class="field">
            <input value="<?= $usuario->us_senha ?>" type="password" name="senha" placeholder="Digite sua senha">
            <span><i class="fa fa-lock"  aria-hidden="true" ></i></span>
        </div>
        <div class="field">
            <input value="<?= $usuario->us_senha ?>" type="password" name="senha1" placeholder="Confirmar senha">
            <span><i class="fa fa-check-circle" aria-hidden="true"></i></span>
        </div>
        <!-- HIDDEN INPUT PARA DAR O VALOR DE USUARIO = 1 -->
        <input type="submit" name="gravar" value="Editar">
    </form>
</div>
</div>

