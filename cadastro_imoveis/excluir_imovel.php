<?php
include "conexao.php";

// Verifica se o ID do imóvel foi passado via URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Consulta para verificar se o imóvel existe
    $sql = "SELECT * FROM imoveis WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $imovel = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o imóvel foi encontrado
    if (!$imovel) {
        echo "Imóvel não encontrado!";
        exit;
    }

    // Exclui o imóvel do banco de dados
    $sql = "DELETE FROM imoveis WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "Imóvel excluído com sucesso!";
} else {
    echo "ID do imóvel não fornecido!";
}

    // Redireciona para a página de consulta
header("Location: consultar_imoveis.php?exclusao=sucesso");
exit();
?>