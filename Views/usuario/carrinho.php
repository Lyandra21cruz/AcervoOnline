<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>

    <style>
        /* RESET */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #e9ddcf;
            font-family: "Georgia", serif;
            color: #4a342d;
            overflow-x: hidden;
        }

        /* ============================================================
   -------------------- TOPO --------------------
   ============================================================ */
        .topo {
            width: 100%;
            background: linear-gradient(135deg, #7b4f45, #6f463d);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* logo e texto na esquerda / hamburguer na direita */
            padding: 20px 30px;
            border-bottom: 3px solid rgba(0, 0, 0, 0.18);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        /* BLOCO ESQUERDA: LOGO + TEXTO */
        .topo-esquerda {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-carrinho {
            width: 60px;
            /* imagem livre, sem arredondar */
            height: auto;
            border-radius: 0;
        }

        /* Texto “Carrinho de Compras” */
        .carrinho-texto {
            font-size: 26px;
            font-weight: bold;
            letter-spacing: .6px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.35);
        }

        /* --------------- HAMBÚRGUER --------------- */
        .menu-button {
            width: 55px;
            height: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.12);
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: .25s ease;
        }

        .menu-button:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: scale(1.04);
        }

        /* Três linhas */
        .menu-icon {
            width: 34px;
            height: 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .linha {
            width: 100%;
            height: 3px;
            background: white;
            border-radius: 4px;
            transition: .3s ease;
        }

        /* Animação -> vira X */
        .menu-button.ativo .linha1 {
            transform: translateY(9px) rotate(45deg);
        }

        .menu-button.ativo .linha2 {
            opacity: 0;
        }

        .menu-button.ativo .linha3 {
            transform: translateY(-9px) rotate(-45deg);
        }


        /* ============================================================
   -------------------- MENU LATERAL --------------------
   ============================================================ */
        #menu-lateral {
            width: 320px;
            background: #7b4f45;
            position: fixed;
            right: -340px;
            /* abre pela direita */
            top: 0;
            height: 100%;
            padding: 50px 28px;
            display: flex;
            flex-direction: column;
            gap: 26px;
            color: white;
            font-size: 20px;
            transition: right .35s ease;
            z-index: 1000;
            box-shadow: -10px 0 25px rgba(0, 0, 0, .35);
            border-left: 3px solid rgba(0, 0, 0, 0.25);
        }

        #menu-lateral.open {
            right: 0;
        }

        #menu-lateral a {
            color: white;
            text-decoration: none;
            padding: 12px 0;
            font-weight: 600;
            transition: .25s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #menu-lateral a:hover {
            opacity: .85;
            transform: translateX(8px);
        }

        /* fundo escuro ao abrir menu */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            opacity: 0;
            visibility: hidden;
            transition: .35s ease;
            z-index: 998;
        }

        .overlay.show {
            opacity: 1;
            visibility: visible;
        }


        /* ============================================================
   -------------------- CARRINHO --------------------
   ============================================================ */
        .carrinho {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px 80px;
        }

        /* Cabeçalho */
        .cabecalho {
            display: grid;
            grid-template-columns: 2fr 1.2fr 1fr 0.7fr;
            padding: 20px 12px;
            font-weight: bold;
            color: #3d2d27;
            border-bottom: 2px solid #b69e8d;
            font-size: 17px;
            letter-spacing: .5px;
        }

        /* Item */
        .item {
            display: grid;
            grid-template-columns: 2fr 1.2fr 1fr 0.7fr;
            padding: 24px 12px;
            align-items: center;
            margin-top: 18px;
            border-radius: 14px;
            background: #f9f3ee;
            border: 1px solid rgba(121, 94, 77, 0.25);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        }

        /* coluna do livro */
        .livro-coluna {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .livro-coluna img {
            width: 90px;
            height: 125px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .35);
        }

        .titulo {
            font-weight: bold;
            font-size: 19px;
            color: #3c2f2a;
            text-decoration: underline;
        }

        .autor {
            margin-top: 4px;
            font-size: 15px;
            color: #6a574f;
        }

        /* preço */
        .preco {
            font-size: 18px;
            font-weight: bold;
            color: #3c302c;
            text-align: right;
        }

        /* remover */
        .remover {
            color: #a34e4e;
            text-decoration: none;
            font-weight: bold;
        }

        /* botão finalizar */
        .finalizar {
            background: linear-gradient(135deg, #b89480, #a57d69);
            padding: 18px 38px;
            border-radius: 14px;
            color: white;
            font-size: 20px;
            text-align: center;
            width: 300px;
            margin: 55px auto 0;
            display: block;
            text-decoration: none;
            font-weight: bold;
        }


        #menu-lateral a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        #menu-lateral img {
            width: 22px;
            height: 22px;
        }
    </style>
