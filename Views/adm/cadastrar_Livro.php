<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Georgia', serif;
        }

        body {
            background-color: #a68975; /* fundo geral */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #f3e5d7; /* fundo do formulário */
            padding: 40px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }

        .form-container h2 {
            color: #4d2f24;
            margin-bottom: 25px;
            font-size: 1.8rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4d2f24;
            font-size: 1.05rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #a68975;
            color: #fff;
            font-size: 1rem;
        }

        .form-group input[type="file"] {
            background-color: transparent;
            color: #4d2f24;
            font-size: 0.95rem;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #a68975;
            color: #4d2f24;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #8b6b58;
            color: #fff;
        }

        .mensagem {
            margin-top: 15px;
            text-align: center;
            font-size: 1rem;
            font-weight: bold;
        }
        .sucesso { color: green; }
        .erro { color: red; }

        .btn-voltar {
            display: inline-block;
            margin-bottom: 15px;
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            border-bottom: 2px solid #fff;
            padding-bottom: 3px;
            transition: 0.3s;
        }

        .btn-voltar:hover {
            opacity: 0.8;
            color: #4d2f24;
        }
    </style>
</head>
<body>


<div class="form-container">

<a href="adm.php" class="btn-voltar">Voltar</a>

        <h2>Cadastrar Livros</h2>
        <form id="cadastroForm" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="" disabled selected>Selecione uma categoria</option>
                    <option value="romance">Romance</option>
                    <option value="aventura">Aventura</option>
                    <option value="fantasia">Fantasia</option>
                    <option value="biografia">Biografia</option>
                    <option value="terror">Terror</option>
                    <option value="suspense">Suspense</option>
                    <option value="outros">Ficção Cientifica</option>
                    <option value="romance">Religioso</option>
                    <option value="aventura">Infantil</option>
                    <option value="fantasia">Académico</option>
                    <option value="fantasia">Biografia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sinopse">Sinopse</label>
                <textarea id="sinopse" name="sinopse" required></textarea>
            </div>

            <div class="form-group">
                <label for="custo_aluguel">Custo do Aluguel (R$)</label>
                <input type="number" step="0.01" id="custo_aluguel" name="custo_aluguel" required>
            </div>

            <div class="form-group">
                <label for="tempo_aluguel">Tempo de Aluguel (dias)</label>
                <input type="number" id="tempo_aluguel" name="tempo_aluguel" required>
            </div>

            <div class="form-group">
                <label for="imagem">Imagem do Livro (Capa)</label>
                <input type="file" id="imagem" name="imagem" accept="image/*" required>
            </div>

            <button type="submit" class="btn-submit">Cadastrar</button>
        </form>

        <!-- Aqui aparece a mensagem de sucesso ou erro -->
        <div id="mensagem" class="mensagem"></div>
    </div>

    <script>
        document.getElementById("cadastroForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Impede o reload da página

            let formData = new FormData(this);

            fetch("processa_cadastro.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                let msgDiv = document.getElementById("mensagem");
                if (data.includes("sucesso")) {
                    msgDiv.textContent = "✅ Livro cadastrado com sucesso!";
                    msgDiv.className = "mensagem sucesso";
                    document.getElementById("cadastroForm").reset(); // limpa o form
                } else {
                    msgDiv.textContent = "❌ Erro ao cadastrar o livro!";
                    msgDiv.className = "mensagem erro";
                }
            })
            .catch(error => {
                document.getElementById("mensagem").textContent = "⚠️ Erro no envio!";
                document.getElementById("mensagem").className = "mensagem erro";
            });
        });
    </script>
</body>
</html>