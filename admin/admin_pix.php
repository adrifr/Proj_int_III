<?php
session_start();
include '../conexao.php';

// Verifica se é admin
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Lida com envio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_evento'])) {
    $nome_evento = $_POST['nome_evento'];
    $imagem_nome = '';

    if (!empty($_FILES['imagem_pix']['name'])) {
        $imagem_nome = 'pix_' . time() . '_' . $_FILES['imagem_pix']['name'];
        $caminho_imagem = 'uploads/' . $imagem_nome;
        move_uploaded_file($_FILES['imagem_pix']['tmp_name'], '../uploads/' . $imagem_nome);

    }

    $stmt = $conn->prepare("INSERT INTO pix_eventos (nome_evento, imagem_pix) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome_evento, $caminho_imagem);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_pix.php");
    exit;
}

// Lista eventos existentes
$eventos = $conn->query("SELECT * FROM pix_eventos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pix</title>
    <style>
    body { font-family: Arial; }
    nav a { margin-right: 15px; text-decoration: none; font-weight: bold; }
    .aba { display: none; padding: 20px; border-top: 1px solid #ccc; }
    .ativa { display: block; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
  </style>
</head>
<body>
    <!-- Menu de navegação do painel admin -->
<nav style="background-color: #002333; padding: 15px;">

    <a href="postar_blog.php" style="color: white; margin-right: 20px; font-weight: bold; text-decoration: none;">⬅ Voltar</a>
    
    <a href="../logout.php" style="color: red; font-weight: bold; text-decoration: none;">Sair</a>
</nav>

    <h2>Adicionar Novo Evento Pix</h2>

    <?php if (isset($_GET['editado']) && $_GET['editado'] == 1): ?>
    <p style="color: green; font-weight: bold;">✅ Evento atualizado com sucesso.</p>
    <?php endif; ?>


    <?php if (isset($_GET['excluido']) && $_GET['excluido'] == 1): ?>
    <p style="color: green; font-weight: bold;">✅ Evento excluído com sucesso.</p>
    <?php endif; ?>

    <form action="admin_pix.php" method="POST" enctype="multipart/form-data">
        <label>Nome do Evento:</label>
        <input type="text" name="nome_evento" required>
        <br><br>
        <label>Imagem Pix:</label>
        <input type="file" name="imagem_pix" accept="image/*" required>
        <br><br>
        <button type="submit">Postar Pix</button>
    </form>

    <h2>Eventos cadastrados</h2>
<?php
include '../conexao.php';

$sql = "SELECT * FROM pix_eventos ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
            <form action="editar_pix.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label>Nome do Evento:</label><br>
                <input type="text" name="nome_evento" value="<?php echo htmlspecialchars($row['nome_evento']); ?>" required><br><br>

                <label>Imagem Atual:</label><br>
                <img src="../<?php echo htmlspecialchars($row['imagem_pix']); ?>" alt="Imagem Pix" width="200">


                <label>Nova Imagem (opcional):</label><br>
                <input type="file" name="nova_imagem"><br><br>

                <button type="submit">Salvar Alterações</button>
                <a href="excluir_pix.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este evento?')" style="margin-left: 10px; color: red;">Excluir Evento</a>
            </form>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="color: red;"><strong>Sem eventos cadastrados.</strong></p>
<?php endif; ?>

</body>
</html>
