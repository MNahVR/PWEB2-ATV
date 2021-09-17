<?php
class conexao{
    public static function getConexao(){
        $database = "PWEB2-ATV";
        $username = "root";
        $senha = "";
        return new PDO("mysql:host=localhost;dbname=$database", $username, $senha);
    }


}