<h2>Login</h2>

<?php if (!empty($erro)): ?>
    <p style="color: red;"><?= $erro ?></p>
<?php endif; ?>

<form method="post" action="index.php?pagina=login">
    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required><br>
    
    <label>Senha:</label>
    <input type="password" name="senha" required><br>
    
    <button type="submit">Entrar</button>
</form>

<p><a href="index.php?pagina=cadastro">Cadastre-se</a> | 
<a href="index.php?pagina=recuperar">Esqueci minha senha</a></p>