</head>

<body>

    <div class="topo">


        <div class="topo-esquerda">
            <img src="../../img/download (9).png" class="logo-carrinho" alt="logo">
            <span class="carrinho-texto">Carrinho de Compras</span>
        </div>

        <button class="menu-button" id="menuBtn">
            <span class="menu-icon">
                <span class="linha linha1"></span>
                <span class="linha linha2"></span>
                <span class="linha linha3"></span>
            </span>
        </button>

    </div>



    <div class="carrinho">

        <div class="cabecalho">
            <span>Livro</span>
            <span>Autor</span>
            <span>Dia da compra</span>
            <span>Preço</span>
        </div>

        <?php if (empty($_SESSION['carrinho'])): ?>
            <p style="text-align:center; padding:40px; color:#4a342d; font-size:18px;">
                Seu carrinho está vazio.
            </p>
        <?php else: ?>

            <?php foreach ($_SESSION['carrinho'] as $index => $livro): ?>
                <div class="item">

                    <div class="livro-coluna">
                        <img src="../../uploads/<?php echo htmlspecialchars($livro['imagem']); ?>" alt="Capa">
                        <div>
                            <div class="titulo"><?php echo htmlspecialchars($livro['titulo']); ?></div>
                            <div class="autor"><?php echo htmlspecialchars($livro['autor']); ?></div>
                        </div>
                    </div>

                    <div><?php echo htmlspecialchars($livro['autor']); ?></div>

                    <div><?php echo date("d/m/Y"); ?></div>

                    <div class="preco">
                        R$<?php echo number_format($livro['preco'], 2, ',', '.'); ?><br>
                        <a class="remover" href="remover.php?index=<?php echo $index ?>">Remover</a>
                    </div>

                </div>
            <?php endforeach; ?>

            <a href="finalizar.php" class="finalizar">Finalizar a Compra</a>

        <?php endif; ?>
    </div>



    <div id="overlay" class="overlay"></div>


    <nav id="menu-lateral" role="navigation" aria-hidden="true">
        <a href="dashboard.php">
            <img src="data:image/svg+xml;utf8,
        <svg width='20' height='20' viewBox='0 0 24 24' fill='white' xmlns='http://www.w3.org/2000/svg'>
        <path d='M12 3L2 12h3v9h6v-6h2v6h6v-9h3L12 3z'/>
        </svg>" alt="Início">
            Início
        </a>

        <a href="perfil.php">
            <img src="data:image/svg+xml;utf8,
        <svg width='20' height='20' viewBox='0 0 24 24' fill='white' xmlns='http://www.w3.org/2000/svg'>
        <path d='M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z'/>
        </svg>" alt="Perfil">
            Perfil
        </a>

        <a href="../logout.php">
            <img src="data:image/svg+xml;utf8,
        <svg width='20' height='20' viewBox='0 0 24 24' fill='white' xmlns='http://www.w3.org/2000/svg'>
        <path d='M16 13v-2H7V8l-5 4 5 4v-3h9zm3-10H5c-1.1 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z'/>
        </svg>" alt="Sair">
            Sair
        </a>
    </nav>



    <script>
        const btn = document.getElementById("menuBtn");
        const menu = document.getElementById("menu-lateral");
        const overlay = document.getElementById("overlay");

        btn.addEventListener("click", () => {
            menu.classList.toggle("open");
            btn.classList.toggle("ativo");
            overlay.classList.toggle("show");
        });

        overlay.addEventListener("click", () => {
            menu.classList.remove("open");
            btn.classList.remove("ativo");
            overlay.classList.remove("show");
        });
    </script>

</body>

</html>