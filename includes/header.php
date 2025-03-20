<?php
session_start();

// Definir fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Definir a saudação
$horaAtual = date('H');

if (isset($_SESSION['user_id'])) {
    if ($horaAtual >= 0 && $horaAtual < 12) {
        $saudacao = "Bom dia";
    } elseif ($horaAtual >= 12 && $horaAtual < 18) {
        $saudacao = "Boa tarde";
    } else {
        $saudacao = "Boa noite";
    }
    $mensagemSaudacao = "$saudacao, " . $_SESSION['user_name'] . "!";
} else {
    $mensagemSaudacao = "Bem-vindo à Imobiliária Nara";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <!-- Link Home -->
                <li>
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-house"></i>
                        <p>Home</p>
                    </a>
                </li>
                <!-- Link Imóveis -->
                <li>
                    <a class="nav-link" href="list_properties.php">
                        <i class="bi bi-building"></i>
                        <p>Imóveis</p>
                    </a>
                </li>
                <!-- Link Adicionar Imóvel -->
                <li>
                    <a class="nav-link" href="add_property.php">
                        <i class="bi bi-building-up"></i>
                        <p>Adicionar Imóvel</p>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Link Logout -->
                    <li class="logout">
                        <a href="logout.php">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                <?php else: ?>
                    <!-- Link Login -->
                    <li>
                        <a class="login" href="login.php">
                            <i class="bi bi-person-circle"></i>
                            <p>Login</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Saudação exibida no cabeçalho -->
        <div class="saudacao">
            <h2><?= $mensagemSaudacao; ?></h2>
        </div>
    </header>
    <script src="../assets/js/script.js"></script>
</body>
</html>
