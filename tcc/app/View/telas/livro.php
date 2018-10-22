<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$livro->li_titulo ?></title>
</head>
<body><br><br><br><br><br><br>
<div class="main ui container center align page">
<div class="ui segment">
<div class="inline field">
        <img href="ControlerLivro.php?acao=show" src="../../assets/img/livros/livro1.jpg" style="height:500px; width:300px">
</div>
    <div class="content">
        <div class="header"><?= $livro->li_titulo ?></div>
        <div class="meta">
            <div class="header"><?= $livro->li_autor ?></div>
        </div>
        <div class="header">
            Classificação:
            <div class="ui star rating" data-rating="0" data-max-rating="5"></div>
        </div>
    </div>
    <br>

    <p>Primeira sinópse</p>
    <?php
    $idlivro=$_GET['idlivro'];
    $crudLivros = new CrudLivros();
    $resenhas = $crudLivros->getResenhas($idlivro);

    //    foreach ($resenhas as $resenha): ?>


    <?php
        //idusuario1 é a id do usuario que fez a sinopse
        $idusuario1 = $resenhas->re_idusuario;
        //se existir id na url:
        if(isset($_GET['idusuario'])) {
            //se a id do usuario que fez a sinopse for igual a do usuario logado, mostra esditar/excluir
            if ($idusuario1 == $_GET['idusuario']) {
                $id = $_GET['idusuario'];
                echo "<p>$resenhas->re_textoresenha     </p> <a class=\"item\" href=\"?acao=editarSinopse&idresenha=$resenhas->re_id&idusuario=$id&idlivro=$idlivro\">Editar sinopse</a><br><a class=\"item\" href=\"?acao=excluirSinopse&idresenha=$resenhas->re_id\">Excluir sinopse</a>";
            }
            //se não só mostra a resenha mesmo
            else {
                echo "<p>$resenhas->re_textoresenha</p>";
            }
        }else{
            echo "<p>$resenhas->re_textoresenha</p>";
        }
        ?>

   <?php //endforeach ?>



    <?php
    $idlivro = $livro->li_idlivro;
    $crudGenero = new CrudGenero();
    $generos = $crudGenero->getGeneroLivro($idlivro);
    $iddogenero = $generos->getGlId();

    $generodoLivro =$crudGenero->getGenero($iddogenero);

    ?>
    <? foreach ($generos as $genero): ?>
        <a class="ui red label" style="margin-top: 6px"><?=$generodoLivro->ge_descricao?> </a>
    <? endforeach ?>

    <br>

    <?php
    //idusuario1 é a id do usuario que fez a resenha
    $idusuario1 = $resenhas->re_idusuario;
    if (isset($livro->li_idusuario)) {
        $idusuario2 = $livro->li_idusuario;
    }

    //se o di da url for igual o idusuario do livro, mostra o editar/excluir
    if (isset($idusuario2)) {
        if (isset($_GET['idusuario'])) {
            if ($_GET['idusuario'] == $idusuario2) {
                echo "<a class=\"item\">Editar livro</a><br><a class=\"item\" href='ControlerLivro.php?acao=excluirlivro&idlivro=$livro->li_idlivro'>Excluir livro</a>";
            }
        }
    }
    ?>
    <br>
<!--    se o usuario estiver logado, ele podera adicionar o livro a biblioteca e/ou adicionar uma nova sinopse ao mesmo-->
    <?php if (isset($_SESSION)){ $idusuario=$_SESSION['us_id']; echo "<a>Adicionar livro à biblioteca</a><br><a href='ControlerLivro.php?acao=add_sinopse&idusuario=$idusuario&idlivro=$livro->li_idlivro'>Adicionar Sinópse</a>";} ?>

    <br><br>

    <div class="ui comments">
        <h3 class="ui dividing header">Comentarios:</h3>
        <?php foreach ($comentarios as $comentario):
            $crud = new UsuarioCrud();
            $usuario = $crud->getUsuarioId($comentario->cm_idusuario);
//            print_r($usuario->us_nome);die;
        ?>

        <div class="comment">
            <a class="avatar">
                <img src="/images/avatar/small/matt.jpg">
            </a>
            <div class="content">
                <a class="author"><?=$usuario->us_nome?></a>
                <div class="metadata">
                    <span class="date"><?=$comentario->cm_data?></span>
                    <div class="rating">
                        <i class="star icon"></i><?=$comentario->cm_curtidas?>
                    </div>
                </div>
                <div class="text">
                    <?=$comentario->cm_texto?>
                </div>
                <div class="actions">
                    <a class="reply">Denunciar</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <form class="ui reply form" action="?acao=add_coment&idlivro=<?=$idlivro?>&idusuario=<?=$_GET['idusuario']?>" method="post">
            <div class="field">
                <input type="text" max="200" name="cm_texto" placeholder="Faça um comentario">
            </div>
            <input style="visibility: hidden" type="text" name="getidusuario" value="<?=$_GET['idusuario']?>">
            <input style="visibility: hidden" type="text" name="getidlivro" value="<?=$idlivro?>">

            <input type="submit" class="ui primary button icon" name="gravar" value="Comentar">

        </form>
    </div>

</div>
</div>
</body>
</html>
<script>
    $('.ui.rating')
        .rating();
</script>