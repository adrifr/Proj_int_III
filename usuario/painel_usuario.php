<?php
session_start();
include '../conexao.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'usuario') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Buscar dados do membro
$sql = "SELECT * FROM members WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel do Usuário</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    input, select { margin: 5px 0; padding: 5px; width: 100%; }
    .qr { margin-top: 20px; }
    .botao-excluir { background-color: red; color: white; padding: 8px; border: none; cursor: pointer; }
  </style>
  <style>
  .mensagem-sucesso {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
  }
</style>
  <script>
    function confirmarExclusao() {
      return confirm("Tem certeza que deseja excluir seu cadastro?");
    }
  </script>
</head>
<body>

<?php if (isset($_GET['comprovante']) && $_GET['comprovante'] === 'enviado'): ?>
  <p style="color: green; font-weight: bold;">
  <div class="mensagem-sucesso">
  ✅ Comprovante enviado com sucesso!
</div>
  </p>
<?php endif; ?>

  <h2>Bem-vindo ao seu painel</h2>

  <div style="text-align: right; margin: 10px;">
  <a href="http://localhost/Projeto_Integrador/logout.php" style="color: #fff; background: #c62828; padding: 8px 12px; border-radius: 5px; text-decoration: none;">Sair</a>
</div>


  <form method="POST" action="atualizar_usuario.php">
    <input type="hidden" name="id" value="<?= $dados['id'] ?>">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $dados['nome'] ?>" required>

    <label>Sobrenome:</label>
    <input type="text" name="sobrenome" value="<?= $dados['sobrenome'] ?>" required>

    <label>Bairro:</label>
    <input type="text" name="bairro" value="<?= $dados['bairro'] ?>">

    <label>Rua:</label>
    <input type="text" name="rua" value="<?= $dados['rua'] ?>">

    <label>Número:</label>
    <input type="text" name="numero" value="<?= $dados['numero'] ?>">

    <label>Casa:</label>
    <input type="text" name="casa" value="<?= $dados['casa'] ?>">

    <label>CEP:</label>
    <input type="text" name="cep" value="<?= $dados['cep'] ?>">

    <label>Idade:</label>
    <input type="number" name="idade" value="<?= $dados['idade'] ?>">

    <label>Sexo:</label>
    <select name="sexo">
      <option value="Masculino" <?= $dados['sexo'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
      <option value="Feminino" <?= $dados['sexo'] == 'Feminino' ? 'selected' : '' ?>>Feminino</option>
    </select>

    <br><br>
    <input type="submit" value="Atualizar Dados">
  </form>

  <form method="POST" action="excluir_usuario.php" onsubmit="return confirmarExclusao();">
    <input type="hidden" name="user_id" value="<?= $user_id ?>">
    <button type="submit" class="botao-excluir">Excluir Cadastro</button>
  </form>

  <div class="qr">
    <h3>Pagamento de Dízimo</h3>
    <p>Escaneie o QR Code abaixo ou envie o comprovante:</p>
    <h3>Escolha um evento para realizar o pagamento:</h3>

<?php
include '../conexao.php';

$eventos = $conn->query("SELECT * FROM pix_eventos ORDER BY id DESC");

if ($eventos->num_rows > 0): ?>
    <form action="enviar_comprovante.php" method="POST" enctype="multipart/form-data">
        <label for="evento">Evento:</label>
        <select name="evento_id" id="evento" required>
            <option value="">-- Selecione --</option>
            <?php while($ev = $eventos->fetch_assoc()): ?>
                <option value="<?php echo $ev['id']; ?>"><?php echo htmlspecialchars($ev['nome_evento']); ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <div id="imagem_pix"></div>

        <label>Comprovante de pagamento:</label>
        <input type="file" name="comprovante" accept="image/*" required>
        <br><br>

        <button type="submit">Enviar Comprovante</button>
    </form>

    <script>
    document.getElementById("evento").addEventListener("change", function() {
    const id = this.value;
    const container = document.getElementById("imagem_pix");
    container.innerHTML = "";

    if (id) {
        const img = document.createElement("img");
        img.src = "http://localhost/Projeto_Integrador/get_pix_image.php?id=" + id;
        img.style.width = "200px";
        img.style.marginTop = "10px";
        container.appendChild(img);
    }
});

    </script>

<?php else: ?>
  <p style="color:rgb(194, 66, 77);"><strong>⏰ Sem eventos no momento.</strong></p>
<?php endif; ?>


    <!-- <form method="POST" action="enviar_comprovante.php" enctype="multipart/form-data">
      <label>Comprovante de pagamento:</label>
      <input type="file" name="comprovante" accept="image/*" required>
      <input type="submit" value="Enviar Comprovante"> 
    </form> -->
  </div>
</body>
</html>
