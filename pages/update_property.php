<?php
include('../includes/db.php');

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];
} else {
    echo json_encode(['success' => false, 'message' => 'ID do imóvel não fornecido']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log('Dados recebidos: ' . print_r($_POST, true));

    if (isset($_POST['type'], $_POST['address'], $_POST['city'], $_POST['postal_code'], $_POST['neighborhood'], $_POST['owner_whatsapp'], $_POST['owner_email'], $_POST['garage_spaces'], $_POST['bedrooms'], $_POST['bathrooms'], $_POST['area'])) {
        $type = $_POST['type'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        $neighborhood = $_POST['neighborhood'];
        $owner_whatsapp = $_POST['owner_whatsapp'];
        $owner_email = $_POST['owner_email'];
        $rent_value = isset($_POST['rent_value']) ? $_POST['rent_value'] : null;
        $sale_value = isset($_POST['sale_value']) ? $_POST['sale_value'] : null;
        $garage_spaces = $_POST['garage_spaces'];
        $bedrooms = $_POST['bedrooms'];
        $bathrooms = $_POST['bathrooms'];
        $area = $_POST['area'];
        $condominium_value = isset($_POST['condominium_value']) ? $_POST['condominium_value'] : null;

        //query de UPDATE
        $sql = "UPDATE property SET
                    type = :type,
                    address = :address,
                    city = :city,
                    postal_code = :postal_code,
                    neighborhood = :neighborhood,
                    owner_whatsapp = :owner_whatsapp,
                    owner_email = :owner_email,
                    rent_value = :rent_value,
                    sale_value = :sale_value,
                    garage_spaces = :garage_spaces,
                    bedrooms = :bedrooms,
                    bathrooms = :bathrooms,
                    area = :area,
                    condominium_value = :condominium_value
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':type' => $type,
            ':address' => $address,
            ':city' => $city,
            ':postal_code' => $postal_code,
            ':neighborhood' => $neighborhood,
            ':owner_whatsapp' => $owner_whatsapp,
            ':owner_email' => $owner_email,
            ':rent_value' => $rent_value,
            ':sale_value' => $sale_value,
            ':garage_spaces' => $garage_spaces,
            ':bedrooms' => $bedrooms,
            ':bathrooms' => $bathrooms,
            ':area' => $area,
            ':condominium_value' => $condominium_value,
            ':id' => $property_id
        ]);

        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados ausentes ou incorretos']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido']);
    exit;
}
