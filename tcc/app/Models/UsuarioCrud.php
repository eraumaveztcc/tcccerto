<?php
require_once 'DBConnection.php';
require_once 'Usuario.php';
require_once 'Fator.php';
require_once 'FatorUsuario.php';
require_once 'LivrosFatorUsuario.php';
require_once '../Controlers/ControlerFormulario.php';
class UsuarioCrud
{
    //SEMPRE QUE A CLASSE FOR INSTANCIADA, JA FAZ A CONEXÃO E GUARDA
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }

    //RETORNA VERDADEIRO OU FALSA

    public function LoginUsuario(Usuario $user)
    {
        $sql = $this->conexao->prepare("SELECT * FROM Usuario WHERE us_email = '{$user->getUsEmail()}' AND us_senha = '{$user->getUsSenha()}'");
        $sql->execute();
        $resultado = $sql->rowCount();
        return $resultado;
    }

    public function verificaAdmin($tip_usuario)
    {

        if ($tip_usuario == '2') {
            return true;
        } else {
            return false;
        }
    }


    public function getUsuario($email)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID
        //FAZER A CONSULTA
        $sql = "select * from Usuario where us_email='{$email}'";
        $resultado = $this->conexao->query($sql);
        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoUsuario = new Usuario(
            $usuario['us_nome'],
            $usuario['us_email'],
            $usuario['us_senha'],
            $usuario['us_datanascimento'],
            $usuario['us_sexo'],
            $usuario['us_id'],
            $usuario['tip_usuario']
        );
        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoUsuario;
    }

    public function getUsuarioId($us_id)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID
        //FAZER A CONSULTA
        $sql = "select * from Usuario where us_id='{$us_id}'";
        $resultado = $this->conexao->query($sql);
        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoUsuario = new Usuario(
            $usuario['us_nome'],
            $usuario['us_email'],
            $usuario['us_senha'],
            $usuario['us_datanascimento'],
            $usuario['us_sexo'],
            $usuario['us_id'],
            $usuario['tip_usuario']

        );
        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoUsuario;
    }


    public function getUsuarios()
    {
        $sql = "SELECT * FROM Usuario";

        $resultado = $this->conexao->query($sql);

        $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usuarios as $usuario) {
            $nome = $usuario['us_nome'];
            $senha = $usuario['us_senha'];
            $email = $usuario['us_email'];
            $datanascimento = $usuario['us_datanascimento'];
            $sexo = $usuario['us_sexo'];
            $iduser = $usuario['us_id'];
            $tipuser = $usuario['tip_usuario'];

            $obj = new Usuario($nome, $senha, $email, $datanascimento, $sexo, $iduser, $tipuser);
            $listaUsuario[] = $obj;
        }
        return $listaUsuario;
    }

    public function updateUsuario(Usuario $user)
    {

        $this->conexao = DBConnection::getConexao();

        $sql = "UPDATE Usuario SET us_nome = '{$user->us_nome}', us_senha ='{$user->us_senha}', us_email = '{$user->us_email}'
        WHERE us_id = '{$user->us_id}'";

        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

    public function insertUsuario(Usuario $user)
    {

        //EFETUA A CONEXAO
        $this->conexao = DBConnection::getConexao();
        //MONTA O TEXTO DA INSTRUÇÂO SQL
        $sql = "insert into Usuario (us_nome, us_email,us_senha,us_datanascimento, us_sexo, tip_usuario) 
        values ('{$user->getUsNome()}','{$user->getUsEmail()}','{$user->getUsSenha()}','{$user->getUsDatanascimento()}','{$user->getUsSexo()}',1)";

        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

    public function deleteUsuario($id)
    {

        //EFETUA A CONEXAO
        $this->conexao = DBConnection::getConexao();
        //MONTA O TEXTO DA INSTRUÇÂO SQL
        $sql = "DELETE FROM Usuario WHERE us_id = '{$id}'";
        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

    public function getResultadoFormulario(FatorUsuario $resultadoFormularioTL,$resultadoFormularioGL,$resultadoFormularioAU,$resultadoFormularioAP,$resultadoFormularioCL,$resultadoFormularioLA)
    {
        $excluir = "delete from fatorusuario where fu_idusuario = '{$resultadoFormularioTL->getFuIdusuario()}'";

        $sql1 = "INSERT INTO fatorusuario (fu_id,fu_idfator,fu_idusuario,fu_nota) 
  VALUES (null,'{$resultadoFormularioTL->getFuIdfator()}',
    '{$resultadoFormularioTL->getFuIdusuario()}',
  '{$resultadoFormularioTL->getFuNota()}')";

        $sql2 = "INSERT INTO fatorusuario (fu_id,fu_idfator,fu_idusuario,fu_nota) 
  VALUES (null,'{$resultadoFormularioGL->getFuIdfator()}',
    '{$resultadoFormularioGL->getFuIdusuario()}',
  '{$resultadoFormularioGL->getFuNota()}')";

        $sql3 = "INSERT INTO fatorusuario (fu_id,fu_idfator,fu_idusuario,fu_nota) 
  VALUES (null,'{$resultadoFormularioAU->getFuIdfator()}',
    '{$resultadoFormularioAU->getFuIdusuario()}',
  '{$resultadoFormularioAU->getFuNota()}')";

        $sql4 = "INSERT INTO fatorusuario (fu_id,fu_idfator,fu_idusuario,fu_nota) 
  VALUES (null,'{$resultadoFormularioAP->getFuIdfator()}',
    '{$resultadoFormularioAP->getFuIdusuario()}',
  '{$resultadoFormularioAP->getFuNota()}')";

        $sql5 = "INSERT INTO fatorusuario (fu_id,fu_idfator,fu_idusuario,fu_nota) 
  VALUES (null,'{$resultadoFormularioCL->getFuIdfator()}',
    '{$resultadoFormularioCL->getFuIdusuario()}',
  '{$resultadoFormularioCL->getFuNota()}')";

        $sql6 = "INSERT INTO fatorusuario (fu_id,fu_idfator,fu_idusuario,fu_nota) 
  VALUES (null,'{$resultadoFormularioLA->getFuIdfator()}',
    '{$resultadoFormularioLA->getFuIdusuario()}',
  '{$resultadoFormularioLA->getFuNota()}')";


        //PRIMEIRO EXCLUI TUDO ANTES DE ADICIONAR UM NOVO

        $this->conexao->exec($excluir);
        $this->conexao->exec($sql1);
        $this->conexao->exec($sql2);
        $this->conexao->exec($sql3);
        $this->conexao->exec($sql4);
        $this->conexao->exec($sql5);
        $this->conexao->exec($sql6);
    }

    public function setFatores($usuario){
        //FALTA ADICIONAR A AVALIAÇÃO DOS USUARIOS E "EM ALTA" À CONSULTA

                //SELECT TAMANHO DO LIVRO
        $sql = "select fu_idusuario,fu_idfator,fu_nota,fu_id, fl_valor,li_idlivro,li_titulo,li_paginas,li_autor 
                from livro,fatorlivro,fatores,fatorusuario 
                where li_idlivro =fl_idlivro 
                AND fl_idfator	 =fu_idfator 
                AND fu_idusuario = '{$usuario->us_id}'
                AND fa_id		 =fl_idfator 
                AND fl_idfator   = '1'
                AND fl_valor	<=fu_nota
                
                UNION
                /*SELECT GENEROS DO LIVRO*/
                select fu_idusuario,fu_idfator,fu_nota,fu_id, fl_valor,li_idlivro,li_titulo,li_paginas,li_autor 
                from livro,fatorlivro,fatores,fatorusuario 
                where li_idlivro =fl_idlivro 
                AND fl_idfator	 =fu_idfator 
                AND fu_idusuario = '{$usuario->us_id}'
                AND fa_id		 =fl_idfator 
                AND fl_idfator   = '2' 
                AND fl_valor	 =fu_nota
                /* ADICIONAR PARA MAIS GENEROS */
                
                UNION
                /* SELECT ANO DE PUBLICACAO */ 
                select fu_idusuario,fu_idfator,fu_nota,fu_id, fl_valor,li_idlivro,li_titulo,li_paginas,li_autor 
                from livro,fatorlivro,fatores,fatorusuario 
                where li_idlivro =fl_idlivro 
                AND fl_idfator	 =fu_idfator 
                AND fu_idusuario = '{$usuario->us_id}'
                AND fa_id		 =fl_idfator 
                AND fl_idfator   = '4' 
                AND fl_valor	 >=fu_nota
                
                UNION
                /* SELECT CENSURA DO LIVRO */
                select fu_idusuario,fu_idfator,fu_nota,fu_id, fl_valor,li_idlivro,li_titulo,li_paginas,li_autor 
                from livro,fatorlivro,fatores,fatorusuario 
                where li_idlivro =fl_idlivro 
                AND fl_idfator	 =fu_idfator 
                AND fu_idusuario = '{$usuario->us_id}'
                AND fa_id		 =fl_idfator 
                AND fl_idfator   = '5' 
                AND fl_valor	 <=fu_nota 
                ";
//        print_r($sql);die;
        $resultado = $this->conexao->query($sql);

        $livrosfator = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($livrosfator as $livrofator) {
//            print_r($livrofator);

//
            $fu_id = $livrofator['fu_id'];
            $fu_idfator = $livrofator['fu_idfator'];
            $fu_idusuario = $livrofator['fu_idusuario'];
            $li_titulo = $livrofator['li_titulo'];
            $li_autor = $livrofator['li_autor'];

            $obj = new LivrosFatorUsuario($fu_id,$fu_idfator,$fu_idusuario,$li_titulo,$li_autor);
            $ListaLivros[] = $obj;
//            print_r($obj);
//            echo "<br>";
        }

        return $ListaLivros;
    }
    public function getFatorUsuario($idusuario)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID
        //FAZER A CONSULTA
        $sql = "select * from fatorusuario where fu_idusuario='{$idusuario}'";
        $resultado = $this->conexao->query($sql);
        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $fatorusuario = $resultado->fetch(PDO::FETCH_ASSOC);
        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoUsuario = new FatorUsuario(
            $fatorusuario['fu_id'],
            $fatorusuario['fu_idfator'],
            $fatorusuario['fu_idusuario'],
            $fatorusuario['fu_nota']
        );
        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoUsuario;
    }
}

