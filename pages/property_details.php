<?php
include('../includes/db.php');
include('../includes/header.php');

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    $sql = "SELECT * FROM property WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $property_id]);

    $property = $stmt->fetch();

    if ($property) {
?>

        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalhes do Imóvel</title>
            <link rel="stylesheet" href="../assets/css/global.css">
            <link rel="stylesheet" href="../assets/css/property_details.css">
        </head>

        <body>

            <main>
                <h1>Detalhes do Imóvel</h1>

                <!-- Carrossel de Imagens -->
                <div class="property-carousel">
                    <div class="carousel-container">
                        <?php
                        if (isset($property['images']) && !empty($property['images'])) {
                            $images = explode(',', $property['images']); // Alterado para 'images'
                            foreach ($images as $image) {
                                $imagePath = '../uploads/' . $image;
                                if (file_exists($imagePath)) {
                                    echo "<img src='$imagePath' alt='Imagem do Imóvel' class='carousel-image'>";
                                } else {
                                    echo "<p class='image-error'>Imagem não encontrada.</p>";
                                }
                            }
                        } else {
                            echo "<p class='image-error'>Imagens não disponíveis para este imóvel.</p>";
                        }
                        ?>
                    </div>
                    <button class="carousel-prev" onclick="moveSlide(-1)">&#10094;</button>
                    <button class="carousel-next" onclick="moveSlide(1)">&#10095;</button>
                </div>

                <!-- Detalhes do Imóvel -->
                <form action="update_property.php" method="POST" id="propertyForm">
                    <!-- Campo oculto para o ID do imóvel -->
                    <input type="hidden" name="id" value="<?= $property['id'] ?>">

                    <div class="property-details">
                        <div class="details-grid">
                            <!-- Exibição dos detalhes do imóvel -->
                            <div><strong>Tipo:</strong> <span class="editable-field" data-field="type"><?= $property['type'] ?></span></div>
                            <div><strong>Endereço:</strong> <span class="editable-field" data-field="address"><?= $property['address'] ?></span></div>
                            <div><strong>Cidade:</strong> <span class="editable-field" data-field="city"><?= $property['city'] ?></span></div>
                            <div><strong>CEP:</strong> <span class="editable-field" data-field="postal_code"><?= $property['postal_code'] ?></span></div>
                            <div><strong>Bairro:</strong> <span class="editable-field" data-field="neighborhood"><?= $property['neighborhood'] ?></span></div>
                            <div><strong>WhatsApp do proprietário:</strong> <span class="editable-field" data-field="owner_whatsapp"><?= $property['owner_whatsapp'] ?></span></div>
                            <div><strong>Email do proprietário:</strong> <span class="editable-field" data-field="owner_email"><?= $property['owner_email'] ?></span></div>

                            <?php if ($property['property_status'] == 'aluguel'): ?>
                                <div><strong>Aluguel:</strong> R$ <span class="editable-field" data-field="rent_value"><?= number_format($property['rent_value'], 2, ',', '.') ?></span></div>
                            <?php elseif ($property['property_status'] == 'venda'): ?>
                                <div><strong>Valor de Venda:</strong> R$ <span class="editable-field" data-field="sale_value"><?= number_format($property['sale_value'], 2, ',', '.') ?></span></div>
                            <?php endif; ?>

                            <div><strong>Vagas de Garagem:</strong> <span class="editable-field" data-field="garage_spaces"><?= $property['garage_spaces'] ?></span></div>
                            <div><strong>Quartos:</strong> <span class="editable-field" data-field="bedrooms"><?= $property['bedrooms'] ?></span></div>
                            <div><strong>Banheiros:</strong> <span class="editable-field" data-field="bathrooms"><?= $property['bathrooms'] ?></span></div>
                            <div><strong>Área (m²):</strong> <span class="editable-field" data-field="area"><?= $property['area'] ?> m²</span></div>

                            <?php if ($property['condominium'] == 1): ?>
                                <div><strong>Valor do Condomínio:</strong> R$ <span class="editable-field" data-field="condominium_value"><?= number_format($property['condominium_value'], 2, ',', '.') ?></span></div>
                            <?php endif; ?>
                        </div>

                        <!-- Botões de controle -->
                        <div class="buttons-controll">
                            <!-- Ícone de editar (caneta) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square edit-button" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>

                            <!-- Ícone de fechar (X) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg close-button" viewBox="0 0 16 16" style="display: none;">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>

                            <!-- Ícone de salvar (check) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2 check-button" viewBox="0 0 16 16" style="display: none;">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                            </svg>

                            <!-- Ícone de excluir (lixeira) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                            </svg>
                        </div>
                    </div>
                </form>


                <!-- Modal para confirmar a exclusão do imóvel -->
                <dialog class="modal-delete" id="modal-delete">
                    <form id="form-delete">
                        <h1>Você tem certeza que deseja excluir este imóvel?</h1>
                        <div>
                            <button type="submit" id="confirm-delete">Sim</button>
                            <button type="button" class="close-modal" data-modal="modal-delete">Não</button>
                        </div>
                    </form>
                </dialog>


            </main>

            <script>
                let currentSlide = 0;

                function moveSlide(direction) {
                    const slides = document.querySelectorAll('.carousel-image');
                    const totalSlides = slides.length;

                    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
                    const carouselContainer = document.querySelector('.carousel-container');
                    carouselContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
                }
            </script>

    <?php
    } else {
        echo "<p>Imóvel não encontrado.</p>";
    }
} else {
    echo "<p>ID do imóvel não especificado.</p>";
}

include('../includes/footer.php');
    ?>

    <script src="../assets/js/editableField.js"></script>
    <script src="../assets/js/deleteModal.js"></script>
        </body>

        </html>
