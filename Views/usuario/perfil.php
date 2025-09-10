<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil - AcervoOnline</title>
  <style>
 body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: url("../../img/cabeçabranca3.png") no-repeat center center fixed;
  background-size: 100% auto; /* 🔽 imagem de fundo menor */
  background-color: #000;    /* cor de fundo para preencher espaço vazio */
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  color: #fff;
}


    .container {
      /* 🔽 removi o fundo preto (quadrado escuro) */
      background: transparent; 
      padding: 20px;
      border-radius: 12px;
      width: 350px;
      text-align: center;
      position: relative;
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
  width: 90px;   /* 🔽 tamanho reduzido */
  height: 90px;  /* 🔽 tamanho reduzido */
  border-radius: 50%;
  background: #ccc url('https://www.svgrepo.com/show/382104/account-avatar-profile-user.svg') no-repeat center;
  background-size: 60%;
  margin: 0 auto 10px; /* continua centralizado */
}
    

    .alterar {
      display: block;
      margin: 5px auto 20px;
      color: #fff;
      text-decoration: none;
      border-bottom: 1px solid #fff;
      font-size: 14px;
    }

    label {
      display: block;
      text-align: left;
      margin: 10px 0 5px;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      border: none;
      outline: none;
      background: rgba(255,255,255,0.8); /* fundo claro sem ficar pesado */
      color: #000;
    }

    textarea {
      height: 100px;
      resize: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="top-bar">
      <a href="#">Meus Emprestados</a>
      <a href="#">Voltar</a>
    </div>

    <div class="profile-pic"></div>
    <a href="#" class="alterar">Alterar</a>

    <form>
      <label for="email">Email:</label>
      <input type="email" id="email" placeholder="Digite seu email">

      <label for="nome">Nome:</label>
      <input type="text" id="nome" placeholder="Digite seu nome">

      <label for="descricao">Descrição Pessoal:</label>
      <textarea id="descricao" placeholder="Digite sua descrição"></textarea>
    </form>
  </div>
</body>
</html>
