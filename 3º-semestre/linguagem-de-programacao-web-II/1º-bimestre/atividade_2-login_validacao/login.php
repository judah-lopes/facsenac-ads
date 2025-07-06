<?php
// Conectando ao bd
$servername = "localhost";
$username = "root";
$password = "Pjgnl123!";
$dbname = "login_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do form
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificando no bd
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // se usuario ok, pagina inicial
        header("Location: pagina_inicial.php");
        exit;
    } else {
        // se usuario não ok, mensagem de erro
        echo "Email ou senha inválidos!";
    }
}

$conn->close();
?>
