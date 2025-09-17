<?php
$erro = '';

// Processa o POST na própria página
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Aqui você faz sua verificação real no banco
    // Exemplo fictício:
    if ($email !== 'usuario@teste.com' || $senha !== '123456') {
        $erro = 'E-mail ou senha incorretos!';
    } else {
        // Login correto: iniciar sessão e redirecionar se quiser
        session_start();
        $_SESSION['usuario'] = $email;
        // header('Location: dashboard.php'); exit; // só se login correto
    }
}

// Processa o POST na própria página
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $adminCheck = isset($_POST['admin']); // se check-box foi marcado

    if ($adminCheck) {
        // Verificação de admin
        if ($email === "Adm.AcervoOnline@gmail.com" && $senha === "Acervo123Online") {
            $sql = "SELECT * FROM adm WHERE email = :email AND senha = :senha LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['usuario'] = $email;
                $_SESSION['tipo'] = "admin";
                header("Location: adm/adm.php"); // 👉 página de administração
                exit;
            } else {
                $erro = "Credenciais inválidas para administrador.";
            }
        } else {
            $erro = "Email ou senha incorretos para administrador.";
        }
    } else {
        // Login normal de usuários
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
                    $_SESSION['usuario'] = $email;
            $_SESSION['tipo'] = "usuario";
            header("Location: pagina_usuario.php"); // 👉 página padrão de usuário
                    exit;
                } else {
            $erro = "Email ou senha incorretos.";
    }
}
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <!-- Fonte Lisu Bosa -->
  <link href="https://fonts.googleapis.com/css2?family=Lisu+Bosa:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <title>Login</title>

