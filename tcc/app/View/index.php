<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Era uma Vez</title>
</head>
<link rel="stylesheet" href="../../assets/css/style.css">

<body>
<!--IF USUARIO REPONDEU O FORMULARIO SHOW:-->
<ul class="resultados">
</ul>

<section id="principal" >
    <h1 class="ui header ">Recomendado:</h1>
    <br><br>

    <div class="centered ui four cards">
        <?php foreach ($livros as $livro): ?>
            <div class="ui card" style="height:560px; width:305px">
                <?php

                if (isset($_GET['idusuario'])){
                    $_SESSION['us_id'] = $_GET['idusuario'];
                    $idusuario = $_SESSION['us_id'];
                }else{
                    if (isset($_SESSION['us_id'])){
                        $idusuario = $_SESSION['us_id'];
                    }
                }

                ?>
                <a class="image" href="ControlerLivro.php?acao=show<?php if (isset($_SESSION)){$id = $_SESSION['us_id'];echo "&idusuario=".$id;}?>&idlivro=<?= $livro->li_idlivro ?>" style="cursor: pointer">
                    <img href="ControlerLivro.php?acao=show" src="../../assets/img/livros/livro1.jpg">
                </a>
                <div class="content">
                    <div class="header"><?= $livro->li_titulo ?></div>
                    <?php

                    if (isset($_SESSION)){
                        $id = $_SESSION['us_id'];
                        echo "<span class=\"right floated\">
                <a id=\"target4\" class=\"ui icon button left floated lipr\" title=\"Adicionar nova prateleira\">
                        <i class=\"plus icon\" ></i></a></span>";
                    }
                    ?>
                    <div class="meta">
                        <a><?= $livro->li_autor ?></a>
                        <div class="description">
                            <?php
                            $idlivro = $livro->li_idlivro;
                            $crudGenero = new CrudGenero();
                            $generos = $crudGenero->getGeneroLivro($idlivro);
                            $iddogenero = $generos->getGlId();

                            $generodoLivro =$crudGenero->getGenero($iddogenero);
                            $aaaa = $generodoLivro->ge_descricao;
                            ?>

                            <a class="ui red label" style="margin-top: 6px"><?=$aaaa?></a>

                        </div>
                        <?php

                        if (isset($_SESSION)){
                            echo "<div class=\"extra content\">
                      Classificação:
                        <div class=\"ui star rating\" data-rating=\"0\" data-max-rating=\"5\"></div>
                        </div>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        <?php endforeach ?>
    </div>
</section>
    <br>
</body>
<!--ADICIONA LIVRO A QUAL PRATELEIRA-->
<div class="ui modal" style="width: 450px; height: 260px" id="modal3">
    <div class="header">Adicione um título à sua prateleira:</div>
    <div class="content">
        <form method="post" class="ui form" action="../../app/Controlers/ControlerLivro.php?acao=add_livroprateleira&idusuario=<?=$id?>">
            <div class="field">
                <label>Selecione a prateleira que deseja adicionar este livro</label>
                <select multiple="" class="ui dropdown" name="livroadicionado" required>
                    <option value="">Selecione o/s Livro/s</option>
                    <?php foreach ($prateleiras as $prateleira):?>
                        <option value="<?=$prateleira->getPrId()?>"><?=$prateleira->getPrDescricao()?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input style="visibility: hidden; " type="text" name="getidprateleira" value="<?=$Prateleira->pr_id ?>">
            <button class="ui button" type="submit" name="gravar">Submit</button>
        </form>
    </div>
</div>
</html>
<script>

        $('.ui.rating')
        .rating()
    ;

    $( ".button.lipr" ).click(function() {
        $('#modal3').modal('show');
    });

    $('.ui.dropdown').dropdown();
</script>

<script type="text/javascript">
    $(function(){
        $("#pesquisa").keyup(function(){
            var pesquisa = $(this).val();

//               $(".resultados").html(pesquisa);
//                var campo = $("#campo").val();

            if(pesquisa !== ''){
                var dados = {
                    palavra : pesquisa
//                        campo : campo
                }
                $.post('busca.php', dados, function(retorna){
                    $(".resultados").html(retorna);
                    $('#principal').addClass('hidden');
                });
            }
        });
//            $("#campo").change(function () {
//
//                var pesquisa = $("#pesquisa").val();
//
//                var campo = $(this).val();
//
//                if (pesquisa != ''){
//                    var dados = {
//                        palavra : pesquisa,
//                        campo : campo
//                    }
//                    $.post('busca.php', dados, function(retorna){
//                        $("resultados").html(retorna);
//                    });
//                }else{
//                    $(".resultados").html('');
//                }
//            });
//            $("#form-pesquisa").submit(function(e){
//                e.preventDefault();
//
//                var pesquisa = $("#pesquisa").val();
//
//                if(pesquisa == ''){
//                    alert ('informa sua pesquisa!');
//                }else{
//                    var dados = {
//                        palavra : pesquisa
//                        campo : campo
//                    }
//                    $.post('busca.php', dados, function(retorna){
//                        $(".resultados").html(retorna);
//                    });
//                }
//            });
    });

</script>