
<?php include "conexao.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cadastro de Pessoas</title>
</head>
<body>
    <h1>Cadastro de Pessoas</h1>
    <form method="POST" action="pessoas.php">
        Nome: <input type="text" name="nome" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" required><br>
        CPF: <input type="text" name="cpf" required><br>
        Sexo: <select name="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select><br>
        Telefone: <input type="text" name="telefone"><br>
        E-mail: <input type="email" name="email"><br>
        <button type="submit">Cadastrar</button>
    </form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Capturando os dados do formulário
        $nome = $_POST["nome"];
        $data_nascimento = $_POST["data_nascimento"];
        $cpf = $_POST["cpf"];
        $sexo = $_POST["sexo"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        // Construindo a consulta SQL com placeholders
        $sql = "INSERT INTO pessoas (nome, data_nascimento, cpf, sexo, telefone, email) 
                VALUES (:nome, :data_nascimento, :cpf, :sexo, :telefone, :email)";
        
        // Preparando a query
        $stmt = $pdo->prepare($sql);
        
        // Associando os valores aos placeholders
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":data_nascimento", $data_nascimento);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":sexo", $sexo);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        
        // Executando a query
        $stmt->execute();

        // Mensagem de sucesso
        echo "Pessoa cadastrada com sucesso!";
    }
?>
</body>
</html> 