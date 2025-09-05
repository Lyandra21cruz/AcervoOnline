<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <!-- Fonte Lisu Bosa -->
  <link href="https://fonts.googleapis.com/css2?family=Lisu+Bosa:wght@400;600;700&display=swap" rel="stylesheet">
  <title>Recuperar Senha</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Arial", sans-serif;
      background: linear-gradient( #3d2d28, #7a5b48, #a18470);
      background-size: 200% 200%;
      animation: gradientMove 8s ease infinite;
      color: #fff;
    }

  
    .wrapper {
      text-align: center;
    }

    .titulo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .titulo img {
      width: 28px;
      height: 28px;
    }

    .titulo h2 {
      font-size: 20px;
      margin: 0;
    }

    .container {
      background: #a18470;
      width: 500px;
      padding: 50px 40px;
      border-radius: 60% 40% 50% 50% / 40% 60% 50% 50%; /* forma orgânica */
      position: relative;
      text-align: center;
      box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.4);
    }

    label {
      display: block;
      text-align: left;
      margin: 10px 0 5px;
      font-size: 13px;
    }

    input {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 12px;
      outline: none;
      margin-bottom: 15px;
      font-size: 14px;
    }

    button {
      margin-top: 15px;
      padding: 12px 35px;
      background: transparent;
      border: none;
      font-size: 17px;
      font-weight: bold;
      color: #fff;
      cursor: pointer;
      text-decoration: underline;
      transition: opacity 0.3s ease;
    }

    button:hover {
      opacity: 0.8;
    }

    .voltar {
      position: absolute;
      top: 12px;
      right: 18px;
    }

    .voltar a {
      text-decoration: none;
      color: #fff;
      font-size: 15px;
    }

    .voltar a:hover {
      text-decoration: underline;
    }

    .erro {
      margin-top: 10px;
      color: #ffdddd;
      font-size: 14px;
      font-weight: bold;
      display: none;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Título fora da bolha -->
    <div class="titulo">
      <img src="" alt="icone">
      <h2>Recuperar senha</h2>
    </div>

    <!-- Bolha -->
    <div class="container">
      <div class="voltar">
        <a href="index.php?pagina=login">Voltar</a>
      </div>
      <form id="formSenha" method="post" action="index.php?pagina=recuperar">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Nova senha:</label>
        <input type="password" id="novaSenha" name="novaSenha" required>

        <label>Confirmar senha:</label>
        <input type="password" id="confirmarSenha" name="confirmarSenha" required>

        <button type="submit">Enviar</button>
        <div class="erro" id="erroMsg">As senhas não coincidem.</div>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById("formSenha");
    const novaSenha = document.getElementById("novaSenha");
    const confirmarSenha = document.getElementById("confirmarSenha");
    const erroMsg = document.getElementById("erroMsg");

    form.addEventListener("submit", function(e) {
      if (novaSenha.value !== confirmarSenha.value) {
        e.preventDefault(); // impede envio
        erroMsg.style.display = "block";
      } else {
        erroMsg.style.display = "none";
      }
    });
  </script>
</body>
</html>
