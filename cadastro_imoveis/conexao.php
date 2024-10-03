<?php
    // Script para conexão com o banco de dados.

    $host = "localhost";
    $db = "cadastro_imoveis";
    $user = "root";
    $pass = "";

    try {
        $pdo = new PDO( "mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
?>

