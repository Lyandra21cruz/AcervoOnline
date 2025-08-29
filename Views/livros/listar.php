<?php if (!empty($livros) && is_array($livros)): ?>
    <table>
        <?php foreach ($livros as $livro): ?>
            <tr>
                <td><?= $livro['titulo'] ?></td>
                <td><?= $livro['autor'] ?></td>
                <td><?= $livro['sinopse'] ?></td>
                <td>R$ <?= number_format($livro['custo_aluguel'], 2, ',', '.') ?></td>
                <td><?= $livro['tempo_aluguel'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhum livro cadastrado.</p>
<?php endif; ?>
