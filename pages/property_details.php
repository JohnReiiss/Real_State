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
                <div class="property-details">
                    <div class="details-grid">
                        <div><strong>Tipo:</strong> <?= $property['type'] ?></div>
                        <div><strong>Endereço:</strong> <?= $property['address'] ?></div>
                        <div><strong>Cidade:</strong> <?= $property['city'] ?></div>
                        <div><strong>CEP:</strong> <?= $property['postal_code'] ?></div>
                        <div><strong>Bairro:</strong> <?= $property['neighborhood'] ?></div>
                        <div><strong>WhatsApp do proprietário:</strong> <?= $property['owner_whatsapp'] ?></div>
                        <div><strong>Email do proprietário:</strong> <?= $property['owner_email'] ?></div>

                        <?php if ($property['property_status'] == 'aluguel'): ?>
                            <div><strong>Aluguel:</strong> R$ <?= number_format($property['rent_value'], 2, ',', '.') ?></div>
                        <?php elseif ($property['property_status'] == 'venda'): ?>
                            <div><strong>Valor de Venda:</strong> R$ <?= number_format($property['sale_value'], 2, ',', '.') ?></div>
                        <?php endif; ?>

                        <div><strong>Vagas de Garagem:</strong> <?= $property['garage_spaces'] ?></div>
                        <div><strong>Quartos:</strong> <?= $property['bedrooms'] ?></div>
                        <div><strong>Banheiros:</strong> <?= $property['bathrooms'] ?></div>
                        <div><strong>Área (m²):</strong> <?= $property['area'] ?> m²</div>

                        <!-- Exibição do valor de condomínio se aplicável -->
                        <?php if ($property['condominium'] == 1): ?>
                            <div><strong>Valor do Condomínio:</strong> R$ <?= number_format($property['condominium_value'], 2, ',', '.') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
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

        </body>

        </html>
