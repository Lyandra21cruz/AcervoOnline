<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
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

        .menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .menu a {
            text-decoration: none;
            font-size: 20px;
            color: #fff;
        }

        /* Botão de sair */
        .btn-logout {
            background: #b08b73;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #8c6b55;
        }

        /* Ícone hamburguer */
        .menu-icon {
            width: 28px;
            height: 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
        }

        .menu-icon span {
            display: block;
            height: 4px;
            background: #fff;
            border-radius: 2px;
        }

        /* Menu lateral */
        .side-menu {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #4a2c20;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 60px;
            z-index: 1001;
        }

        .side-menu a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: 0.2s;
        }

        .side-menu a:hover {
            background-color: #8c6b55;
        }

        .side-menu .closebtn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
        }

        /* Fundo escuro atrás do menu */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
            z-index: 1000;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
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
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
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
    </style>
</head>

<body>

    <header>
        <h1>AcervoOnline</h1>
        <div class="menu">
            <a href="carrinho.php">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>

            <div class="menu-icon" onclick="openMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <!-- Fundo escuro -->
    <div id="overlay" class="overlay" onclick="closeMenu()"></div>

    <!-- Menu lateral -->

    <head>

        <!-- Font Awesome Ícones -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <!-- Menu lateral -->
    <div id="sideMenu" class="side-menu">
        <span class="closebtn" onclick="closeMenu()">&times;</span>

        <a href="perfil.php">
            <i class="fa-solid fa-user"></i> Perfil
        </a>

        <a href="configuracoes.php">
            <i class="fa-solid fa-gear"></i> Configurações
        </a>


        <a href="../../index.php">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
    </div>


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
            <div class="genero"><i class="fa-solid fa-heart"></i> Romance</div>
            <div class="genero"><i class="fa-solid fa-ghost"></i> Terror</div>
            <div class="genero"><i class="fa-solid fa-hat-wizard"></i> Fantasia</div>

        </div>
    </div>

    <script>
        function openMenu() {
            document.getElementById("sideMenu").style.width = "250px";
            document.getElementById("overlay").classList.add("active");
        }
        function closeMenu() {
            document.getElementById("sideMenu").style.width = "0";
            document.getElementById("overlay").classList.remove("active");
        }
    </script>

</body>

</html>