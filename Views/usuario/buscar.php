<?php
session_start();
require_once "../usuario/conexao.php";

$termo = isset($_GET['q']) ? trim($_GET['q']) : '';

$resultados = [];
if (!empty($termo)) {
    $sql = "SELECT * FROM livros 
            WHERE titulo LIKE :termo 
            OR autor LIKE :termo 
            OR categoria LIKE :termo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['termo' => "%$termo%"]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>AcervoOnline | Buscar Livros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            color: #f5e6d3;
            background: #2b1d17;
            background-image: linear-gradient(to bottom, #2b1d17 60%, #3d2b22 100%);
            overflow-x: hidden;
        }

        header {
            background-color: #3d2b22;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        header h1 {
            color: #f5e6d3;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .search-bar form {
            display: flex;
            align-items: center;
            background: #f5e6d3;
            border-radius: 30px;
            overflow: hidden;
            border: 2px solid #b08b73;
        }

        .search-bar input {
            padding: 10px 15px;
            border: none;
            outline: none;
            width: 250px;
            font-size: 15px;
            background: transparent;
            color: #4a2c20;
        }

        .search-bar button {
            background-color: #6d4b37;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-bar button:hover {
            background-color: #b08b73;
        }

        .voltar-btn {
            background-color: #b08b73;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.3s;
        }

        .voltar-btn:hover {
            background-color: #8c6b55;
            transform: scale(1.05);
        }

        h2 {
            text-align: center;
            margin: 50px 0 20px;
            font-size: 28px;
            color: #f5e6d3;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
        }

        .livros-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 35px;
            padding: 40px 20px 120px;
        }

        .livro-card {
            background: rgba(245, 230, 211, 0.1);
            border: 1px solid rgba(245,230,211,0.2);
            border-radius: 16px;
            width: 220px;
            text-align: center;
            padding: 15px;
            transition: all 0.4s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4);
            backdrop-filter: blur(8px);
        }

        .livro-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

        .livro-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .livro-card h3 {
            font-size: 17px;
            color: #f5e6d3;
            margin: 10px 0 5px;
        }

        .livro-card p {
            color: #d6bfa6;
            font-size: 14px;
            margin: 2px 0;
        }

        footer {
            background-color: #3d2b22;
            text-align: center;
            color: #f5e6d3;
            padding: 15px;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        /* 🌄 Fundo com ondas inspirado no dashboard */
        .ondas {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 180px;
            background: url("../../img/ondas.svg") repeat-x;
            background-size: cover;
            z-index: -1;
        }

        @media (max-width: 600px) {
            .livro-card {
                width: 160px;
            }
            .search-bar input {
                width: 160px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>AcervoOnline</h1>

        <div class="search-bar">
            <form action="buscar.php" method="GET">
                <input type="text" name="q" placeholder="Buscar livros..." value="<?php echo htmlspecialchars($termo); ?>" required>
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <button class="voltar-btn" onclick="window.location.href='dashboard.php'">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </button>
    </header>

    <h2>
        <?php if ($termo): ?>
            Resultados para "<?php echo htmlspecialchars($termo); ?>"
        <?php else: ?>
            Todos os livros cadastrados
        <?php endif; ?>
    </h2>

    <div class="livros-container">
        <?php if (count($resultados) > 0): ?>
            <?php foreach ($resultados as $livro): ?>
                <?php
                    $imagem = !empty($livro['imagem']) 
                        ? (file_exists("../../uploads/" . $livro['imagem']) 
                            ? "../../uploads/" . $livro['imagem'] 
                            : "../../img/" . $livro['imagem'])
                        : "../../img/default.png";
                ?>
                <div class="livro-card">
                    <img src="<?php echo htmlspecialchars($imagem); ?>" alt="<?php echo htmlspecialchars($livro['titulo']); ?>">
                    <h3><?php echo htmlspecialchars($livro['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($livro['autor']); ?></p>
                    <p><strong><?php echo htmlspecialchars($livro['categoria']); ?></strong></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; font-size:18px; color:#f5e6d3;">Nenhum livro encontrado 😢</p>
        <?php endif; ?>
    </div>

    <div class="ondas"></div>

    <footer>
        © <?php echo date("Y"); ?> AcervoOnline - Todos os direitos reservados.
    </footer>
</body>
</html>
