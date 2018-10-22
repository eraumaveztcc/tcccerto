<?php

require_once "../Models/CrudLivros.php";
require_once "../Models/CrudResenha.php";
require_once "../Models/UsuarioCrud.php";
require_once "../Models/CrudGenero.php";
require_once "../Models/GeneroLivro.php";
require_once "../Models/Resenha.php";
require_once "../Models/Prateleira.php";
require_once "../Models/CrudBiblioteca.php";
require_once "../Models/CrudComentario.php";


if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}


switch ($action){
    case 'add_livro':


        if (!isset($_POST['gravar'])) {
            $id = $_GET['idusuario'];
            @session_start();
            $_SESSION['us_id'] = $id;
            $crud = new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            $tipuser = $usuario->getTipUsuario();
            $crudGenero = new CrudGenero();
            $generos = $crudGenero->getGeneros();
            include "../View/Template/cabecalho.php";
            include "../View/telas/addlivro.php";
            include "../View/Template/rodape.php";
        } else {
            $idusuario = $_POST['getidusuario'];
            $livro = new Livros($_POST['li_ano'],
                                $_POST['li_autor'],
                                $_POST['li_censura'],
                                $_POST['li_editora'],
                                $_POST['li_paginas'],
                                $_POST['li_titulo'],
                                null,
                                $_POST['getidusuario']);


            $crud = new CrudLivros();
            $id = $crud->addLivro($livro);

            $crud2 = new CrudGenero();
            foreach ($_POST['li_genero'] as $genero) {
                $generoLivro = new GeneroLivro (null,$id, $genero);
                $crud2->addLivroGenero($generoLivro);
            }

            header("Location: ControlerUsuario.php?acao=index&idusuario=$idusuario");

            $crud3 = new CrudLivros();
            $crud4 = new CrudGenero();

            $id_livro=$crud3->getLivroPorUsuario($idusuario);
//            print_r($livroTentativa->li_idlivro);die;
            $generoDesseLivro = $crud4->getGeneroLivro($id_livro->li_idlivro);
            $crud3->addFatoresLivro($id_livro,$livro, $generoDesseLivro->gl_idgenero);

        }

        break;

    case 'add_imagem_teste':

        $msg = false;
    if(!isset($_POST['gravarteste'])){
        include "../View/telas/addImagemTeste.php";
    }
        if(isset($_FILES['imagem'])){
            $extensao = strtolower (substr($_FILES['imagem']['name'], -4)); //pega a extensao do arquivo, transforma tudo em minusculo
            $novo_nome = md5(time()) . $extensao; //define novo nome do arquivo criptografado para não ter dois arquivos de mesmo nome
            $diretorio = "../../assets/img/livros/"; //define o diretorio pra onde vai o arquivo

            move_uploaded_file($_FILES['imagem']['tpm_name'], $diretorio.$novo_nome); //coisa o upload

            $sql = "INSERT INTO imagem (img_id, arquivo, data) VALUES (null, '$novo_nome', NOW())";

            if ($mysqlli->query($sql)){
                $msg = "Arquivo enviado com sucesso";

            }else{
                $msg = "falha ao enviar o arquivo";
            }

        }
        break;

    case 'show':
        if (isset($_GET['idusuario'])){
        $id = $_GET['idusuario'];
        @session_start();
        $_SESSION['us_id'] = $id;
        $crud = new UsuarioCrud();
        $usuario = $crud->getUsuarioId($id);
        $tipuser = $usuario->getTipUsuario();
        }else {
            $tipuser = 0;
        }
        $id = $_GET['idusuario'];
        $idlivro = $_GET['idlivro'];
        $crudLivro = new CrudLivros();
        $livro = $crudLivro->getLivro($idlivro);
        $crudComentario = new CrudComentario();
        $comentarios = $crudComentario->getComentarios($livro);
//        print_r($comentarios);die;


        include "../View/Template/cabecalho.php";
        include "../View/telas/livro.php";
        include "../View/Template/rodape.php";

        break;


    case 'add_sinopse':


        if (!isset($_POST['gravar'])) {
            if (isset($_GET['idusuario'])){
            $id = $_GET['idusuario'];
            @session_start();
            $_SESSION['us_id'] = $id;
            $crud = new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            $tipuser = $usuario->getTipUsuario();
            }else{
                $tipuser = 0;
            }

            include "../View/Template/cabecalho.php";
            include "../View/telas/addsinopse.php";
            include "../View/Template/rodape.php";
        }else{

//    require_once "../View/telas/addsinopse.php";
            $idlivro = $_POST['getidlivro'];
            $crudLivro = new CrudLivros();
            $livro = $crudLivro->getLivro($idlivro);
            $idusuario = $_POST['getidusuario'];

            $data1 = new DateTime();
            $data  = $data1->format('Y-m-d H:i:s');
            $sinopseLivro = new Resenha(null, $livro->li_idlivro, $idusuario, $data, $_POST['re_textoresenha'], 1);


            $crud = new CrudLivros();
            $crud->addResenha($sinopseLivro);
            echo "<script>alert('A sinopse foi cadastrada')</script>";
            header("Location: ControlerUsuario.php?acao=index&idusuario=".$idusuario);

        }

        break;
    case 'add_prateleira':
        $idusuario = $_GET['idusuario'];
        if (!isset($_POST['gravar'])) {

        }else{
//            $crudLivro = new CrudLivros();

            $data1 = new DateTime();
            $data  = $data1->format('Y-m-d H:i:s');
            $adiciona = new Prateleira(null,$_POST['descricao'], $idusuario,$data,null);
//        print_r($adiciona);die;
            $crud = new CrudBiblioteca();
            $crud->addPrateleira($adiciona);
//            print_r($adiciona);die;
        }
        header("Location: ControlerUsuario.php?acao=index&idusuario=".$idusuario);
        break;

    case 'excluirSinopse':
        $idusuario = $_GET['idusuario'];
        $idresenha = $_GET['idresenha'];
        $crudLivro = new CrudResenha();
        $crudLivro->excluirResenha($idresenha);
        header("Location: ControlerUsuario.php:acao=index&idusuario=".$idusuario);
        break;

    case 'editarSinopse':
        if (!isset($_POST['gravar'])) {
            $id = $_GET['idusuario'];
            $idresenha = $_GET['idresenha'];
//            $resenhas = $crud->getResenha($idresenha);
//            echo "aaaaa";die;
            include "../View/Template/cabecalho.php";
            include "../View/telas/editarsinopse.php";
            include "../View/Template/rodape.php";
        } else {
            $id = $_GET['idusuario'];
            $idresenha = $_POST['idresenha'];
            $crud = new CrudResenha();
            $data1 = new DateTime();
            $data  = $data1->format('Y-m-d H:i:s');
            $resenhas = $crud->getResenhas($idresenha);
            $sinopseLivro = new Resenha(null,$livro->li_idlivro,$id,$data,$_POST['re_textoresenha'],1);
            $crud->editarResenha($sinopseLivro, $idresenha);
            header("Location: ControlerLivro.php?acao=show&idlivro=$livro->li_idlivro");
        }

        break;

    case 'excluirlivro':
        $idlivro= $_GET['idlivro'];
        $crud = new CrudLivros();
        $crud->excluirLivro($idlivro);
        header("Location: ControlerUsuario.php?acao=index");

        break;

    case 'add_coment':
//        print_r($_POST['cm_texto']);die;
        $data = new DateTime();
        $dataComentario  = $data->format('Y-m-d H:i:s');
        $novoComentario = new Comentario(
            $_POST['cm_texto'],
            $dataComentario,
            $_POST['getidusuario'],
            $_POST['getidlivro']
        );
        $idusuario=$_POST['getidusuario'];
        $idlivro=$_POST['getidlivro'];

        $crud = new CrudComentario();
        $crud->fazComentario($novoComentario);
        header("Location: ControlerLivro.php?acao=show&idlivro=$idlivro&idusuario=$idusuario");
        break;

    case 'add_livroprateleira':
        $idusuario = $_GET['idusuario'];
        if (!isset($_POST['gravar'])) {

        }else{
//            $crudLivro = new CrudLivros();
//            foreach ($_POST['livroadicionado'] as $livroadicionado) {
//                $generoLivro = new GeneroLivro (null,$id, $genero);
//                $crud2->addLivroGenero($generoLivro);
//            }


            $data1 = new DateTime();
            $data  = $data1->format('Y-m-d H:i:s');
            $adiciona = new Biblioteca(null,$_POST['livroadicionado'],$_POST['getidprateleira'],$data,null);
//        print_r($adiciona);die;
            $crud = new CrudBiblioteca();
            $crud->addBiblioteca($adiciona);
        }
        header("Location: ControlerUsuario.php?acao=index&idusuario=".$idusuario);
        break;
}


