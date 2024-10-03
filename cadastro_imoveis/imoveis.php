<?php include "conexao.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cadastro de Imóveis</title>
</head>
<body>
    <h1>Cadastro de Imóveis</h1>
    <form method="POST" action="imoveis.php">
        Logradouro: <input type="text" name ="logradouro" required><br>
        Número: <input type="number" name="numero" required><br>
        Bairro: <input type="text" name="bairro" required><br>
        Complemento: <input type="text" name="complemento"><br>
        Proprietário:
        <select name="pessoa_id" required>
            <?php
                $sql = "SELECT * FROM pessoas";
                $stmt = $pdo->query($sql);
                $pessoas = $stmt->fetchAll();
                foreach($pessoas as $pessoa) {
                    echo "<option value='".$pessoa["id"]."'>".$pessoa["nome"]."</option>";
                }
            ?>
        </select><br>
        <button type="submit">Cadastrar Imóvel</button>
    </form>

    <?php
        // Capturando os dados do formulário
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $logradouro = $_POST["logradouro"];
            $numero = $_POST["numero"];
            $bairro = $_POST["bairro"];
            $complemento = $_POST["complemento"];
            $pessoa_id = $_POST["pessoa_id"];

            // Construindo a consulta SQL com placeholders
            $sql = "INSERT INTO imoveis (logradouro, numero, bairro, complemento, pessoa_id) VALUES (:logradouro, :numero, :bairro, :complemento, :pessoa_id)";

            // Preparando a query
            $stmt = $pdo->prepare($sql);

            // Associando os valores aos placeholders
            $stmt->bindParam(":logradouro", $logradouro);
            $stmt->bindParam(":numero", $numero);
            $stmt->bindParam(":bairro", $bairro);
            $stmt->bindParam(":complemento", $complemento);
            $stmt->bindParam(":pessoa_id", $pessoa_id);

            // Executando a query
            $stmt->execute();

            echo "Imóvel cadastrado com sucesso!";
        }
    ?>
</body>
</html>