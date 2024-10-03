<?php
include 'conexao.php';

// Inicializa as variáveis de filtro
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';

// Monta a consulta SQL, inicialmente sem filtros
$sql = "SELECT * FROM pessoas WHERE 1=1";

// Adiciona os filtros, caso o usuário tenha preenchido os campos
if (!empty($nome)) {
    $sql .= " AND nome LIKE :nome";
}
if (!empty($cpf)) {
    $sql .= " AND cpf = :cpf";
}

$stmt = $pdo->prepare($sql);

// Faz o bind dos parâmetros de busca, se necessário
if (!empty($nome)) {
    $stmt->bindValue(':nome', '%' . $nome . '%');
}
if (!empty($cpf)) {
    $stmt->bindValue(':cpf', $cpf);
}

// Executa a consulta
$stmt->execute();
$pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultar Pessoas</title>
</head>
<body>
    <h1>Lista de Pessoas Cadastradas</h1>

    <!-- Formulário de busca -->
    <form method="GET" action="consultar_pessoas.php">
        Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
        CPF: <input type="text" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>">
        <button type="submit">Buscar</button>
    </form>

    <br>

    <!-- Tabela de resultados -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>Sexo</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php if (count($pessoas) > 0): ?>
            <?php foreach ($pessoas as $pessoa): ?>
            <tr>
                <td><?php echo htmlspecialchars($pessoa['id']); ?></td>
                <td><?php echo htmlspecialchars($pessoa['nome']); ?></td>
                <td><?php echo htmlspecialchars($pessoa['data_nascimento']); ?></td>
                <td><?php echo htmlspecialchars($pessoa['cpf']); ?></td>
                <td><?php echo htmlspecialchars($pessoa['sexo']); ?></td>
                <td><?php echo htmlspecialchars($pessoa['telefone']); ?></td>
                <td><?php echo htmlspecialchars($pessoa['email']); ?></td>
                <td>
                    <a href="editar_pessoa.php?id=<?php echo $pessoa['id']; ?>">Editar</a> |
                    <a href="excluir_pessoa.php?id=<?php echo $pessoa['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir essa pessoa?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Nenhuma pessoa encontrada.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Mensagem de exclusão com sucesso -->
    <?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'sucesso'): ?>
        <p>Pessoa excluída com sucesso!</p>
    <?php endif; ?>
</body>
</html>