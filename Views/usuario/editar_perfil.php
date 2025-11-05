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

$erro = '';
$mensagem = '';

// Processa o formulário
if (isset($_POST['salvar_perfil'])) {
  $nome = trim($_POST['nome']);
  $descricao = trim($_POST['descricao']);

  $stmt = $pdo->prepare("UPDATE perfil SET nome = :nome, descricao = :descricao WHERE email = :email");
  $stmt->execute([
    ':nome' => $nome,
    ':descricao' => $descricao,
    ':email' => $emailLogado
  ]);

  // Atualiza foto se enviada
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $arquivo = $_FILES['foto'];
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $novoNome = uniqid() . "." . $extensao;
    $destino = "../../uploads/" . $novoNome;

    if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
      $stmt = $pdo->prepare("UPDATE perfil SET foto = :foto WHERE email = :email");
      $stmt->execute([
        ':foto' => $novoNome,
        ':email' => $emailLogado
      ]);
    } else {
      $erro = "Erro ao enviar a foto.";
    }
  }

  if (!$erro) {
    $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
    header("Location: perfil.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <link href="https://fonts.googleapis.com/css2?family=Lisu+Bosa:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Lisu Bosa', serif;
      background-color: #1b1b1b;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #fff;
    }

    .container {
      width: 700px;
      background: linear-gradient(180deg, #6d4c41, #8d6e63);
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #fff;
      padding-bottom: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .top-bar a {
      color: #fff;
      text-decoration: none;
    }

    .foto {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-color: #ccc;
      overflow: hidden;
      margin-bottom: 10px;
    }

    .foto img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    input[type="file"] {
      display: none;
    }

    label[for="foto"] {
      color: #fff;
      font-size: 14px;
      text-decoration: underline;
      cursor: pointer;
      margin-bottom: 20px;
      display: inline-block;
    }

    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      border: none;
      outline: none;
      background: #E1D4C2;
      color: #000;
      font-size: 15px;
    }

    textarea {
      height: 100px;
      resize: none;
    }

    .btn {
      margin-top: 20px;
      padding: 10px;
      width: 100%;
      border-radius: 8px;
      border: none;
      background: #E1D4C2;
      color: #000;
      font-weight: bold;
      cursor: pointer;
      font-size: 16px;
    }

    .btn:hover {
      background: #f1e2cf;
    }

    .voltar {
      color: #fff;
      font-size: 14px;
      text-decoration: underline;
    }

    .erro {
      color: #ffdddd;
      margin-top: 10px;
    }

    .mensagem {
      color: #caffc3;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="top-bar">
      <span><strong>Editar Perfil</strong></span>
      <a href="perfil.php" class="voltar">Voltar ao Perfil</a>
    </div>

    <form method="post" enctype="multipart/form-data">
      <div class="foto">
        <img src="../../uploads/<?php echo htmlspecialchars($perfil['foto'] ?? 'default.jpg'); ?>" alt="Foto de perfil" id="preview">
      </div>

      <label for="foto">Alterar Foto</label>
      <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">

      <label>Nome:</label>
      <input type="text" name="nome" value="<?php echo htmlspecialchars($perfil['nome']); ?>">

      <label>Descrição:</label>
      <textarea name="descricao"><?php echo htmlspecialchars($perfil['descricao']); ?></textarea>

      <button type="submit" name="salvar_perfil" class="btn">Salvar Alterações</button>

      <?php if ($erro): ?>
        <p class="erro"><?php echo htmlspecialchars($erro); ?></p>
      <?php endif; ?>

      <?php if ($mensagem): ?>
        <p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
      <?php endif; ?>
    </form>
  </div>

  <script>
    function previewImage(event) {
      const img = document.getElementById('preview');
      img.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
</body>

</html>
