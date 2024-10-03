<?php
include "conexao.php";

// Verifica se o ID da pessoa foi passado via URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Consulta para verificar se a pessoa existe
    $sql = "SELECT * FROM pessoas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se a pessoa foi encontrada
    if (!$pessoa) {
        echo "Pessoa não encontrada!";
        exit;
    }

    // Exclui a pessoa do banco de dados
    $sql = "DELETE FROM pessoas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "Pessoa excluída com sucesso!";
} else {
    echo "ID da pessoa não fornecido!";
}

    // Redireciona para a página de consulta
header("Location: consultar_pessoas.php?exclusao=sucesso");
exit();
?>