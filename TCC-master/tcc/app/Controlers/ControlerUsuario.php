<?php

require '../Models/UsuarioCrud.php';


if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}

switch ($action){
    case 'index':

        $tipuser = 0;
        include "../View/Template/cabecalho.php";
        include "../View/index.php";
        include "../View/Template/rodape.php";

        break;

    case 'login':
        if (!isset($_POST['gravar'])){
            include "../View/usuario/login.php";
        }else {
            $user = new Usuario(null, $_POST['email'], $_POST['senha']);
            $crud = new UsuarioCrud();
            $resultado = $crud->LoginUsuario($user);
            $user = $crud->getUsuario($_POST['email']);

            if ($resultado == 0) {
                header("Location: ?acao=login&erro=loginerrado");
            } else {
                session_start();
                $_SESSION['us_id'] = $user->getUsId();
                $id = $_SESSION['us_id'];
                $crud = new UsuarioCrud();
                $user = $crud->getUsuarioId($id);
                $tipuser = $user->getTipUsuario();

                include "../View/Template/cabecalho.php";
                include "../View/index.php";
                include "../View/Template/rodape.php";
            }
        }

        break;

     case 'logout':


         session_start();
         session_destroy();
         header("Location: ControlerUsuario.php");

         break;

    case 'cadastrar':

        if (!isset($_POST['gravar'])) {
            include "../View/usuario/cadastrar.php";
        } else {
            $user = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['datanascimento'], $_POST['sexo']);
            $crud = new UsuarioCrud();
            $crud->insertUsuario($user);
            
            header("Location: ?acao=login");
        }
        break;

    case 'biblioteca':

        include "../View/usuario/biblioteca.php";

        break;

}