</head>
<body>



 <section class="main-section">
    <div class="left-side">
        <!-- Aqui vai sua imagem ou fundo -->
        <img src="img/cabeçabranca.png" alt="Imagem" class="side-image">
    </div>

    <div class="right-side">
        <div class="blob">
            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="100%" id="blobSvg">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" style="stop-color: rgb(225, 212, 194);"></stop>
                        <stop offset="100%" style="stop-color: rgb(167, 141, 120);"></stop>
                    </linearGradient>
                </defs>
                <path fill="url(#gradient)">
                    <animate attributeName="d" dur="10000ms" repeatCount="indefinite" values="
                        M459.5,296Q441,342,416,384Q391,426,345,446Q299,466,250,465Q201,464,162,436.5Q123,409,79,381.5Q35,354,33.5,302Q32,250,32,197.5Q32,145,70.5,109.5Q109,74,152.5,44.5Q196,15,250.5,12Q305,9,348.5,40.5Q392,72,412.5,117Q433,162,455.5,206Q478,250,459.5,296Z;

                        M471,299Q453,348,418,382.5Q383,417,344,453.5Q305,490,250.5,488Q196,486,145.5,465.5Q95,445,60,401.5Q25,358,19.5,304Q14,250,24,198Q34,146,66.5,103.5Q99,61,147.5,36.5Q196,12,248,21Q300,30,339.5,59.5Q379,89,405.5,125.5Q432,162,460.5,206Q489,250,471,299Z;
                        
                        M455,294.5Q436,339,409,377.5Q382,416,341,442.5Q300,469,250.5,466.5Q201,464,157,443Q113,422,89,380.5Q65,339,48,294.5Q31,250,48.5,206Q66,162,86,115.5Q106,69,151,41Q196,13,247.5,25Q299,37,339,63Q379,89,417.5,120Q456,151,465,200.5Q474,250,455,294.5Z;
                    
   
                        M462.5,303Q470,356,433.5,395.5Q397,435,349,454.5Q301,474,251.5,467Q202,460,160.5,437Q119,414,75,385Q31,356,16,303Q1,250,20.5,199.5Q40,149,79,117Q118,85,158,53.5Q198,22,250.5,19Q303,16,342.5,50Q382,84,426,114Q470,144,462.5,197Q455,250,462.5,303Z;

                        M461.5,300Q458,350,425.5,389.5Q393,429,346.5,448.5Q300,468,252.5,457Q205,446,162.5,429.5Q120,413,76,384Q32,355,33,302.5Q34,250,39.5,200.5Q45,151,78,113.5Q111,76,153.5,44.5Q196,13,247.5,25Q299,37,350,49Q401,61,436.5,102Q472,143,468.5,196.5Q465,250,461.5,300Z;

                         M459.5,296Q441,342,416,384Q391,426,345,446Q299,466,250,465Q201,464,162,436.5Q123,409,79,381.5Q35,354,33.5,302Q32,250,32,197.5Q32,145,70.5,109.5Q109,74,152.5,44.5Q196,15,250.5,12Q305,9,348.5,40.5Q392,72,412.5,117Q433,162,455.5,206Q478,250,459.5,296Z">

                    </animate>
                </path>
            </svg>
        </div>

         <div class="blob">
            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="100%" id="blobSvg">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" style="stop-color: rgb(225, 212, 194);"></stop>
                        <stop offset="100%" style="stop-color: rgb(167, 141, 120);"></stop>
                    </linearGradient>
                </defs>
                <path fill="url(#gradient)">
                    <animate attributeName="d" dur="10000ms" repeatCount="indefinite" values="
                        M459.5,296Q441,342,416,384Q391,426,345,446Q299,466,250,465Q201,464,162,436.5Q123,409,79,381.5Q35,354,33.5,302Q32,250,32,197.5Q32,145,70.5,109.5Q109,74,152.5,44.5Q196,15,250.5,12Q305,9,348.5,40.5Q392,72,412.5,117Q433,162,455.5,206Q478,250,459.5,296Z;

                        M471,299Q453,348,418,382.5Q383,417,344,453.5Q305,490,250.5,488Q196,486,145.5,465.5Q95,445,60,401.5Q25,358,19.5,304Q14,250,24,198Q34,146,66.5,103.5Q99,61,147.5,36.5Q196,12,248,21Q300,30,339.5,59.5Q379,89,405.5,125.5Q432,162,460.5,206Q489,250,471,299Z;
                        
                        M455,294.5Q436,339,409,377.5Q382,416,341,442.5Q300,469,250.5,466.5Q201,464,157,443Q113,422,89,380.5Q65,339,48,294.5Q31,250,48.5,206Q66,162,86,115.5Q106,69,151,41Q196,13,247.5,25Q299,37,339,63Q379,89,417.5,120Q456,151,465,200.5Q474,250,455,294.5Z;
                    
   
                        M462.5,303Q470,356,433.5,395.5Q397,435,349,454.5Q301,474,251.5,467Q202,460,160.5,437Q119,414,75,385Q31,356,16,303Q1,250,20.5,199.5Q40,149,79,117Q118,85,158,53.5Q198,22,250.5,19Q303,16,342.5,50Q382,84,426,114Q470,144,462.5,197Q455,250,462.5,303Z;

                        M461.5,300Q458,350,425.5,389.5Q393,429,346.5,448.5Q300,468,252.5,457Q205,446,162.5,429.5Q120,413,76,384Q32,355,33,302.5Q34,250,39.5,200.5Q45,151,78,113.5Q111,76,153.5,44.5Q196,13,247.5,25Q299,37,350,49Q401,61,436.5,102Q472,143,468.5,196.5Q465,250,461.5,300Z;

                         M459.5,296Q441,342,416,384Q391,426,345,446Q299,466,250,465Q201,464,162,436.5Q123,409,79,381.5Q35,354,33.5,302Q32,250,32,197.5Q32,145,70.5,109.5Q109,74,152.5,44.5Q196,15,250.5,12Q305,9,348.5,40.5Q392,72,412.5,117Q433,162,455.5,206Q478,250,459.5,296Z">

                    </animate>
                </path>
            </svg>
        </div>

 <div class="container">
            <div class="title-recuperar">
                <span>Bem-vindo ao AcervoOnline!</span>
            </div>

            <!-- Aqui aparece a mensagem de erro, dentro da mesma página -->
            <?php if (!empty($erro)): ?>
                <div class="erro"><?= $erro ?></div>
            <?php endif; ?>

            <form id="formLogin" method="post" action="">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

                <label>Senha:</label>
                <input type="password" name="senha" required>

 <!-- Check ADM -->
<div class="check-adm">
  <input type="checkbox" name="adm_check" id="adm_check">
  <label for="adm_check">Entrar como ADM</label>
</div>

                <button type="submit">Entrar</button>
            </form>

            <div class="links-login">
                <a href="index.php?pagina=cadastro">Cadastre-se</a> | 
                <a href="index.php?pagina=recuperar">Esqueci minha senha</a>
            </div>
        </div>
    </div>
</section>
</body>
</html>