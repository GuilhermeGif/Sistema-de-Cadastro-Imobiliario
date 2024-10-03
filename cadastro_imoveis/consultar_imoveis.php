<?php
include 'conexao.php';

// Inicializa as variáveis de filtro
$logradouro = isset($_GET['logradouro']) ? $_GET['logradouro'] : '';

// Monta a consulta SQL, inicialmente sem filtros
$sql = "SELECT im.*, p.nome AS proprietario 
        FROM imoveis im 
        JOIN pessoas p ON im.pessoa_id = p.id 
        WHERE 1=1";

// Adiciona o filtro, caso o usuário tenha preenchido o campo
if (!empty($logradouro)) {
    $sql .= " AND im.logradouro LIKE :logradouro";
}

$stmt = $pdo->prepare($sql);

// Faz o bind do parâmetro de busca, se necessário
if (!empty($logradouro)) {
    $stmt->bindValue(':logradouro', '%' . $logradouro . '%');
}

// Executa a consulta
$stmt->execute();
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultar Imóveis</title>
</head>
<body>
    <h1>Lista de Imóveis Cadastrados</h1>

    <!-- Formulário de busca -->
    <form method="GET" action="consultar_imoveis.php">
        Logradouro: <input type="text" name="logradouro" value="<?php echo htmlspecialchars($logradouro); ?>">
        <button type="submit">Buscar</button>
    </form>

    <br>

    <!-- Tabela de resultados -->
    <table border="1">
        <tr>
            <th>Inscrição Municipal</th>
            <th>Logradouro</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Complemento</th>
            <th>Proprietário</th>
            <th>Ações</th>
        </tr>
        <?php if (count($imoveis) > 0): ?>
            <?php foreach ($imoveis as $imovel): ?>
            <tr>
                <td><?php echo htmlspecialchars($imovel['id']); ?></td>
                <td><?php echo htmlspecialchars($imovel['logradouro']); ?></td>
                <td><?php echo htmlspecialchars($imovel['numero']); ?></td>
                <td><?php echo htmlspecialchars($imovel['bairro']); ?></td>
                <td><?php echo htmlspecialchars($imovel['complemento']); ?></td>
                <td><?php echo htmlspecialchars($imovel['proprietario']); ?></td>
                <td>
                    <a href="editar_imovel.php?id=<?php echo $imovel['id']; ?>">Editar</a> |
                    <a href="excluir_imovel.php?id=<?php echo $imovel['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este imóvel?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Nenhum imóvel encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Mensagem de exclusão com sucesso -->
    <?php if (isset($_GET['exclusao']) && $_GET['exclusao'] == 'sucesso'): ?>
        <p>Imóvel excluído com sucesso!</p>
    <?php endif; ?>
</body>
</html>