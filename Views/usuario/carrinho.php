<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Carrinho de Livros</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    #livros div {
      margin-bottom: 20px;
    }
    #carrinho li {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 8px;
    }
    #carrinho img {
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    #carrinho span {
      flex-grow: 1;
    }
    button {
      cursor: pointer;
      padding: 4px 8px;
      border: none;
      border-radius: 4px;
      background-color: #0077cc;
      color: white;
    }
    button:hover {
      background-color: #005fa3;
    }
  </style>
</head>
<body>
  <h1>Loja de Livros - Aluguel</h1>

  <!-- Lista de livros -->
  <div id="livros">
    <h2>Catálogo</h2>
    <div>
      <img src="https://m.media-amazon.com/images/I/81RrjW4nJzL.jpg" alt="Dom Casmurro" width="80">
      <p><strong>Livro:</strong> Dom Casmurro</p>
      <p><strong>Autor:</strong> Machado de Assis</p>
      <p><strong>Preço/dia:</strong> R$ 2,00</p>
      <label>Período (dias): <input type="number" id="dias1" min="1" value="1"></label>
      <button onclick="adicionarCarrinho('Dom Casmurro', 'Machado de Assis', 2, document.getElementById('dias1').value, 'https://m.media-amazon.com/images/I/81RrjW4nJzL.jpg')">Adicionar</button>
    </div>
    <hr>
    <div>
      <img src="https://m.media-amazon.com/images/I/71pg5WZ8p5L.jpg" alt="A Moreninha" width="80">
      <p><strong>Livro:</strong> A Moreninha</p>
      <p><strong>Autor:</strong> Joaquim Manuel de Macedo</p>
      <p><strong>Preço/dia:</strong> R$ 1,50</p>
      <label>Período (dias): <input type="number" id="dias2" min="1" value="1"></label>
      <button onclick="adicionarCarrinho('A Moreninha', 'Joaquim Manuel de Macedo', 1.5, document.getElementById('dias2').value, 'https://m.media-amazon.com/images/I/71pg5WZ8p5L.jpg')">Adicionar</button>
    </div>
    <hr>
    <div>
      <img src="https://m.media-amazon.com/images/I/81Qb-QlR7HL.jpg" alt="O Cortiço" width="80">
      <p><strong>Livro:</strong> O Cortiço</p>
      <p><strong>Autor:</strong> Aluísio Azevedo</p>
      <p><strong>Preço/dia:</strong> R$ 2,50</p>
      <label>Período (dias): <input type="number" id="dias3" min="1" value="1"></label>
      <button onclick="adicionarCarrinho('O Cortiço', 'Aluísio Azevedo', 2.5, document.getElementById('dias3').value, 'https://m.media-amazon.com/images/I/81Qb-QlR7HL.jpg')">Adicionar</button>
    </div>
  </div>

  <h2>Carrinho</h2>
  <ul id="carrinho"></ul>
  <p><strong>Total:</strong> R$ <span id="total">0.00</span></p>
  <button onclick="finalizarCompra()">Finalizar Compra</button>

  <script>
    let itensCarrinho = [];
    
    function adicionarCarrinho(nome, autor, precoDia, dias, imagem) {
      dias = parseInt(dias);
      const precoTotal = precoDia * dias;
      const item = { nome, autor, precoDia, dias, precoTotal, imagem };
      itensCarrinho.push(item);
      renderizarCarrinho();
    }

    function removerItem(index) {
      itensCarrinho.splice(index, 1);
      renderizarCarrinho();
    }

    function renderizarCarrinho() {
      const lista = document.getElementById("carrinho");
      lista.innerHTML = "";
      let total = 0;
      itensCarrinho.forEach((item, index) => {
        total += item.precoTotal;

        const li = document.createElement("li");

        // Imagem do livro
        const img = document.createElement("img");
        img.src = item.imagem;
        img.alt = item.nome;
        img.width = 50;
        li.appendChild(img);

        // Texto
        const texto = document.createElement("span");
        texto.textContent = `${item.nome} - ${item.autor} | ${item.dias} dias | R$ ${item.precoTotal.toFixed(2)}`;
        li.appendChild(texto);

        // Botão remover
        const btn = document.createElement("button");
        btn.textContent = "Remover";
        btn.onclick = () => removerItem(index);

        li.appendChild(btn);
        lista.appendChild(li);
      });
      document.getElementById("total").textContent = total.toFixed(2);
    }

    function finalizarCompra() {
      if (itensCarrinho.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
      }
      let resumo = "Resumo da Compra:\n";
      itensCarrinho.forEach(item => {
        resumo += `${item.nome} - ${item.dias} dias - R$ ${item.precoTotal.toFixed(2)}\n`;
      });
      resumo += `\nTotal: R$ ${document.getElementById("total").textContent}`;
      alert(resumo);
      itensCarrinho = [];
      renderizarCarrinho();
    }
  </script>
</body>
</html>
