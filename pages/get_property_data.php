<?php
include('../includes/db.php');

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    $query = $pdo->prepare("SELECT * FROM property WHERE id = :id");
    $query->bindParam(':id', $property_id, PDO::PARAM_INT);
    $query->execute();
    $property = $query->fetch(PDO::FETCH_ASSOC);

    if ($property) {
        echo json_encode($property);
    } else {
        echo json_encode(['error' => 'Imóvel não encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID do imóvel não informado']);
}
?>
