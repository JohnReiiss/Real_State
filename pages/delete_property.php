<?php
require_once '../includes/db.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Validar o ID
    if (!is_numeric($property_id) || $property_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID inválido']);
        exit;
    }

    try {
        $pdo->beginTransaction();
        
        $checkSql = "SELECT id FROM property WHERE id = :id FOR UPDATE";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([':id' => $property_id]);
        
        if ($checkStmt->rowCount() > 0) {
            $deleteSql = "DELETE FROM property WHERE id = :id";
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->execute([':id' => $property_id]);
            
            $pdo->commit();
            echo json_encode([
                'success' => true, 
                'message' => 'Imóvel excluído com sucesso',
                'redirect' => 'dados_usuario.php'  // Adicionado URL de redirecionamento
            ]);
        } else {
            $pdo->commit();
            echo json_encode([
                'success' => false, 
                'message' => 'Imóvel não encontrado',
                'redirect' => 'dados_usuario.php'
            ]);
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode([
            'success' => false, 
            'message' => 'Erro ao excluir o imóvel: ' . $e->getMessage(),
            'redirect' => 'dados_usuario.php'
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'ID do imóvel não especificado',
        'redirect' => 'dados_usuario.php'
    ]);
}