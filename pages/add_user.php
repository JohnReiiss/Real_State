<?php
include('../includes/db.php');

$email = 'usuario@exemplo.com';
$password = 'senha123';
$name = 'Nome do Usuário';
$role = 'user';

$sql_check_email = "SELECT * FROM users WHERE email = :email";
$stmt_check_email = $pdo->prepare($sql_check_email);
$stmt_check_email->execute([':email' => $email]);
$user = $stmt_check_email->fetch();

if ($user) {
    echo "Erro: O e-mail já está cadastrado. Tente outro e-mail.";
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $hashed_password,
        ':role' => $role
    ]);

    echo "Usuário cadastrado com sucesso!";
}
