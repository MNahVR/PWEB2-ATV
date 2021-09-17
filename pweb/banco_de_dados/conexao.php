<?php
class conexao{
    public static function getConexao(){
        $database = "PWEB2_ATV2";
        $username = "root";
        $senha = "";
        return new PDO("mysql:host=localhost;dbname=$database", $username, $senha);
    }


}