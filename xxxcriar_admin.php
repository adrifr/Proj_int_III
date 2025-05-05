<?php
include 'conexao.php';

$email = 'admin@igreja.com';
$senha = password_hash('abc123456', PASSWORD_DEFAULT);
$tipo = 'admin';

$stmt = $conn->prepare("INSERT INTO users (email, senha, tipo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $senha, $tipo);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "✅ Admin criado com sucesso!";
} else {
    echo "❌ Erro ao criar admin.";
}

$stmt->close();
$conn->close();
?>
