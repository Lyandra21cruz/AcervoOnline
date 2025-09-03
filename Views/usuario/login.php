<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == "erro") echo "<p style='color:red;'>Usuário ou senha inválidos!</p>"; ?>
    <?php if(isset($_GET['msg']) && $_GET['msg'] == "sucesso") echo "<p style='color:green;'>Cadastro realizado com sucesso, faça login!</p>"; ?>

    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit" name="entrar">Entrar</button>
    </form>

    <p>Não tem conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
</body>
</html>
