<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco");

// Verificação de login de administrador
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Processamento do formulário de registro de ocorrências
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $imagem = $_FILES['imagem']['name'];

    // Upload de imagem
    move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/$imagem");

    // Inserção no banco de dados
    $sql = "INSERT INTO ocorrencias (descricao, imagem) VALUES ('$descricao', '$imagem')";
    mysqli_query($conn, $sql);
}
?>
