<form action="processa_cadastro.php" method="POST" enctype="multipart/form-data">
    <label>Título:</label>
    <input type="text" name="titulo" required><br>

    <label>Autor:</label>
    <input type="text" name="autor" required><br>

    <label>Sinopse:</label>
    <textarea name="sinopse" required></textarea><br>

    <label>Custo do Aluguel:</label>
    <input type="number" step="0.01" name="custo_aluguel" required><br>

    <label>Tempo de Aluguel (dias):</label>
    <input type="number" name="tempo_aluguel" required><br>

    <label>Imagem do Livro:</label>
    <input type="file" name="imagem" accept="image/*" required><br>

    <button type="submit">Cadastrar</button>
</form>
