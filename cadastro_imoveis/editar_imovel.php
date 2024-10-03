<?php 
include "conexao.php";

// Verifica se o ID do imóvel foi passado via URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Consulta para obter os dados atuais do imóvel
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

    // Verifica se o formulário foi enviado para salvar as mudanças
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $logradouro = $_POST["logradouro"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $complemento = $_POST["complemento"];
        $pessoa_id = $_POST["pessoa_id"]; // ID do proprietário (pessoa)

        // Atualiza os dados do imóvel no banco de dados
        $sql = "UPDATE imoveis SET logradouro = :logradouro, numero = :numero, bairro = :bairro, complemento = :complemento, pessoa_id = :pessoa_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':pessoa_id', $pessoa_id);
        $stmt->execute();

        echo "Dados do imóvel atualizados com sucesso!";
    }
} else {
    echo "ID do imóvel não fornecido!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editar Imóvel</title>
</head>
<body>
    <h1>Editar Imóvel</h1>
    <form method="POST">
        Logradouro: <input type="text" name="logradouro" value="<?php echo isset($imovel['logradouro']) ? htmlspecialchars($imovel['logradouro']) : ''; ?>" required><br>
        Número: <input type="text" name="numero" value="<?php echo isset($imovel['numero']) ? htmlspecialchars($imovel['numero']) : ''; ?>" required><br>
        Bairro: <input type="text" name="bairro" value="<?php echo isset($imovel['bairro']) ? htmlspecialchars($imovel['bairro']) : ''; ?>" required><br>
        Complemento: <input type="text" name="complemento" value="<?php echo isset($imovel['complemento']) ? htmlspecialchars($imovel['complemento']) : ''; ?>"><br>
        Proprietário (Pessoa ID): <input type="text" name="pessoa_id" value="<?php echo isset($imovel['pessoa_id']) ? htmlspecialchars($imovel['pessoa_id']) : ''; ?>" required><br>
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>