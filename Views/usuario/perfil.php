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
$username = "root"; // seu usuário
$password = "";     // sua senha

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erro ao conectar: " . $e->getMessage());
}

// Inicializa variáveis de erro/mensagem
$erro = '';
$mensagem = '';

// Processa o formulário de atualização do perfil
if (isset($_POST['salvar_perfil'])) {

  // Atualiza nome e descrição
  $nome = trim($_POST['nome']);
  $descricao = trim($_POST['descricao']);

  $stmt = $pdo->prepare("UPDATE perfil SET nome = :nome, descricao = :descricao WHERE email = :email");
  $stmt->execute([
    ':nome' => $nome,
    ':descricao' => $descricao,
    ':email' => $emailLogado
  ]);

  // Atualiza a foto, se enviada
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
    $mensagem = "Perfil atualizado com sucesso!";
    header("Location: perfil.php"); // recarrega a página
    exit;
  }
}

// Buscar informações atualizadas do usuário logado
$stmt = $pdo->prepare("SELECT * FROM perfil WHERE email = :email");
$stmt->execute([':email' => $emailLogado]);
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$perfil) {
  die("Perfil não encontrado.");
}
?>

<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>
  <!DOCTYPE html>
  <html lang="pt-BR">

  <head>
    <meta charset="UTF-8">

    <link href="https://fonts.googleapis.com/css2?family=Lisu+Bosa:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Meu Perfil</title>
    <style>
      body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: url("../../img/cabeçabranca3.png") no-repeat center center fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
      }

      .container {

        padding: 50px;
        border-radius: 12px;
        width: 350px;
        text-align: center;
  
      }

      .top-bar {
        position: absolute;
        top: 10px;
        left: 15px;
        right: 15px;
        display: flex;
        justify-content: space-between;
        font-size: 14px;
      }

      .top-bar a {
        color: #fff;
        text-decoration: none;
        border-bottom: 1px solid #fff;
      }

      .profile-pic {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: #ccc url('https://www.svgrepo.com/show/382104/account-avatar-profile-user.svg') no-repeat center;
        background-size: 60%;
        margin: 30px auto 15px;
        overflow: hidden;
      }

      .profile-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
      }

      input[type="file"] {
        display: none;
      }

      .alterar {
        display: inline-block;
        margin-bottom: 20px;
        color: #fff;
        text-decoration: none;
        border-bottom: 1px solid #fff;
        font-size: 14px;
        cursor: pointer;
      }

      label {
        display: block;
        text-align: left;
        margin: 10px 0 5px;
        font-weight: bold;
        color: #fff;
      }

      input[type="text"],
      input[type="email"],
      textarea {
        width: 100%;
        padding: 10px;
        border-radius: 15px;
        border: none;
        outline: none;
        background: #E1D4C2;
        color: #000;
        font-size: 15px;
      }

      textarea {
        height: 120px;
        resize: none;
      }

      .btn {
        margin-top: 15px;
        padding: 10px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        background: #E1D4C2;
        color: #000;
        font-weight: bold;
        width: 100%;
      }

      .btn:hover {
        background: #E1D4C2;
      }
    </style>
  </head>

<body>
  <div class="container">
    <div class="top-bar">
      <a href="meu_emprestado.php">Meus Emprestados</a>
      <a href="javascript:window.history.back()">Voltar</a>
    </div>

    <!-- Foto -->
    <div class="profile-pic" id="preview">
      <img src="../../uploads/<?php echo htmlspecialchars($perfil['foto'] ?? 'default.jpg'); ?>" alt="Foto">
    </div>
    <label for="foto" class="alterar">Alterar</label>
    <form method="post" enctype="multipart/form-data" id="formPerfil">
      <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">

      <label>Email:</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($perfil['email'] ?? ''); ?>" readonly>

      <label>Nome:</label>
      <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($perfil['nome'] ?? ''); ?>">

      <label>Descrição Pessoal:</label>
      <textarea name="descricao" id="descricao"><?php echo htmlspecialchars($perfil['descricao'] ?? ''); ?></textarea>

      <!-- botão começa escondido -->
      <button type="submit" name="salvar_perfil" id="btnSalvar" class="btn" style="display:none;">
        Salvar Perfil
      </button>
    </form>

    <?php
    if ($erro)
      echo "<p style='color:red;'>$erro</p>";
    if ($mensagem)
      echo "<p style='color:green;'>$mensagem</p>";
    ?>
  </div>

  <script>
    const form = document.getElementById("formPerfil");
    const btnSalvar = document.getElementById("btnSalvar");

    // valores originais
    const originalNome = document.getElementById("nome").value;
    const originalDescricao = document.getElementById("descricao").value;

    // quando muda algo no formulário → mostra botão
    form.addEventListener("input", checkChanges);
    form.addEventListener("change", checkChanges);

    function checkChanges() {
      const nome = document.getElementById("nome").value;
      const descricao = document.getElementById("descricao").value;
      const foto = document.getElementById("foto").files.length > 0;

      if (nome !== originalNome || descricao !== originalDescricao || foto) {
        btnSalvar.style.display = "block"; // mostra botão
      } else {
        btnSalvar.style.display = "none"; // esconde se voltou ao original
      }
    }

    // preview da imagem no círculo
    function previewImage(event) {
      const preview = document.getElementById('preview');
      preview.innerHTML = "";
      const img = document.createElement("img");
      img.src = URL.createObjectURL(event.target.files[0]);
      preview.appendChild(img);
      checkChanges(); // força verificar alterações
    }
  </script>

</body>

</html>

</div>
</body>

</html>