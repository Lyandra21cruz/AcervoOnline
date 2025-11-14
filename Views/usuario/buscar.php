<?php
session_start();
require_once "../usuario/conexao.php";

$termo = isset($_GET['q']) ? trim($_GET['q']) : '';

$resultados = [];
if (!empty($termo)) {
    $sql = "SELECT * FROM livros 
            WHERE titulo LIKE :termo 
            OR autor LIKE :termo 
            OR categoria LIKE :termo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['termo' => "%$termo%"]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>AcervoOnline | Buscar Livros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            color: #f5e6d3;
            background: #2b1d17;
            overflow-x: hidden;
        }

        header {
            background-color: #3d2b22;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
        }

        header h1 {
            color: #f5e6d3;
        }

        .search-bar form {
            display: flex;
            align-items: center;
            background: #f5e6d3;
            border-radius: 30px;
            overflow: hidden;
            border: 2px solid #b08b73;
        }

        .search-bar input {
            padding: 10px 15px;
            border: none;
            outline: none;
            width: 250px;
            background: transparent;
            color: #4a2c20;
        }

        .search-bar button {
            background-color: #6d4b37;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }

        .voltar-btn {
            background-color: #b08b73;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
        }

        .livros-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 35px;
            padding: 40px 20px;
        }

        .livro-card {
            background: rgba(245,230,211,0.1);
            border: 1px solid rgba(245,230,211,0.2);
            border-radius: 16px;
            width: 220px;
            text-align: center;
            padding: 15px;
            transition: 0.4s;
            cursor: pointer;
            text-decoration: none;
        }

        .livro-card:hover {
            transform: translateY(-8px);
        }

        .livro-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* ====== MODAL ====== */
      .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-content {
    background: #E1D4C2;
    color: #2f1f1a;
    border-radius: 16px;
    max-width: 950px;
    width: 95%;
    padding: 30px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    animation: fadeIn 0.3s ease-in-out;
}

.modal-body {
    display: flex;
    gap: 30px;
    align-items: flex-start;
}

.modal-body img {
    width: 320px;
    height: 450px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}

.detalhes-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.detalhes-info h2 {
    font-size: 30px;
    font-weight: 800;
    margin: 0;
    color: #3a2323;
}

.detalhes-info h3 {
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 15px 0;
    color: #5a3a2a;
}

.detalhes-info p {
    font-size: 18px;
    line-height: 1.6;
    margin: 6px 0;
    color: #000;
}

.detalhes-info strong {
    font-weight: 700;
    color: #4b2e2e;
}

   .btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #4a2e1e;           /* marrom escuro elegante */
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    border: 2px solid transparent;
}

.btn-add i {
    font-size: 18px;
}

.btn-add:hover {
    background: #6c3f24;          /* tom mais claro no hover */
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.3);
    border-color: #8d5836;        /* destaque suave */
}

.btn-add:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}


@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fechar {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
    align-self: flex-end;
}
    </style>
</head>
<body>

<header>
    <h1>AcervoOnline</h1>

    <div class="search-bar">
        <form action="buscar.php" method="GET">
            <input type="text" name="q" placeholder="Buscar livros..." value="<?php echo htmlspecialchars($termo); ?>" required>
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <button class="voltar-btn" onclick="window.location.href='dashboard.php'">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </button>
</header>

<h2>
    <?php if ($termo): ?>
        Resultados para "<?php echo htmlspecialchars($termo); ?>"
    <?php else: ?>
        Todos os livros cadastrados
    <?php endif; ?>
</h2>

<div class="livros-container">
    <?php if (count($resultados) > 0): ?>
        <?php foreach ($resultados as $livro): ?>
            <?php
                $imagem = !empty($livro['imagem']) 
                    ? "../../uploads/" . $livro['imagem']
                    : "../../img/default.png";
            ?>

            <div class="livro-card open-modal" data-id="<?= $livro['id_livro'] ?>">
                <img src="<?= $imagem ?>" alt="<?= htmlspecialchars($livro['titulo']) ?>">
                <h3><?= htmlspecialchars($livro['titulo']) ?></h3>
                <p><?= htmlspecialchars($livro['autor']) ?></p>
                <p><strong><?= htmlspecialchars($livro['categoria']) ?></strong></p>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center; font-size:18px;">Nenhum livro encontrado 😢</p>
    <?php endif; ?>
