<?php

//Código de conexão com o banco de dados
function conexao()
{
    //Variáveis de conexão com o banco de dados
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "bunco";

    try {
        //Cria a conexão e retorna ela quando a função for chamada
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        date_default_timezone_set('America/Sao_Paulo');

        return $conn;
    } 
    //Erro caso a conexão der errado
    catch (PDOException $e) {
        //echo "Erro ao conectar: " . $e->getMessage();
        return null;
    }
}
