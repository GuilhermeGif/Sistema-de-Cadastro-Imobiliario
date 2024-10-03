<?php 
include "conexao.php";

// Verifica se o ID da pessoa foi passado via URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Consulta para obter os dados atuais da pessoa
    $sql = "SELECT * FROM pessoas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o formulário foi enviado para salvar as mudanças
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $data_nascimento = $_POST["data_nascimento"];
        $cpf = $_POST["cpf"];
        $sexo = $_POST["sexo"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        // Atualiza os dados da pessoa no banco de dados
        $sql = "UPDATE pessoas SET nome = :nome, data_nascimento = :data_nascimento, cpf = :cpf, sexo = :sexo, telefone = :telefone, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo "Dados da pessoa atualizados com sucesso!";
    }
} else {
    echo "ID da pessoa não fornecido!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editar Pessoa</title>
</head>
<body>
    <h1>Editar Pessoa</h1>
    <form method="POST">
        Nome: <input type="text" name="nome" value="<?php echo $pessoa['nome']; ?>" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" value="<?php echo $pessoa['data_nascimento']; ?>" required><br>
        CPF: <input type="text" name="cpf" value="<?php echo $pessoa['cpf']; ?>" required><br>
        Sexo:
        <select name="sexo" required>
            <option value="M" <?php if ($pessoa['sexo'] == "M") echo "selected"; ?>>Masculino</option>
            <option value="F" <?php if ($pessoa['sexo'] == "F") echo "selected"; ?>>Feminino</option>
        </select><br>
        Telefone: <input type="text" name="telefone" value="<?php echo $pessoa['telefone']; ?>"><br>
        E-mail: <input type="email" name="email" value="<?php echo $pessoa['email']; ?>"><br>
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
