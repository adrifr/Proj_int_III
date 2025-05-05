<?php
$host = 'localhost';
$usuario = 'root';        // substitua se estiver diferente
$senha = '';              // preencha com sua senha se tiver
$banco = 'igreja_db';     // nome do banco de dados

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
