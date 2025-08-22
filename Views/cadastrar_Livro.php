<form method="POST" action="processa_cadastro.php">
    <label>Nome do Livro:</label>
    <input type="text" name="nome" required><br>

    <label>Categoria:</label>
    <select name="categoria" required>
        <option value="Romance">Romance</option>
        <option value="Ficção">Ficção</option>
        <option value="História">História</option>
        <option value="Tecnologia">Tecnologia</option>
    </select><br>

    <label>Custo do Aluguel (R$):</label>
    <input type="number" step="0.01" name="custo_aluguel" required><br>

    <label>Dias de Empréstimo:</label>
    <input type="number" name="dias_emprestimo" required><br>

    <button type="submit">Cadastrar</button>
</form>