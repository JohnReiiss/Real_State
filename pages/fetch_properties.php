<?php
include('../includes/db.php');

$search = isset($_POST['search']) ? trim($_POST['search']) : '';

$sql = "SELECT * FROM property WHERE 
        city LIKE ? OR 
        address LIKE ? OR 
        neighborhood LIKE ? OR 
        property_status LIKE ? OR 
        postal_code LIKE ? OR 
        type LIKE ?
        ORDER BY created_at DESC LIMIT 10";

$stmt = $pdo->prepare($sql);
$searchParam = "%$search%";
$stmt->execute([$searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam]);

$properties = $stmt->fetchAll();

$response = [];

foreach ($properties as $property) {
    $images = explode(',', $property['images']);
    $mainImagePath = '../uploads/' . $images[0];

    $response[] = [
        'id' => $property['id'],
        'type' => $property['type'],
        'address' => $property['address'],
        'price' => $property['property_status'] == 'aluguel' 
            ? 'R$ ' . number_format($property['rent_value'], 2, ',', '.') 
            : 'R$ ' . number_format($property['sale_value'], 2, ',', '.'),
        'image' => file_exists($mainImagePath) ? $mainImagePath : 'Imagem não encontrada'
    ];
}

echo json_encode($response);
?>