</div>

<!-- ============= MODAL COMPLETO ============= -->
<div id="modal-detalhes" class="modal">
    <div class="modal-content">

        <span class="fechar">&times;</span>

        <div class="modal-body">
            <img id="detalhe-img" src="">

            <div class="detalhes-info">
                <h2 id="detalhe-titulo"></h2>
                <h3><strong>Autor:</strong> <span id="detalhe-autor"></span></h3>

                <p><strong>Sinopse:</strong></p>
                <p id="detalhe-sinopse"></p>

                <p><strong>Possui PDF:</strong> <span id="possui_pdf"></span></p>

                <p><strong>Custo Aluguel:</strong> R$ <span id="detalhe-custo"></span></p>

                <a id="modal-add-cart" class="btn-add" href="#" >
                    <i class="fas fa-shopping-cart"></i> Adicionar ao Carrinho
                </a>
            </div>
            </div>
        </div>

    </div>
</div>

<script>
window.onload = () => {

    const modal = document.getElementById("modal-detalhes");
    const fechar = document.querySelector(".fechar");

    document.querySelectorAll(".open-modal").forEach(card => {

        card.addEventListener("click", function () {
            const livroId = this.dataset.id;

            fetch("../livros/detalhes.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + livroId
            })
            .then(r => r.json())
            .then(data => {

                if (data.erro) {
                    alert(data.erro);
                    return;
                }

                const caminhoImg = data.imagem
                    ? "../../uploads/" + data.imagem
                    : "../../img/default.png";

                document.getElementById("detalhe-img").src = caminhoImg;
                document.getElementById("detalhe-titulo").innerText = data.titulo;
                document.getElementById("detalhe-autor").innerText = data.autor;
                document.getElementById("detalhe-sinopse").innerText = data.sinopse;
                document.getElementById("possui_pdf").innerText = data.arquivo_pdf ? "Sim" : "Não";
                document.getElementById("detalhe-custo").innerText = data.custo_aluguel;

                modal.style.display = "flex";
            });
        });
    });

    fechar.onclick = () => modal.style.display = "none";
    
    modal.addEventListener("click", e => {
        if (e.target === modal) modal.style.display = "none";
    });

};
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modal-detalhes");
    const fechar = document.querySelector(".fechar");
    const addCartLink = document.getElementById("modal-add-cart");

    // Quando clicar em um card do carrossel
    document.querySelectorAll(".livro-card").forEach(card => {
        card.addEventListener("click", function () {

            const id = this.getAttribute("data-id");

            fetch("../livros/detalhes.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + encodeURIComponent(id)
            })
            .then(res => res.json())
            .then(data => {

                if (data.erro) {
                    alert(data.erro);
                    return;
                }

                // Preenche modal
                document.getElementById("detalhe-img").src = "../../uploads/" + data.imagem;
                document.getElementById("detalhe-titulo").innerText = data.titulo;
                document.getElementById("detalhe-autor").innerText = data.autor;
                document.getElementById("detalhe-sinopse").innerText = data.sinopse || "Sem sinopse";
                document.getElementById("possui_pdf").innerText = data.arquivo_pdf || "Não possui PDF";
                document.getElementById("detalhe-custo").innerText = data.custo_aluguel || "—";

                // 💥 CORREÇÃO: setar link DO CARRINHO corretamente
                addCartLink.href = "../livros/adicionar_carrinho.php?id=" + encodeURIComponent(data.id_livro);

                modal.style.display = "flex";
            })
            .catch(err => console.error(err));
        });
    });

    // Fechar modal
    fechar.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });

});
</script>

</body>
</html>

