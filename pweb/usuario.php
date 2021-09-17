<?php

require_once "pweb/banco_de_dados/conexao.php";

class usuario{
    private Int $id;
    private String $nome;
    private String $nomeu;
    private String $email;
    private String $senha;

    function __construct(String $nome, String $nomeu, String $email, String $senha){
        $this->nome = $nome;
        $this->nomeu = $nomeu;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function salvarBD(){
        try {
            $this->hashsenha();
			$nome = $this->getNome();
            $nomeu = $this->getNomeu();
			$email =  $this->getEmail();
            $senha = $this->getSenha();

            $stmt = conexao::getConexao()->prepare('INSERT INTO user (nome, nomeu, email, senha) VALUES (:nome, :nomeu, :email, :senha)');
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":nomeu", $nomeu);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            $stmt->execute();
        } catch (Exception $err) {
            echo `<div class="exception">` . $err->getMessage() . `</div>`;
            return false;
        }
    }

    private function hashSenha(){
       $this->setSenha(senha($this->getSenha(), senha_DEFAULT));
    }

    public static function pesquisa(String $queryString){
        $stmt =  Connection::getConexao()->prepare('SELECT * FROM usuario WHERE email LIKE :query_string or nomeu LIKE :query_string or nome LIKE :query_string');
        $queryString = '%' . $queryString . '%';
        $stmt->bindParam(":query_string", $queryString);
        $fetchAll = $stmt->execute();
        $fetchAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usuario = usuario::mapUsuario($fetchAll);
        return $usuario;
    }

    public static function listUsuario(){
        try {
            $query = conexao::getConexao()->query('SELECT * FROM usuario');
            $list = $query->fetchAll(PDO::FETCH_ASSOC);
            $usuario = usuario::mapUsuario($list);
            return $usuario;
        } catch (Exception $err) {
            echo `<div class="exeption">` . $err->getMessage() . `</div>`;
            return false;
        }
    }

    private static function mapUsuario($list){
        return array_map(function ($e) {
            $usuario =  new usuario($e['nome'], $e['nomeu'], $e['email'], $e['senha']);
            $usuario->setId($e['id']);
            return $usuario;
        }, $list);
    }

    public static function login(String $email, String $senha){
        try {
            $stmt = conexao::getConexao()->prepare('SELECT * FROM usuario WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $usuario = sizeof($result) > 0 ? $result[0] : NULL;
            if (is_null($usuario)) {
                throw new Exception("usuário não encontrado");
            }
            if (!verificar_senha($senha, $usuario['senha'])) {
                throw new Exception("Senha inválida");
            }
            $return = new usuario($usuario['nome'], $usuario['nomeu'], $usuario['email'], $usuario['senha']);
            $return->setId($usuario['id']);
            return $return;
        } catch (Exception $err) {
            echo `<div class="exeption">` . $err->getMessage() . `</div>`;
            return false;
        }
    }


    public function getId(){
        return $this->id;
    }
    public function setId(Int $id){
        $this->id = $id;

        return $this;
    }
	   public function getNome(){
        return $this->nome;
    }

    public function setNome(String $nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNomeu(){
        return $this->nomeu;
    }

    public function setNomeu(String $nomeu){
        $this->nomeu = $nomeu;

        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail(String $email){
        $this->email = $email;

        return $this;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha(String $senha){
        $this->senha = $senha;

        return $this;
    }
}
