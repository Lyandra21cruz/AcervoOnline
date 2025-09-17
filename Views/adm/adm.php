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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            color: #fff;
            font-size: max(60px, 4vw);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            text-align: center;
        }

        .header2,
        section {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100vh;
        }

        section {
            background: #E1D4C2;
        }

        .header2 {
            background: #291C0E;
            position: relative;
            overflow: hidden;
        }

        .header2 h1 {
            border: 5px solid white;
            padding: 10px 50px;
            margin: -90px 0 0 0;
        }

        .waves {
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            width: 100%;
        }

        .wave-1 {
            animation: moveWave1 6s ease-in-out infinite alternate;
        }

        @keyframes moveWave1 {
            from {
                transform: translateX(-5%);
            }

            to {
                transform: translateX(15%);
            }
        }

        .wave-2 {
            animation: moveWave2 4s ease-in-out infinite alternate;
        }

        @keyframes moveWave2 {
            from {
                transform: translateX(-10%);
            }

            to {
                transform: translateX(5%);
            }
        }

        .wave-3 {
            animation: moveWave3 3.5s ease-in-out infinite alternate;
        }

        @keyframes moveWave3 {
            from {
                transform: translateX(-15%);
            }

            to {
                transform: translateX(0%);
            }
        }

        .wave-4 {
            animation: moveWave4 2.5s ease-in-out infinite alternate;
        }

        @keyframes moveWave4 {
            from {
                transform: translateX(-3%);
            }

            to {
                transform: translateX(0.05%);
            }
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
            position: absolute;
            /* libera a posição */
            top: 10%;
            /* joga mais para cima (ajuste esse valor) */
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            /* logo em cima, texto embaixo */
            align-items: center;
            text-align: center;
            color: #fff;
        }

        .banner .logo {
            width: 220px;
            /* tamanho da logo */
            height: auto;
            margin-bottom: 15px;
            /* espaço entre logo e texto */
        }

        .section {
            padding: 20px;
            background: #E1D4C2;
        }

        .section h3 {
            margin-bottom: 15px;
            color: #4a2c20;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .logo-container img {
            width: 170px;
            /* ajusta o tamanho da logo */
            height: auto;
            margin-bottom: 90px;
            /* espaço entre logo e o texto */
        }

        .bem-vindo {
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #fff;
            font-weight: bold;
            background: transparent;
        }
    </style>
</head>

<body>

    <header>
        <h1>AcervoOnline</h1>
        <div class="menu">

            <div class="menu-icon" onclick="openMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <header class="header2">


        <div class="banner">
            <img src="../../img/download (12).png" alt="Logo AcervoOnline" class="logo">
            <br>
            <br>
            <br><br>
            <br>
            <br>
            <h1 class="bem-vindo">Bem-vindo, Adm!</h1>

        </div>

        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1240 320">

            <path class="wave-1" fill="#6e473b" fill-opacity="1"
                d="M0,192L30,170.7C60,149,120,107,180,74.7C240,43,300,21,360,37.3C420,53,480,107,540,160C600,213,660,267,720,245.3C780,224,840,128,900,122.7C960,117,1020,203,1080,202.7C1140,203,1200,117,1260,80C1320,43,1380,53,1410,58.7L1440,64L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
            </path>

            <path class="wave-2" fill="#a78d78" fill-opacity="1"
                d="M0,288L34.3,261.3C68.6,235,137,181,206,138.7C274.3,96,343,64,411,85.3C480,107,549,181,617,181.3C685.7,181,754,107,823,74.7C891.4,43,960,53,1029,96C1097.1,139,1166,213,1234,208C1302.9,203,1371,117,1406,74.7L1440,32L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
            </path>

            <path class="wave-3" fill="#beb5a9" fill-opacity="1"
                d="M0,96L34.3,112C68.6,128,137,160,206,192C274.3,224,343,256,411,224C480,192,549,96,617,96C685.7,96,754,192,823,218.7C891.4,245,960,203,1029,186.7C1097.1,171,1166,181,1234,165.3C1302.9,149,1371,107,1406,85.3L1440,64L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
            </path>

            <path class="wave-4" fill="#E1D4C2" fill-opacity="1"
                d="M0,256L40,218.7C80,181,160,107,240,112C320,117,400,203,480,234.7C560,267,640,245,720,224C800,203,880,181,960,165.3C1040,149,1120,139,1200,149.3C1280,160,1360,192,1400,208L1440,224L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
            </path>
        </svg>
    </header>

    <head>

        <!-- Font Awesome Ícones -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <!-- Menu lateral -->
    <div id="sideMenu" class="side-menu">
        <span class="closebtn" onclick="closeMenu()">&times;</span>

        <a href="perfiladm.php">
            <i class="fa-solid fa-user"></i> Perfil
        </a>

        <a href="configuracoes.php">
            <i class="fa-solid fa-gear"></i> Configurações
        </a>


        <a href="../../index.php">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
    </div>

    <div class="section">

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