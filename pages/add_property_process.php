<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('../includes/db.php');

$user_id = $_SESSION['user_id'];

$checkUserSql = "SELECT COUNT(*) FROM users WHERE id = ?";
$checkUserStmt = $pdo->prepare($checkUserSql);
$checkUserStmt->execute([$user_id]);
$userExists = $checkUserStmt->fetchColumn();

if (!$userExists) {
    die("O usuário não existe na tabela de usuários.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type = $_POST['type'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $neighborhood = $_POST['neighborhood'];
    $owner_whatsapp = $_POST['owner_whatsapp'];
    $owner_email = $_POST['owner_email'];
    $property_status = $_POST['property_status'];
    $garage_spaces = $_POST['garage_spaces'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $area = $_POST['area'];
    $condominium = $_POST['condominium'];

    $rent_value = isset($_POST['rent_value']) && $_POST['rent_value'] !== '' ? $_POST['rent_value'] : NULL;
    $sale_value = isset($_POST['sale_value']) && $_POST['sale_value'] !== '' ? $_POST['sale_value'] : NULL;
    $condominium_value = isset($_POST['condominium_value']) && $_POST['condominium_value'] !== '' ? $_POST['condominium_value'] : NULL;

    // Imagens
    $imageNames = [];
    if (isset($_FILES['property_images']) && !empty($_FILES['property_images']['name'][0])) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        for ($i = 0; $i < count($_FILES['property_images']['name']); $i++) {
            $imageName = $_FILES['property_images']['name'][$i];
            $tempPath = $_FILES['property_images']['tmp_name'][$i];
            $filePath = $uploadDir . basename($imageName);
            if (move_uploaded_file($tempPath, $filePath)) {
                $imageNames[] = $imageName;
            } else {
                echo "Erro ao mover o arquivo: " . $imageName;
            }
        }

        $imagesOrder = isset($_POST['images_order']) ? json_decode($_POST['images_order'], true) : [];
        if (!empty($imagesOrder)) {
            $orderedImageNames = [];
            foreach ($imagesOrder as $imageSrc) {
                $imageName = basename($imageSrc);
                if (in_array($imageName, $imageNames)) {
                    $orderedImageNames[] = $imageName;
                }
            }
            $imageNames = $orderedImageNames;
        }
    }
    
    $imageNamesString = !empty($imageNames) ? implode(',', $imageNames) : NULL;

    $sql = "INSERT INTO property 
            (user_id, type, address, city, postal_code, neighborhood, owner_whatsapp, owner_email, 
            property_status, rent_value, sale_value, garage_spaces, bedrooms, bathrooms, area, condominium, 
            condominium_value, images) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $params = [
        $user_id, $type, $address, $city, $postal_code, $neighborhood, 
        $owner_whatsapp, $owner_email, $property_status, $rent_value, 
        $sale_value, $garage_spaces, $bedrooms, $bathrooms, $area, $condominium, 
        $condominium_value, $imageNamesString
    ];

    echo 'Parâmetros: ';
    var_dump($params);
    
    try {
        $stmt->execute($params);
        header("Location: list_properties.php");
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao inserir imóvel: ' . $e->getMessage();
    }
}
?>