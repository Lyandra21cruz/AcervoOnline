<form method="GET" action="">
    <label>Categoria:</label>
    <select name="categoria">
        <option value="">Todas</option>
        <option value="Romance">Romance</option>
        <option value="Ficção">Ficção</option>
        <option value="História">História</option>
        <option value="Tecnologia">Tecnologia</option>
    </select>

    <label>Preço Máximo:</label>
    <input type="number" step="0.01" name="precoMax">

    <label>Ordenar por:</label>
    <select name="ordenar">
        <option value="recentes">Mais Recentes</option>
        <option value="preco">Menor Preço</option>
    </select>

    <button type="submit">Buscar</button>
</form>

<?php
if ($_GET) {
   require_once __DIR__ . '/../config/conexao.php';
    require_once __DIR__ . '/../Controllers/LivroController.php';

    $controller = new LivroController($db);
    $livros = $controller->buscarLivros($_GET);

    echo "<h2>Resultados:</h2>";
    foreach ($livros as $livro) {
        echo "<div>
                <strong>{$livro['nome']}</strong><br>
                Categoria: {$livro['categoria']}<br>
                Preço: R$ {$livro['custo_aluguel']}<br>
                Dias de empréstimo: {$livro['dias_emprestimo']}<br>
              </div><hr>";
    }
}
?>