<?php
include('../includes/db.php');
include('../includes/header.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>

<body>

    <main class="register-main">
        <div class="register-container">
            <h2>Cadastro</h2>
            <form action="register.php" method="POST" class="register-form">
                <div class="form-group">
                    <label for="name">Nome completo</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-register">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red;'>Erro: E-mail inválido.</p>";
        } else {
            if (isset($pdo) && $pdo !== null) {
                $sql_check_email = "SELECT * FROM users WHERE email = :email";
                $stmt_check_email = $pdo->prepare($sql_check_email);
                $stmt_check_email->execute([':email' => $email]);
                $user = $stmt_check_email->fetch();

                if ($user) {
                    echo "<p style='color:red;'>Erro: O e-mail já está cadastrado. Tente outro e-mail.</p>";
                } else {
                    try {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Fazendo o hash da senha

                        $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, 'corretor')";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([':name' => $name, ':email' => $email, ':password' => $hashed_password]);

                        header("Location: login.php");
                        exit;
                    } catch (PDOException $e) {
                        error_log("Erro ao inserir usuário: " . $e->getMessage()); // Registrar erro no log
                        echo "<p style='color:red;'>Erro ao cadastrar usuário. Tente novamente mais tarde.</p>";
                    }
                }
            } else {
                echo "<p style='color:red;'>Erro: Conexão ao banco de dados não encontrada.</p>";
            }
        }
    }

    include('../includes/footer.php');
    ?>

</body>

</html>