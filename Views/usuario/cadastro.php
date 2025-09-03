<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastrar Usuário</h2>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == "erro") echo "<p style='color:red;'>Erro ao cadastrar. Tente novamente.</p>"; ?>

    <form method="POST" action="cadastro.php">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

    <p>Já tem conta? <a href="login.php">Faça login</a></p>
</body>
</html>
