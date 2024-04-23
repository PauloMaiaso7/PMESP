<?php
// Conexão com o banco de dados
$conn = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco");

// Verificação de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta ao banco de dados para verificar as credenciais do usuário
    $query = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login bem-sucedido
        session_start();
        $_SESSION['logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        // Login falhou
        $error = "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policia Militar SP</title>
    <style>
        /* Estilos CSS aqui */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0056b3;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        .police-logo {
            width: 150px;
            height: 150px;
            margin: 20px auto;
            background-image: url('policia-militar-logo.png');
            background-size: cover;
        }

        .login-container {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Policia Militar SP</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Sobre</a></li>
                <li><a href="#">Registro de Ocorrências</a></li>
                <!-- Adicione outras abas conforme necessário -->
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="police-logo"></div>

        <div class="login-container">
            <h2>Login</h2>
            <form action="index.php" method="POST">
                <input type="text" name="username" placeholder="Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    </main>

    <footer>
        <!-- Aqui pode adicionar informações de contato, direitos autorais, etc. -->
    </footer>
</body>
</html>
