<?php
// Início do arquivo index.php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Igreja - Página Inicial</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f0f0f0; }
    header { background: #159A9C; color: white; padding: 20px; text-align: center; }
    nav { background: #002333; padding: 10px; text-align: right; }
    nav a { color: white; margin-left: 15px; text-decoration: none; font-weight: bold; }
    .container { padding: 20px; max-width: 800px; margin: auto; }
    .blog-post { background: white; padding: 15px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
    .blog-post img { max-width: 100%; height: auto; border-radius: 5px; }
    .login-form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
    .login-form input { width: 100%; padding: 10px; margin-top: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
    .login-form button { background: #002333; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    .login-form a { display: block; text-align: right; margin-top: 10px; text-decoration: none; color: #159A9C; }
    .miniatura-blog img {
  max-width: 300px;
  height: auto;
  border-radius: 5px;
  display: block;
  margin-bottom: 10px;
}

  </style>
</head>
<body>
  <header>
    <h1>Bem-vindo à Igreja</h1>
  </header>

  <nav>
    <a href="#login">Login</a>
    <a href="cadastro.php">Cadastro</a>
  </nav>

  <div class="container">
    <h2>Últimos Posts do Blog</h2>

    <?php
$sql = "SELECT * FROM blog ORDER BY data_postagem DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0): ?>
    <div class="blog-container">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="blog-post">
                <h2><?php echo htmlspecialchars($row['titulo']); ?></h2>

                <?php if (!empty($row['imagem_url'])): ?>
                  <img class="miniatura-blog" src="<?php echo htmlspecialchars($row['imagem_url']); ?>" alt="Imagem do post">

                <?php endif; ?>

                <?php
                // Gerar resumo automático com 200 caracteres
                $resumo = substr(strip_tags($row['conteudo']), 0, 200);
                if (strlen($row['conteudo']) > 200) {
                    $resumo .= '...';
                }
                ?>

                <p><?php echo nl2br(htmlspecialchars($resumo)); ?></p>

                <a href="blog.php?id=<?php echo $row['id']; ?>" style="color: #6A1B9A; text-decoration: underline;">Leia mais</a>

                <p><em>Publicado em: <?php echo date('d/m/Y H:i', strtotime($row['data_postagem'])); ?></em></p>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>Nenhuma postagem disponível.</p>
<?php endif;
$conn->close();
?>


    <!-- Login -->
    <h2 id="login">Login</h2>
    <form class="login-form" action="login.php" method="POST">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" required>

      <button type="submit">Entrar</button>

      <a href="cadastro.php">Novo por aqui? Cadastre-se</a>
    </form>
  </div>
</body>
</html>
