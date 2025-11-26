<?php
require_once __DIR__ . "/../../config/conexao.php";

$conn = Conexao::conectar();

$sql = "SELECT * FROM livros WHERE categoria = 'terror' ORDER BY id_livro DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Terror - Acervo Online</title>
    <!-- Import do Font Awesome (ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-top: #cbb09b;
            --bg-bottom: #a78772;
            --card-shadow: rgba(0, 0, 0, 0.22);
            --muted: #a58777;
            --title-color: #2f1f1a;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Georgia, serif;
            background: linear-gradient(180deg, #030303ff 0%, #680b0bff 70%);
            color: #d7d0d0ff;
        }

        .wrapper {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 24px;
        }

        p {
            color: #f4e9df;
        }

        h1 {
            font-size: 42px;
            margin: 0 0 8px;
        }

        h2 {
            font-size: 18px;
            font-weight: 400;
            color: #f4e9df;
            margin: 0 0 28px;
        }

        .livros {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 32px;
            justify-items: center;
        }

        .livro {
            text-align: center;
            width: 170px;
        }

        .livro a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .cover {
            width: 150px;
            height: 220px;
            margin: 0 auto 10px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
            transition: transform .3s, box-shadow .3s;
        }

        .cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .livro:hover .cover {
            transform: translateY(-6px);
            box-shadow: 0 16px 28px rgba(0, 0, 0, 0.35);
        }

        .livro h3 {
            font-size: 1rem;
            margin: 6px 0 2px;
            font-weight: 700;
            color: #fff;
        }

        .livro p {
            font-size: 0.85rem;
            margin: 0;
            color: #f0e6db;
        }

        .voltar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #170404ff;
            /* marrom escuro */
            color: #fff;
            /* ícone branco */
            font-size: 22px;
            text-decoration: none;
            margin: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.2s;
        }

        .voltar:hover {
            background-color: #4f0505ff;
            transform: scale(1.1);
        }










       .modal {
    display: none; /* só aparece quando abrir */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6); /* escurece o fundo */
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
    color: #000000ff; /* texto mais visível em branco */
}

.detalhes-info strong {
    font-weight: 700;
    color: #4b2e2e; /* labels em marrom escuro */
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


/* Animação de entrada */
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



    <div class="wrapper">

        <header class="page-header">

            <a href="javascript:history.back()" class="voltar">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="page-title">Terror🕷</h1>
            <p class="page-subtitle">"Apague as luzes e sinta o medo mais profundo."</p>
        </header>
        <br><br><br><br>
        <main>
            <?php if (count($livros) === 0): ?>
                <div class="empty">Nenhum livro encontrado nesta categoria.</div>
            <?php else: ?>
                <div class="livros">
                    <?php foreach ($livros as $livro): ?>
                        <div class="livro">
                            <a href="detalhes.php?id=<?= (int) $livro['id_livro'] ?>">
                                <div class="cover">
                                    <img src="../../uploads/<?= htmlspecialchars($livro['imagem']) ?>"
                                        alt="<?= htmlspecialchars($livro['titulo']) ?>">
                                </div>
                                <h3><?= htmlspecialchars($livro['titulo']) ?></h3>
                                <div class="meta">
                                    <?= htmlspecialchars($livro['autor']) ?>         <?php if (!empty($livro['ano']))
                                                   echo ' (' . htmlspecialchars($livro['ano']) . ')'; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <div id="modal-detalhes" class="modal">
    <div class="modal-content">
        <span class="fechar">&times;</span>
        <div class="modal-body">
            <img id="detalhe-img" src="" alt="">
            <div class="detalhes-info">
                <h2 id="detalhe-titulo"></h2>
                <p><strong>Autor:</strong> <span id="detalhe-autor"></span></p>
                <p><strong>Sinopse:</strong> <span id="detalhe-sinopse"></span></p>
                  <p><strong>Pdf:</strong> <span id="possui_pdf"></span></p>
                <p><strong>Custo:</strong> R$ <span id="detalhe-custo"></span></p>
                <a id="modal-add-cart" class="btn-add" href="#" >
                    <i class="fas fa-shopping-cart"></i> Adicionar ao Carrinho
                </a>
        </div>
    </div>
</div>



<script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("modal-detalhes");
            const fechar = document.querySelector(".fechar");
            const addCartLink = document.getElementById("modal-add-cart");

            document.querySelectorAll(".livro a").forEach(link => {
                link.addEventListener("click", function (e) {
                    e.preventDefault();

                    const livroId = new URL(this.href).searchParams.get("id");

                    fetch("detalhes.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "id=" + encodeURIComponent(livroId)
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.erro) {
                                alert(data.erro);
                                return;
                            }

                            // preencher modal
                            document.getElementById("detalhe-img").src = "../../uploads/" + data.imagem;
                            document.getElementById("detalhe-titulo").innerText = data.titulo;
                            document.getElementById("detalhe-autor").innerText = data.autor;
                            document.getElementById("detalhe-sinopse").innerText = data.sinopse || "Sem sinopse.";
                            document.getElementById("possui_pdf").innerText = data.arquivo_pdf || "Sem pdf.";
                            document.getElementById("detalhe-custo").innerText = data.custo_aluguel || "—";

                            // **ATENÇÃO**: define o href do botão de adicionar ao carrinho com o id correto
                            // use o campo exato que seu detalhes.php retorna (ex: data.id_livro ou data.id)
                            const idParaCarrinho = data.id_livro ?? data.id ?? livroId;
                            addCartLink.href = "adicionar_carrinho.php?id=" + encodeURIComponent(idParaCarrinho);

                            modal.style.display = "flex";
                        })
                        .catch(err => console.error("Erro ao carregar detalhes:", err));
                });
            });

            fechar.addEventListener("click", () => modal.style.display = "none");

            window.addEventListener("click", (e) => {
                if (e.target === modal) modal.style.display = "none";
            });
        });
    
</script>
</body>
</html>