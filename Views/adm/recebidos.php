<?php
session_start();

/* Conexão PDO */
$host = 'localhost';
$db   = 'biblioteca';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

/* Receber filtro de busca */
$filtro = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

$sql = "
    SELECT c.id, u.email, c.titulo, c.autor, c.imagem, c.status
    FROM compras c
    JOIN usuarios u ON u.id_usuario = c.id_usuario
";

if ($filtro !== '') {
    $sql .= " WHERE u.email LIKE :filtro OR c.titulo LIKE :filtro";
}

$sql .= " ORDER BY c.id DESC";

$stmt = $conn->prepare($sql);

if ($filtro !== '') {
    $stmt->bindValue(':filtro', "%$filtro%");
}

$stmt->execute();
$compras = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Recebidos</title>
<style>
    body { margin:0; padding:0; font-family:Georgia, serif; background:#e9ddcf; color:#4a342d; }
    .topo { background:#7b4f45; padding:25px; color:white; font-size:28px; text-align:center; font-weight:bold; position:relative; }
    .container { width:90%; max-width:1200px; margin:40px auto; }

    .cabecalho, .item { display:grid; grid-template-columns:2fr 2fr 1fr; align-items:center; padding:15px; }
    .cabecalho { font-weight:bold; background:#6f463d; color:white; border-radius:10px 10px 0 0; }
    .item { background:#fff8f2; margin-top:5px; border-radius:10px; box-shadow:0 4px 14px rgba(0,0,0,0.15); }
    .livro-coluna { display:flex; align-items:center; gap:15px; }
    .livro-coluna img { width:70px; height:90px; object-fit:cover; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,0.25); }
    .status { font-weight:bold; text-align:center; border-radius:6px; padding:4px 6px; }
    .status.pago { background: #4CAF50; color: white; }
    .status.pendente { background: #F44336; color: white; }

    .btn-voltar {
        position:absolute;
        left:20px;
        top:20px;
        width:40px;
        height:40px;
        background:#fff;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        text-decoration:none;
        color:#7b4f45;
        font-weight:bold;
        font-size:24px;
        box-shadow:0 2px 6px rgba(0,0,0,0.25);
        transition:0.2s;
    }
    .btn-voltar:hover { background:#f0f0f0; transform:scale(1.1); }

    .busca-form { margin-bottom:20px; text-align:right; }
    .busca-form input[type="text"] { padding:6px 10px; font-size:16px; border-radius:6px; border:1px solid #ccc; }
    .busca-form button { padding:6px 10px; font-size:16px; border-radius:6px; background:#7b4f45; color:white; border:none; cursor:pointer; }
    .busca-form button:hover { background:#9e6c5a; }
</style>
</head>
<body>

<div class="topo">
    Compras Recebidas
    <a href="adm.php" class="btn-voltar">&#8592;</a>
</div>

<div class="container">
    <!-- Form de busca -->
    <form class="busca-form" method="get">
        <input type="text" name="buscar" placeholder="Buscar por usuário ou livro" value="<?= htmlspecialchars($filtro) ?>">
        <button type="submit">Buscar</button>
    </form>

    <div class="cabecalho">
        <span>Usuário (Email)</span>
        <span>Livro</span>
        <span>Status</span>
    </div>

    <?php if (empty($compras)): ?>
        <div class="item" style="text-align:center; padding:25px;">Nenhuma compra encontrada.</div>
    <?php else: ?>
        <?php foreach($compras as $row): ?>
            <?php
                $status_text = (strtolower($row['status']) === 'pendente') ? 'PENDENTE' : 'PAGO';
                $status_class = ($status_text === 'PAGO') ? 'pago' : 'pendente';
            ?>
            <div class="item">
                <div><?= htmlspecialchars($row['email']); ?></div>
                <div class="livro-coluna">
                    <img src="../../uploads/<?= htmlspecialchars($row['imagem']); ?>" alt="Capa do Livro">
                    <div>
                        <div><?= htmlspecialchars($row['titulo']); ?></div>
                        <div style="font-size:14px; color:#6a574f;"><?= htmlspecialchars($row['autor']); ?></div>
                    </div>
                </div>
                <div class="status <?= $status_class; ?>"><?= $status_text; ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
