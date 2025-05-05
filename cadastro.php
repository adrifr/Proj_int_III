<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Novo Usuário</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body { font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px; }
    .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; color: #4A148C; }
    form input, form select { width: 100%; padding: 10px; margin-top: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
    form button { background: #4A148C; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Cadastro de Novo Membro</h2>
    <form action="processa_cadastro.php" method="POST">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="sobrenome">Sobrenome:</label>
      <input type="text" id="sobrenome" name="sobrenome" required>

      <label for="bairro">Bairro:</label>
      <input type="text" id="bairro" name="bairro" required>

      <label for="rua">Rua:</label>
      <input type="text" id="rua" name="rua" required>

      <label for="numero">Número:</label>
      <input type="text" id="numero" name="numero" required>

      <label for="casa">Casa:</label>
      <input type="text" id="casa" name="casa" required>

      <label for="cep">CEP:</label>
      <input type="text" id="cep" name="cep" required>

      <label for="idade">Idade:</label>
      <input type="number" id="idade" name="idade" required>

      <label for="sexo">Sexo:</label>
      <select id="sexo" name="sexo" required>
        <option value="">Selecione</option>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
        <option value="Outro">Outro</option>
      </select>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required>

      <button type="submit">Cadastrar</button>
    </form>
  </div>
</body>
</html>
