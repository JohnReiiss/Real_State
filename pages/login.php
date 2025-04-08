<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include('../includes/header.php'); ?>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<main class="login-main">
    <div class="login-container">
        <h2>Login</h2>
        <form action="login_process.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-login">Entrar</button>
            </div>
        </form>
        <p>Não tem uma conta? <a href="register.php">Cadastre-se aqui</a></p>
    </div>
</main>

<?php include('../includes/footer.php'); ?>