<?php

require '../Models/UsuarioCrud.php';


if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}

switch ($action){
    case 'index':

        include "../View/adminindex.php";

        break;

}