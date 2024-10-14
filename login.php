
<?php

// Inicia a sessão
session_start();

// Configuração do banco de dados
$host = "127.0.0.1";
$usuario = "root";
$senha = "";
$db = "tabelaavaliacao";

$conn = new mysqli($host, $usuario, $senha, $db);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função de login
function login($nome, $email, $senha) {
    global $conn;

    // Criptografa a senha com MD5
    $hashsenha = md5($senha);

    // Consulta para buscar usuário com nome, email e senha
    $sql = "SELECT id, nome FROM usuarios WHERE nome=? AND email=? AND senha=?";
    $consult = $conn->prepare($sql);

    if (!$consult) {
        die("Erro na consulta: " . $conn->error);
    }

    // Vincula parâmetros à consulta
    $consult->bind_param("sss", $nome, $email, $hashsenha);
    $consult->execute();
    $result = $consult->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Armazena o ID do usuário na sessão
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];

        echo "Login de " . $nome . " bem-sucedido!";
        return true;
    } else {
        echo "Algo Errado, tente novamente.";
        return false;
    }

    $consult->close();
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = $conn->real_escape_string($_POST['usuario']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $_POST['senha']; // Captura a senha sem escapamento, será tratada com MD5

    // Chama a função de login
    if (login($nome, $email, $senha)) {
        // Redireciona após o login
        header('Location: postagens.php');
        exit;
    } else {
        echo "Erro no login!";
    }
}

?>
