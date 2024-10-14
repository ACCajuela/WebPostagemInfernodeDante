<?php
session_start(); // Iniciar a sessão

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$host = "127.0.0.1"; // Host do banco de dados
$usuario = "root"; // Usuário do banco de dados
$senha = ""; // Senha do banco de dados
$db = "tabelaavaliacao"; // Nome do banco de dados

$conn = new mysqli($host, $usuario, $senha, $db);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta para buscar todas as fichas de personagens com o nome do usuário
$sql = "SELECT f.*, u.nome AS nome_usuario FROM fichapersonagem f 
        JOIN usuarios u ON f.id_usuario_Ficha = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inferno</title>
    <link rel="icon" href="imagens/iconeInferno.jpg" />
    <link rel="stylesheet" href="postagens.css"> <!-- Caminho para o seu arquivo CSS -->
</head>
<body>

<div class="container-conteudo">
    <div class="cabecalho">
        <h1>Lista de Condenados</h1>
    </div>
    <div class="conteudo-geral">

    <div class="btns">
    <a href="personagem.html" class="btn-criarnovo">Criar novo personagem!</a>

    <a href="logout.php" class="btn-logout">Sair da conta!</a>
    </div>div>
    
    
    <div class="conteudo-postagens">

    

    <?php
    if ($result->num_rows > 0) {
        // Saída de cada linha
        while ($row = $result->fetch_assoc()) {
            echo '<div class="ficha">';
            echo '<h3>' . htmlspecialchars($row['nome_personagem']) . '</h3>';
            echo '<p><strong>Usuário:</strong> ' . htmlspecialchars($row['nome_usuario']) . '</p>';
            echo '<p><strong>História:</strong> ' . nl2br(htmlspecialchars($row['historia'])) . '</p>';
            echo '<p><strong>Classe:</strong> ' . htmlspecialchars($row['classe']) . '</p>';
            echo '<p><strong>Item:</strong> ' . htmlspecialchars($row['item']) . '</p>';
        
            // Vantagens e desvantagens baseadas na classe
            echo '<h4 class="vant">-----Vantagens-----</h4>';
            echo '<ul>';
            
            switch (htmlspecialchars($row['classe'])) {
                case 'Ira':
                    echo '<p><strong>Vida: 50</strong></p>';
                    echo '<p><strong>Vitalidade: 50</strong></p>';
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Astúcia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Obstinação:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    break;
        
                case 'Luxúria':
                    echo '<p><strong>Vida: 50</strong></p>';
                    echo '<p><strong>Vitalidade: 80</strong></p>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    echo '<li><strong>Astúcia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    break;
        
                case 'Avareza':
                    echo '<p><strong>Vida: 50</strong></p>';
                    echo '<p><strong>Vitalidade: 30</strong></p>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    echo '<li><strong>Astucia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    break;

                case 'Gula':
                    echo '<p><strong>Vida: 80</strong></p>';
                    echo '<p><strong>Vitalidade: 50</strong></p>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    echo '<li><strong>Obstinação:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    break;     
                
                case 'Traição':
                    echo '<p><strong>Vida: 50</strong></p>';
                    echo '<p><strong>Vitalidade: 60</strong></p>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    echo '<li><strong>Astúcia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    break;
            
                case 'Heresia':
                    echo '<p><strong>Vida: 40</strong></p>';
                    echo '<p><strong>Vitalidade: 60</strong></p>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    echo '<li><strong>Astúcia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    break;
            
                case 'Violência':
                    echo '<p><strong>Vida: 70</strong></p>';
                    echo '<p><strong>Vitalidade: 30</strong></p>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Astúcia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    break;
    
                case 'Fraude':
                    echo '<p><strong>Vida: 50</strong></p>';
                    echo '<p><strong>Vitalidade: 45</strong></p>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    echo '<li><strong>Astúcia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    echo '<li><strong>Violação:</strong> ' . htmlspecialchars($row['violacao']) . '</li>';
                    break;
                
            }
        
            echo '</ul>';
        
            // Desvantagens
            echo '<h4 class="vant">-----Desvantagens-----</h4>';
            echo '<ul>';
            
            switch (htmlspecialchars($row['classe'])) {
                case 'Ira':
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    echo '<li><strong>Crueldade:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    
                    break;
        
                case 'Luxúria':
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Crueldade:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Obstinação:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    break;
        
                case 'Avareza':
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Crueldade:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    echo '<li><strong>Obstinação:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    break;

                case 'Gula':
                    echo '<li><strong>Crueldade:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Astúcia:</strong> ' . htmlspecialchars($row['astucia']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    break;    
                
                case 'Traição':
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Crueldade:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    echo '<li><strong>Obstinação:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    break;
            
                case 'Heresia':
                    echo '<li><strong>Crueldade:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    echo '<li><strong>Obstinação:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    break;
            
                case 'Violência':
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Presteza:</strong> ' . htmlspecialchars($row['presteza']) . '</li>';
                    echo '<li><strong>Maldição:</strong> ' . htmlspecialchars($row['maldicao']) . '</li>';
                    break;

                case 'Fraude':
                    echo '<li><strong>Auge:</strong> ' . htmlspecialchars($row['auge']) . '</li>';
                    echo '<li><strong>Crueldade:</strong> ' . htmlspecialchars($row['crueldade']) . '</li>';
                    echo '<li><strong>Obstinação:</strong> ' . htmlspecialchars($row['obstinacao']) . '</li>';
                    break;
            }
        
            echo '</ul>';
        
            // Exibir a imagem, se necessário
           
            
            
            echo '</div><hr>'; // Separador entre as fichas
        }
        
    } else {
        echo '<p>Nenhuma ficha encontrada.</p>';
    }
    ?>
</div>

</div>
</div>



</body>
<footer class="rodape">
    <h3>Autores:</h3>
    <p>Alícia Ribeiro</p>
    <p>Ana Cajuela</p>
    <p>Anthenor Fernandes</p>
    <p>Rillory Teodora</p>
    <p>Victor Murta</p>
  </footer>
</html>

<?php
$conn->close();
?>
