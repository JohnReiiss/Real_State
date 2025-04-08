<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

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
                <li>
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-house"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="list_properties.php">
                        <i class="bi bi-building"></i>
                        <p>Imóveis</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="add_property.php">
                        <i class="bi bi-building-up"></i>
                        <p>Adicionar Imóvel</p>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="logout">
                        <a href="logout.php">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="login" href="login.php">
                            <i class="bi bi-person-circle"></i>
                            <p>Login</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="saudacao" id="saudacao">
            <a href="dados_usuario.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0" />
                </svg>
                <h2><?= $mensagemSaudacao; ?></h2>
            </a>
        </div>

    </header>
    <script src="../assets/js/script.js"></script>
</body>

</html>