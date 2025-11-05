<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

$emailLogado = $_SESSION['usuario']['email'];

// Conexão com o banco
$host = "localhost";
$dbname = "biblioteca";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erro ao conectar: " . $e->getMessage());
}

// Buscar informações do usuário logado
$stmt = $pdo->prepare("SELECT * FROM perfil WHERE email = :email");
$stmt->execute([':email' => $emailLogado]);
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$perfil) {
  die("Perfil não encontrado.");
}

// Buscar compras do usuário
$stmtCompras = $pdo->prepare("SELECT * FROM compras WHERE email_usuario = :email");
$stmtCompras->execute([':email' => $emailLogado]);
$compras = $stmtCompras->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>
  <link href="https://fonts.googleapis.com/css2?family=Lisu+Bosa:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Lisu Bosa', serif;
      background: linear-gradient(180deg, #4e342e, #8d6e63);
      color: #fff;
      height: 100vh;
      width: 100vw;
      overflow-y: auto;
    }

    .perfil-container {
      width: 100%;
      min-height: 100vh;
      padding: 40px 60px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #fff;
      padding-bottom: 10px;
      margin-bottom: 25px;
    }

    .top-bar-left {
      font-size: 20px;
      font-weight: bold;
    }

    .top-bar-right {
      display: flex;
      align-items: center;
      gap: 20px;
      font-size: 14px;
    }

    .top-bar-right a {
      color: #fff;
      text-decoration: none;
      border-bottom: 1px solid transparent;
      transition: 0.2s;
    }

    .top-bar-right a:hover {
      border-bottom: 1px solid #fff;
    }

    .perfil-content {
      display: flex;
      align-items: flex-start;
      gap: 30px;
      margin-bottom: 40px;
    }

    .foto {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      background-color: #ccc;
      overflow: hidden;
      flex-shrink: 0;
    }

    .foto img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .dados {
      flex: 1;
      max-width: 900px;
    }

    .dados h2 {
      margin: 0;
      font-size: 28px;
      font-weight: 600;
    }

    .email {
      font-size: 15px;
      color: #f0e5e5;
      opacity: 0.9;
      margin-top: 3px;
    }

    .sobre {
      margin-top: 15px;
      font-size: 16px;
      line-height: 1.5;
    }

    .sobre strong {
      display: block;
      margin-bottom: 5px;
      font-size: 18px;
    }

    .compras {
      margin-top: 30px;
      border-top: 1px solid #fff;
      padding-top: 15px;
    }

    .compras strong {
      display: block;
      margin-bottom: 15px;
      font-size: 18px;
    }

    .livros {
      display: flex;
      gap: 25px;
      flex-wrap: wrap;
    }

    .livro {
      text-align: center;
      width: 120px;
    }

    .livro img {
      width: 120px;
      height: 170px;
      border-radius: 5px;
      object-fit: cover;
    }

    .livro p {
      font-size: 13px;
      margin-top: 6px;
      color: #fff;
    }

    @media (max-width: 768px) {
      .perfil-content {
        flex-direction: column;
        align-items: center;
      }

      .dados {
        text-align: center;
      }

      .top-bar {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>

<body>
  <div class="perfil-container">
    <!-- TOPO -->
    <div class="top-bar">
      <div class="top-bar-left">Meu Perfil</div>

      <div class="top-bar-right">
        <a href="dashboard.php">Página Inicial</a>
        <a href="editar_perfil.php">Editar Perfil</a>
      </div>
    </div>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="perfil-content">
      <div class="foto">
        <img src="../../uploads/<?php echo htmlspecialchars($perfil['foto'] ?? 'default.jpg'); ?>" alt="Foto de perfil">
      </div>

      <div class="dados">
        <h2><?php echo htmlspecialchars($perfil['nome'] ?? 'Usuário'); ?></h2>
        <p class="email"><?php echo htmlspecialchars($perfil['email']); ?></p>

        <div class="sobre">
          <strong>Sobre:</strong>
          <p>
            <?php
            echo nl2br(htmlspecialchars($perfil['descricao'] ??
              "Ávida leitora e amante de histórias bem contadas, encontra nos livros uma forma de viajar por mundos e épocas diferentes. Apaixonada por literatura clássica e contemporânea, adora trocar recomendações e descobrir novas obras que despertem reflexões profundas."));
            ?>
          </p>
        </div>
      </div>
    </div>

    <!-- COMPRAS -->
    <div class="compras">
      <strong>Minhas Compras</strong>
      <div class="livros">
        <?php if ($compras && count($compras) > 0): ?>
          <?php foreach ($compras as $livro): ?>
            <div class="livro">
              <img src="../../uploads/<?php echo htmlspecialchars($livro['capa_livro']); ?>" alt="Capa do livro">
              <p><?php echo htmlspecialchars($livro['titulo_livro']); ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Nenhum livro comprado ainda.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

</html>
