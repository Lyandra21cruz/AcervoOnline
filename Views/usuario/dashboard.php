<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // se não estiver logado, volta pro login
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcervoOnline - Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9dfd1;
        }
        header {
            background-color: #4a2c20;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-size: 20px;
        }
        .menu-icon {
            font-size: 28px;
            cursor: pointer;
        }
        .banner {
            background: linear-gradient(to bottom, #4a2c20 40%, #e9dfd1 40%);
            padding: 40px 20px;
            text-align: center;
            color: #fff;
            position: relative;
        }
        .banner img {
            width: 80px;
            border-radius: 50%;
        }
        .banner h2 {
            margin: 10px 0 0;
        }
        .section {
            padding: 20px;
        }
        .section h3 {
            margin-bottom: 15px;
            color: #4a2c20;
        }
        .livros {
            display: flex;
            gap: 15px;
            overflow-x: auto;
        }
        .livro {
            flex: 0 0 auto;
            width: 120px;
            text-align: center;
        }
        .livro img {
            width: 100%;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .livro p {
            margin-top: 5px;
            font-size: 14px;
        }
        .generos {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }
        .genero {
            flex: 1;
            background-color: #b08b73;
            color: #fff;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
        }
        .genero:hover {
            background-color: #8c6b55;
        }
        .logout {
            margin: 20px;
            display: block;
            text-align: center;
        }
        .logout a {
            color: #4a2c20;
            text-decoration: none;
            font-weight: bold;
        }
        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>AcervoOnline</h1>
    <div>
        <span style="margin-right:15px;">🛒</span>
        <span class="menu-icon">☰</span>
    </div>
</header>

<div class="banner">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Perfil">
    <h2>Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?>!</h2>
    <p>ID: <?php echo $_SESSION['usuario']['id_usuario']; ?></p>
</div>

<div class="section">
    <h3>Mais lidos da Semana</h3>
    <div class="livros">
        <div class="livro">
            <img src="https://m.media-amazon.com/images/I/81J+Iu6lDkL.jpg" alt="Bridgerton">
            <p>Bridgerton</p>
        </div>
        <div class="livro">
            <img src="https://m.media-amazon.com/images/I/81dHhy+Y5-L.jpg" alt="Nárnia">
            <p>As Crônicas de Nárnia</p>
        </div>
        <div class="livro">
            <img src="https://m.media-amazon.com/images/I/71rJgR1oOXL.jpg" alt="Crepúsculo">
            <p>Saga Crepúsculo</p>
        </div>
        <div class="livro">
            <img src="https://m.media-amazon.com/images/I/81iqZ2HHD-L.jpg" alt="Harry Potter">
            <p>Harry Potter</p>
        </div>
    </div>
</div>

<div class="section">
    <h3>Explorar por gênero</h3>
    <div class="generos">
        <div class="genero">❤️ Romance</div>
        <div class="genero">👻 Terror</div>
        <div class="genero">🧙 Fantasia</div>
    </div>
</div>

<div class="logout">
    <a href="logout.php">Sair</a>
</div>

</body>
</html>
