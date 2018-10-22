<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>


        th{
            color: white;
        }
        td{
            color: white;
        }
        .tables{
            width: ;
        }
    </style>
</head>
<body>
<!--ADMIN CARAIO-->
<!---->
<!--uma tabela com os generos pré definidos e uma forma de serem adicionados novos generos-->
<!--uma tabela com todos os livros para serem editados / excluidos-->
<!--uma tabela com todas as sinopses para serem editados / excluidos-->
<!--uma tabela com todos os usuarios para serem editados (admin =2 ou não =1)-->
<br><br>
<div class="tables">
 <div id="divusuarios">
    <table class="table table-bordered" >
        <tbody>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Senha</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Sexo</th>
            <th>Tipo Usuario</th>
        </tr>
        </tbody>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <th><?= $usuario->us_id?> </th>
                <td><?= $usuario->us_nome ?> </td>
                <td><?= $usuario->us_senha ?> </td>
                <td><?= $usuario->us_email?> </td>
                <td><?= $usuario->us_datanascimento ?> </td>
                <td><?= $usuario->us_sexo ?> </td>
                <td><?= $usuario->tip_usuario ?> </td>
                <td>
                    <a href="ControlerAdmin.php?acao=editar&iduser=<?=$usuario->us_id?>">Editar</a> |
                    <a href="ControlerAdmin.php?acao=excluir&iduser=<?=$usuario->us_id?>">Remover</a>
                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>
    </table>
 </div>
<hr>
 <div id="divgeneros">
    <table class="table table-bordered" >
        <tbody>
        <tr>
            <th>Id</th>
            <th>Descrição</th>
        </tr>
        </tbody>
        <tbody>
        <?php foreach ($generos as $genero): ?>
            <tr>
                <th><?= $genero->ge_id?> </th>
                <th><?= $genero->ge_descricao?> </th>

                <td>
                    <a href="ControlerAdmin.php?acao=editarGenero&iduser=<?=$usuario->us_id?>&idGenero=<?=$genero->ge_id?>">Editar</a> |
                    <a href="ControlerAdmin.php?acao=excluirGenero&idGenero=<?=$genero->ge_id?>">Remover</a>
                </td>
            </tr>


        <?php endforeach; ?>
        <tr>
           <td>
                <a href="ControlerAdmin.php?acao=addGenero&iduser=<?=$usuario->us_id?>">Adicionar novo Genero</a> |
            </td>
        </tr>
        </tbody>
    </table>
 </div>
</div>



</body>
</html>