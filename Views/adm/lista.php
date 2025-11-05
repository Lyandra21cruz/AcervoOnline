<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias de Livros</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
   body {
  background-color: #E1D4C2;
  font-family: 'Georgia', serif;
  margin: 0;
  padding: 0;
  color: #2b2b2b;
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

.voltar-btn {
  background: none;
  border: 2px solid #fff;
  color: #fff;
  padding: 8px 16px;
  border-radius: 20px;
  cursor: pointer;
  font-size: 0.9em;
  transition: 0.3s;
}

.voltar-btn:hover {
  background-color: #fff;
  color: #a5866c;
}

/* Grid fixo de 5 colunas */
.categorias-container {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 30px;
  justify-items: center;
  padding: 60px 40px;
  max-width: 1600px;
  margin: 0 auto;
}

.genero {
  text-decoration: none;
}

.genero-inner {
  background-color: #a5866c;
  border-radius: 12px;
  width: 200px;
  height: 180px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  color: #fff;
  text-align: center;
}

.genero-inner i {
  font-size: 45px;
  color: #2b2b2b;
  margin-bottom: 10px;
  transition: color 0.3s;
}

.genero-inner span {
  font-size: 1.1em;
  font-weight: bold;
  color: #fff;
}

.genero-inner:hover {
  background-color: #8c6e57;
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.genero-inner:hover i {
  color: #fff;
}

/* Responsivo */
@media (max-width: 1400px) {
  .categorias-container {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 1100px) {
  .categorias-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 800px) {
  .categorias-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 500px) {
  .categorias-container {
    grid-template-columns: 1fr;
  }
}

footer {
  text-align: center;
  padding: 20px;
  font-size: 0.9em;
  color: #6b5b4b;
}

  </style>
</head>
<body>

  <header>
    <h1>Lista de Livros</h1>
    <button class="voltar-btn" onclick="window.history.back()">← Voltar</button>
  </header>

  <div class="categorias-container">

    <a href="../livros/romance.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-heart"></i>
        <span>Romance</span>
      </div>
    </a>

    <a href="../livros/aventura.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-mountain-sun"></i>
        <span>Aventura</span>
      </div>
    </a>

    <a href="../livros/fantasia.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-hat-wizard"></i>
        <span>Fantasia</span>
      </div>
    </a>

    <a href="../livros/biografia.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-book-open-reader"></i>
        <span>Biografia</span>
      </div>
    </a>

    <a href="../livros/terror.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-ghost"></i>
        <span>Terror</span>
      </div>
    </a>

    <a href="../livros/suspense.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-user-secret"></i>
        <span>Suspense</span>
      </div>
    </a>

    <a href="../livros/cientifica.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-rocket"></i>
        <span>Ficção Científica</span>
      </div>
    </a>

    <a href="../livros/religioso.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-church"></i>
        <span>Religioso</span>
      </div>
    </a>

    <a href="../livros/infantil.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-child"></i>
        <span>Infantil</span>
      </div>
    </a>

    <a href="../livros/academico.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Acadêmico</span>
      </div>
    </a>

    <a href="../livros/historia.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-landmark"></i>
        <span>História</span>
      </div>
    </a>

    <a href="../livros/poesia.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-feather"></i>
        <span>Poesia</span>
      </div>
    </a>

    <a href="../livros/classico.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-book-open"></i>
        <span>Clássico</span>
      </div>
    </a>

    <a href="../livros/hq.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-dragon"></i>
        <span>HQ / Mangá</span>
      </div>
    </a>

    <a href="../livros/colecao.php" class="genero">
      <div class="genero-inner">
        <i class="fa-solid fa-layer-group"></i>
        <span>Coleções</span>
      </div>
    </a>

  </div>

</body>
</html>
