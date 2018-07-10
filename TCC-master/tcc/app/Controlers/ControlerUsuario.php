<?php
//COISAS PRA ARRUMAR:
//LOCAL DO REQUIRE

    // ARRUMAR FORMULARIO PRA MADNAR O EMAIL AO INVEZ DO NOME.   CONTROLARDOPR USUARIO: PEGAR O POST_EMAIL AO INVEZ DO POST_NOME E FAZER GETuSUARIO COMO PARAMETRO $US_EMAIL.  USUARIOCRUD USAR EMAIL COMO PARAMETRO AO INVEZ DO ID

require '../Models/UsuarioCrud.php';


if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}
$id = $_SESSION['us_id'];

$crud = new UsuarioCrud();

$user = $crud->getUsuarioId($id);
$tip_usuario = $user->getId();
if ($tip_usuario == 2){
    echo "adm";
    die;
}

switch ($action){
    case 'index':

        include "../View/index.php";

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
                header("Location: ?acao=login&erro=1");
            } else {
                session_start();
                $_SESSION['us_id'] = $user->getId();
                include "../View/index.php";
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
            
            //header("Location: ?acao=login");
        }
        break;

}
