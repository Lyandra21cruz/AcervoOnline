<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nome  = $_POST['nome'];
    $senha = $_POST['senha'];

    echo "<h2 style='color:white; text-align:center; margin-top:20px;'>Dados Recebidos:</h2>";
    echo "<div style='color:white; text-align:center;'>
            📧 Email: " . htmlspecialchars($email) . "<br>
            👤 Nome: " . htmlspecialchars($nome) . "<br>
            🔑 Senha: " . htmlspecialchars($senha) . "<br>
          </div>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AcervoOnline</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    
    <!-- Lado esquerdo -->
    <div class="left">
      <img src="cabeçabranca.png" alt="AcervoOnline">
      <h1>AcervoOnline</h1>
    </div>

    <!-- Lado direito -->
    <div class="right">
      <h2>Bem vindo ao AcervoOnline!</h2>
      <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>

        <button type="submit">Enviar</button>
      </form>
    </div>
  </div>
</body>
</html>
