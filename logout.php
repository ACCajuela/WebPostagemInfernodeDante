<?php
// Configuração do banco de dados
$host = "127.0.0.1";
$usuario = "root";
$senha = "";
$db = "tabelaavaliacao"; // Nome correto do banco de dados

// Cria a conexão
$conn = new mysqli($host, $usuario, $senha, $db);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {
    echo "Conectado ao banco de dados com sucesso!<br>";
}
session_start(); // Inicia a sessão

// Destruir a sessão do usuário
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destrói a sessão atual

// Verifica se o cookie de login existe e, se sim, apaga-o
if (isset($_COOKIE['nome_cookie'])) {
    // Define o tempo de expiração no passado para apagar o cookie
    setcookie('nome_cookie', '', time() - 3600, '/');
}


// Redireciona para a página de login ou página inicial

echo "Usuário deslogado";
header("Location: home.html");
exit();
?>