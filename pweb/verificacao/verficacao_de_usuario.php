<?php

require_once "pweb/usuario.php";

class verificacao_de_usuario{
    public function cadastrar()
    {
        $nome = $_POST["nome"];
        $nomeu = $_POST["nomeu"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        if (!isset($nome) || !isset($nomeu) || !isset($email) || !isset($senha)) {
            require_once "pweb/telas/cadastro.php";
        } else {
            $usuario = new usuario($nome, $nomeu, $email, $senha);
            $result = $usuario->salvarBD();
            if (!is_bool($result)) {
                require_once "pweb/telas/login.php";
            } else {
                require_once "pweb/telas/cadastro.php";
            }
        }
    }

    public function login()
    {
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        if (!isset($email) || !isset($senha)) {
            require_once "pweb/telas/cadastro.php";
        } else {
            $result = Usuario::login($email, $senha);
            if (!is_bool($result)) {
                $_SESSION["loggedUser"] = array("id" => $result->getId(), "nomeu" => $result->getNomeu(), "email" => $result->getEmail());
                require_once "pweb/telas/principal.php.php";
            } else {
                require_once "pweb/telas/login.php";
            }
        }
    }

    public function sair()
    {
        session_destroy();
        header("Location: ?view=login");
    }
}