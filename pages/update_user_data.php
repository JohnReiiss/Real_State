<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = $_POST['action'];

    switch ($action) {
        case 'update_username':
            $currentUsername = $_POST['current_username'];
            $newUsername = $_POST['new_username'];

            $sql = "SELECT * FROM users WHERE name = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$newUsername]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => false, 'message' => 'Nome de usuário já está em uso.']);
            } else {
                $updateSql = "UPDATE users SET name = ? WHERE name = ?";
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->execute([$newUsername, $currentUsername]);

                $_SESSION['user_name'] = $newUsername;

                echo json_encode(['success' => true, 'message' => 'Nome de usuário atualizado com sucesso!']);
            }
            break;

        case 'update_email':
            $currentEmail = $_POST['current_email'];
            $newEmail = $_POST['new_email'];

            $emailCheckSql = "SELECT * FROM users WHERE email = ?";
            $emailCheckStmt = $pdo->prepare($emailCheckSql);
            $emailCheckStmt->execute([$newEmail]);

            if ($emailCheckStmt->rowCount() > 0) {
                echo json_encode(['success' => false, 'message' => 'E-mail já está em uso.']);
            } else {
                $updateEmailSql = "UPDATE users SET email = ? WHERE email = ?";
                $updateEmailStmt = $pdo->prepare($updateEmailSql);
                $updateEmailStmt->execute([$newEmail, $currentEmail]);

                $_SESSION['user_email'] = $newEmail;

                echo json_encode(['success' => true, 'message' => 'E-mail atualizado com sucesso!']);
            }
            break;

        case 'update_password':
            session_start();
            $userId = $_SESSION['user_id'];

            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];

            $query = "SELECT password FROM users WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
                exit;
            }

            if (!password_verify($currentPassword, $user['password'])) {
                echo json_encode(['success' => false, 'message' => 'Senha atual incorreta.']);
                exit;
            }

            $updatePasswordSql = "UPDATE users SET password = ? WHERE id = ?";
            $updatePasswordStmt = $pdo->prepare($updatePasswordSql);
            $updatePasswordStmt->execute([password_hash($newPassword, PASSWORD_DEFAULT), $userId]);

            echo json_encode(['success' => true, 'message' => 'Senha alterada com sucesso!']);
            break;
    }
}
