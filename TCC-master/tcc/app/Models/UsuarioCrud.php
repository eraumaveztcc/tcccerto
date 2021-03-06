<?php
require_once 'DBConnection.php';
require_once 'Usuario.php';
class UsuarioCrud
{
    //SEMPRE QUE A CLASSE FOR INSTANCIADA, JA FAZ A CONEXÃO E GUARDA
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }
    //RETORNA VERDADEIRO OU FALSA

    public function LoginUsuario(Usuario $user){
        $sql = $this->conexao->prepare("SELECT * FROM Usuario WHERE us_email = '{$user->getUsEmail()}' AND us_senha = '{$user->getUsSenha()}'");
        $sql->execute();
        $resultado = $sql->rowCount();
        return $resultado;
    }

    public function verificaAdmin($tip_usuario){

        if ($tip_usuario == '2'){
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
        $sql = "SELECT * FROM usuarios";

        $resultado = $this->conexao->query($sql);

        $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usuarios as $usuario) {
            $nome = $usuario['nome'];
            $senha = $usuario['senha'];
            $email = $usuario['email'];
            $telefone = $usuario['telefone'];
            $cpf = $usuario['cpf'];
            $endereco = $usuario['endereco'];
            $tipuser = $usuario['tip_usuario'];

            $obj = new Usuario($nome, $senha, $email, $telefone, $cpf, $endereco,$tipuser);
            $listaUsuario[] = $obj;
        }
        return $listaUsuario;
    }

//    public function updateUsuario(Usuario $user){
//
//        $this->conexao = DBConnection::getConexao();
//
//        $sql = "UPDATE usuarios SET nome = '$user->nome', senha = $user->senha, email = $user->email, telefone = '$user->telefone', cpf = '$user->cpf', endereco = '$user->endereco'
//        WHERE id_usuario = $user->id";
//
//        try {//TENTA EXECUTAR A INSTRUCAO
//
//            $this->conexao->exec($sql);
//        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
//            return $e->getMessage();
//        }
//    }

    public function insertUsuario(Usuario $user)
    {

        //EFETUA A CONEXAO
        $this->conexao = DBConnection::getConexao();
        //MONTA O TEXTO DA INSTRUÇÂO SQL
        $sql = "insert into Usuario (us_nome, us_email,us_senha,us_datanascimento, us_sexo, tip_usuario) 
        values ('{$user->getUsNome()}','{$user->getUsEmail()}','{$user->getUsSenha()}','{$user->getUsDatanascimento()}','{$user->getUsSexo()}',1)";

        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

    public function getTipuser()
    {

    }

}