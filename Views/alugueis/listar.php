<?php
require_once "C:/Turma2/xampp/htdocs/AcervoOnline/config/Database.php";
require_once "C:/Turma2/xampp/htdocs/AcervoOnline/Controllers/AluguelController.php";

$database = new Database();
$db = $database->getConnection();

$AluguelController = new AluguelController($db);

$alugueis = $AluguelController->listarAlugados();
?>


<h2>Livros Alugados</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Data Aluguel</th>
        <th>Data Devolução</th>
        <th>Status</th>
    </tr>

    <?php foreach($alugueis as $aluguel): ?>
    <tr>
        <td><?= $aluguel['id']; ?></td>
        <td><?= $aluguel['titulo']; ?></td>
        <td><?= $aluguel['autor']; ?></td>
        <td><?= $aluguel['data_aluguel']; ?></td>
        <td><?= $aluguel['data_devolucao']; ?></td>
        <td>
            <?php if ($aluguel['status'] == 'ATRASADO'): ?>
                <span style="color: red;">⚠ <?= $aluguel['status']; ?></span>
            <?php elseif ($aluguel['status'] == 'VENCE HOJE'): ?>
                <span style="color: orange;">⚠ <?= $aluguel['status']; ?></span>
            <?php else: ?>
                <span style="color: green;"><?= $aluguel['status']; ?></span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
