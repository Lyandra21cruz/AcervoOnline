<h2>Alugar Livro</h2>

<form method="POST" action="processa_aluguel.php">
    <label>Selecione o Livro:</label>
    <select name="id_livro" required>
        <?php foreach($livros as $livro): ?>
            <option value="<?= $livro['id_livro']; ?>">
                <?= $livro['titulo']; ?> - <?= $livro['autor']; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Dias de empréstimo:</label>
    <input type="number" name="dias_emprestimo" min="1" required><br><br>

    <input type="hidden" name="id_usuario" value="1"> <!-- exemplo -->
    <button type="submit">Confirmar Aluguel</button>
</form>
