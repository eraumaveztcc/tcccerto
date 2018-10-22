<?php

require '../Models/UsuarioCrud.php';
require '../Models/CrudGenero.php';


if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}

switch ($action){
    case 'index':


        $crudUser = new UsuarioCrud();
        $usuarios = $crudUser->getUsuarios();

        $crudGenero = new CrudGenero();
        $generos = $crudGenero->getGeneros();

        @session_start();

        $_SESSION['id'] = $_GET['iduser'];
        $id = $_SESSION['id'];
        $usuario = $crudUser->getUsuarioId($id);
        $tipuser = $usuario->getTipUsuario();


        include "../View/Template/cabecalho.php";
        include "../View/admin/adminindex.php";

        break;

    case 'editar':

        if (!isset($_POST['gravar'])) {
            $id = $_GET['iduser'];
            $crud= new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            @session_start();
            include "../View/telas/editar.php";
        } else {
            $id = $_GET['iduser'];
            $crud = new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            $user = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], $usuario->us_datanascimento, $usuario->us_sexo, $usuario->us_id, $usuario->tip_usuario);
            $crud->updateUsuario($user);
            header("Location: ControlerAdmin.php");
        }

        break;

    case 'excluir':

        $iduser = $_GET['iduser'];
        //EXCLUI USUARIO
        $cruduser = new UsuarioCrud();
        $resultado = $cruduser->deleteUsuario($iduser);
        header("Location: ControlerAdmin.php");

        break;

    case 'addGenero':

        if (!isset($_POST['gravar'])) {
            $id = $_GET['iduser'];
            $crud= new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            @session_start();
            include "../View/Template/cabecalho.php";
            include "../View/telas/addGenero.php";
            include "../View/Template/rodape.php";
        } else {
            $id = $_GET['iduser'];

            $idGenero = $_GET['idGenero'];
            $crudGenero = new CrudGenero();
            $genero = new Generos($_POST['descricao']);
            $crudGenero->addGenero($genero);
            header("Location: ControlerAdmin.php");
        }
        break;

    case 'excluirGenero':

        $idGenero = $_GET['idGenero'];
        //EXCLUI USUARIO
        $crudGenero = new CrudGenero();
        $crudGenero->excluirGenero($idGenero);
        header("Location: ControlerAdmin.php");

        break;

    case 'editarGenero':

        if (!isset($_POST['gravar'])) {
            $idGenero = $_GET['idGenero'];
            $crudGenero = new CrudGenero();
            $genero = $crudGenero->getGenero($idGenero);
            @session_start();
            include "../View/Template/cabecalho.php";
            include "../View/telas/editarGenero.php";
            include "../View/Template/rodape.php";
        } else {
            $idGenero = $_POST['idGenero'];
            $crudGenero = new CrudGenero();
            $crud2 = new CrudGenero();
            $genero = $crud2->getGenero($idGenero);
            $generonovo = new Generos($_POST['descricao']);
            $crudGenero->editarGenero($generonovo,$idGenero);
            header("Location: ControlerAdmin.php");
        }
        break;
}