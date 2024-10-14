
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
function verificaNome($nome){
    global $conn;


    //verifica se o nome já está sendo utilizado
    $sql = "SELECT id FROM usuarios WHERE nome=?";
    $consult = $conn->prepare($sql);
    if (!$consult) {
        die("Erro na consulta: " . $conn->error);
    }

    $consult->bind_param("s", $nome);
    $consult->execute();
    $consult->store_result();

    return $consult->num_rows>0;

}

function verificaEmail($email){
    global $conn;

    //verifica se o email já foi cadastrado
    $sql = "SELECT id FROM usuarios WHERE email=?";
    $consult = $conn->prepare($sql);
    if (!$consult) {
        die("Erro na consulta: " . $conn->error);
    }

    $consult->bind_param("s", $email);
    $consult->execute();
    $consult->store_result();

    return $consult->num_rows>0;

}


// Função de login
function cadastro($nome, $email, $senha) {
    global $conn;

    // Criptografa a senha com MD5
    $hashsenha = md5($senha);

    // Consulta para inserir o novo usuário
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $consult = $conn->prepare($sql);

    if (!$consult) {
        die("Erro na consulta: " . $conn->error);
    }

    // Vincula parâmetros à consulta
    $consult->bind_param("sss", $nome, $email, $hashsenha);
    
    if ($consult->execute()) {
        echo "Novo usuário inserido com sucesso!";
    } else {
        echo "Erro ao inserir usuário: " . $consult->error;
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
    if (verificaNome($nome)) {
        echo "Nome de Usuário já existente";
    }else if(verificaEmail($email)){
        echo "Email já cadastrado, tente outro";
    }else {
        cadastro($nome, $email, $senha);
        header('Location: personagem.html');
        exit;
    }
}

?>
