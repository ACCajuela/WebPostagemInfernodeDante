<?php

session_start(); // Iniciar a sessãose

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$host = "127.0.0.1"; // Host do banco de dados
$usuario = "root"; // Usuário do banco de dados
$senha = ""; // Senha do banco de dados
$db = "tabelaavaliacao"; // Nome do banco de dados

$conn = new mysqli($host, $usuario, $senha, $db);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

//resgata o id de usuário
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Pega o ID do usuário logado
    echo "O ID do usuário logado é: " . $user_id;
} else {
    echo "Nenhum usuário está logado.";
}

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $historia = $conn->real_escape_string($_POST['historia']);
    $item = $conn->real_escape_string($_POST['item']);
    $classe = $conn->real_escape_string($_POST['classe']);

        //Vida e vitalidade
        $classes = [
            [
                "nome" => "Avareza",
                "vida" => 50,
                "vitalidade" => 30
            ],
            [
                "nome" => "Fraude",
                "vida" => 50,
                "vitalidade" => 45
            ],
            [
                "nome" => "Gula",
                "vida" => 80,
                "vitalidade" => 50
            ],
            [
                "nome" => "Heresia",
                "vida" => 40,
                "vitalidade" => 80
            ],
            [
                "nome" => "Ira",
                "vida" => 50,
                "vitalidade" => 50
            ],
            [
                "nome" => "Luxúria",
                "vida" => 50,
                "vitalidade" => 80
            ],
            [
                "nome" => "Traição",
                "vida" => 50,
                "vitalidade" => 60
            ],
            [
                "nome" => "Violência",
                "vida" => 70,
                "vitalidade" => 30
            ]
        ];
        
        // Usando foreach para percorrer o array e encontrar a classe
        foreach ($classes as $classeEscolha) {
            if ($classeEscolha["nome"] == $classe) { // Altere "Fraude" pela classe que você quer encontrar
                $vida = $classeEscolha["vida"];
                $vitalidade = $classeEscolha["vitalidade"];
            }
        }

    // Captura a imagem
    $imagem = $_FILES['imagem'];
    $imagens = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));
    
    //$imagemNome = $imagem['name'];
    //$imagemTemp = $imagem['tmp_name'];
    
    // Define o diretório onde as imagens serão salvas
    $diretorioImagens = 'imagens/'; // Certifique-se de que esse diretório existe e tem permissão de escrita

    // Captura os atributos
    $maldicao = $conn->real_escape_string($_POST['Maldição']);
    $astucia = $conn->real_escape_string($_POST['Astúcia']);
    $violacao = $conn->real_escape_string($_POST['Violação']);
    $presteza = $conn->real_escape_string($_POST['Presteza']);
    $auge = $conn->real_escape_string($_POST['Auge']);
    $crueldade = $conn->real_escape_string($_POST['Crueldade']);
    $obstinacao = $conn->real_escape_string($_POST['Obstinação']);

    //Move a imagem para o diretório
    //if (move_uploaded_file($imagemTemp, $diretorioImagens . $imagemNome)) {
        // Se a imagem foi movida com sucesso, insira os dados no banco de dados
        $sql = "INSERT INTO fichapersonagem (id_usuario_ficha, nome_personagem, historia, item, imagem, classe, maldicao, astucia, violacao, presteza, auge, crueldade, obstinacao, vida, vitalidade) 
        VALUES ('$user_id','$nome', '$historia', '$item', '$imagem','$classe', '$maldicao','$astucia','$violacao','$presteza','$auge','$crueldade', '$obstinacao', '$vida', '$vitalidade')";

        if ($conn->query($sql) === TRUE) {
            header('Location: postagens.php'); // Redireciona após sucesso
            exit;
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    /*} else {
        echo "Erro ao fazer upload da imagem.";
    }*/
}

// Fecha a conexão
$conn->close();
?>