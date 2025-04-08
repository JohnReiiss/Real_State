<?php
include('../includes/db.php');
include('../includes/header.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Imobiliária Nara - Encontre os melhores imóveis para compra e venda.">
    <title>Imobiliária Nara - Encontre seu imóvel</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/list_properties.css">
    <link rel="stylesheet" href="../assets/css/button_filters.css">
</head>

<body>
    <section class="search-section">
        <div class="container">
            <div class="search-container">
                <div class="filters">
                    <button class="filter-button" data-filter="aluguel" onclick="filterProperties('aluguel')">
                        <i class="bi bi-cash-stack"></i> Aluguel
                    </button>
                    <button class="filter-button" data-filter="venda" onclick="filterProperties('venda')">
                        <i class="bi bi-wallet2"></i> Venda
                    </button>
                    <button class="filter-button" data-filter="apartamento" onclick="filterProperties('apartamento')">
                        <i class="bi bi-buildings"></i> Apartamento
                    </button>
                    <button class="filter-button" data-filter="casa" onclick="filterProperties('casa')">
                        <i class="bi bi-houses"></i> Casa
                    </button>
                    <button class="filter-button" data-filter="cobertura" onclick="filterProperties('cobertura')">
                        <i class="bi bi-building-fill"></i> Cobertura
                    </button>
                </div>
            </div>
        </div>
    </section>


    <?php
    include('../includes/db.php');
    ?>

    <section class="property-section" data-type="imoveis adicionados recentemente">
        <div class="container">
            <h2>Imóveis Adicionados Recentemente</h2>
            <div class="recent-properties-carousel">
                <?php
                $sql = "SELECT * FROM property ORDER BY created_at DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $recent_properties = $stmt->fetchAll();

                if ($recent_properties):
                    foreach ($recent_properties as $property): ?>
                        <div class="property-item">
                            <?php
                            if (isset($property['images']) && !empty($property['images'])) {
                                $images = explode(',', $property['images']);
                                $mainImagePath = '../uploads/' . $images[0];
                                if (file_exists($mainImagePath)): ?>
                                    <img src="<?php echo $mainImagePath; ?>" alt="Imagem do Imóvel" class="property-image-main">
                                <?php else: ?>
                                    <p class="image-error">Imagem não encontrada.</p>
                            <?php endif;
                            } else {
                                echo '<p class="image-error">Imagem não disponível.</p>';
                            }
                            ?>
                            <h3><?php echo htmlspecialchars($property['type']); ?></h3>
                            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($property['address']); ?></p>
                            <p><strong>Preço:</strong>
                                <?php
                                if ($property['property_status'] == 'aluguel') {
                                    echo 'R$ ' . number_format($property['rent_value'], 2, ',', '.');
                                } elseif ($property['property_status'] == 'venda') {
                                    echo 'R$ ' . number_format($property['sale_value'], 2, ',', '.');
                                }
                                ?>
                            </p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p>Não há imóveis adicionados recentemente.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="property-section" data-type="aluguel">
        <div class="container">
            <h2>Imóveis para Alugar</h2>
            <div class="rent-properties-carousel">
                <?php
                $sql_rent = "SELECT * FROM property WHERE property_status = 'aluguel' ORDER BY created_at DESC";
                $stmt_rent = $pdo->prepare($sql_rent);
                $stmt_rent->execute();
                $rent_properties = $stmt_rent->fetchAll();

                if ($rent_properties):
                    foreach ($rent_properties as $property): ?>
                        <div class="property-item">
                            <?php
                            if (isset($property['images']) && !empty($property['images'])) {
                                $images = explode(',', $property['images']);
                                $mainImagePath = '../uploads/' . $images[0];
                                if (file_exists($mainImagePath)): ?>
                                    <img src="<?php echo $mainImagePath; ?>" alt="Imagem do Imóvel" class="property-image-main">
                                <?php else: ?>
                                    <p class="image-error">Imagem não encontrada.</p>
                            <?php endif;
                            } else {
                                echo '<p class="image-error">Imagem não disponível.</p>';
                            }
                            ?>
                            <h3><?php echo htmlspecialchars($property['type']); ?></h3>
                            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($property['address']); ?></p>
                            <p><strong>Preço:</strong>
                                <?php echo 'R$ ' . number_format($property['rent_value'], 2, ',', '.'); ?>
                            </p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p>Não há imóveis para alugar no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="property-section" data-type="venda">
        <div class="container">
            <h2>Imóveis à Venda</h2>
            <div class="sale-properties-carousel">
                <?php
                $sql_sale = "SELECT * FROM property WHERE property_status = 'venda' ORDER BY created_at DESC";
                $stmt_sale = $pdo->prepare($sql_sale);
                $stmt_sale->execute();
                $sale_properties = $stmt_sale->fetchAll();

                if ($sale_properties):
                    foreach ($sale_properties as $property): ?>
                        <div class="property-item">
                            <?php
                            if (isset($property['images']) && !empty($property['images'])) {
                                $images = explode(',', $property['images']);
                                $mainImagePath = '../uploads/' . $images[0];
                                if (file_exists($mainImagePath)): ?>
                                    <img src="<?php echo $mainImagePath; ?>" alt="Imagem do Imóvel" class="property-image-main">
                                <?php else: ?>
                                    <p class="image-error">Imagem não encontrada.</p>
                            <?php endif;
                            } else {
                                echo '<p class="image-error">Imagem não disponível.</p>';
                            }
                            ?>
                            <h3><?php echo htmlspecialchars($property['type']); ?></h3>
                            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($property['address']); ?></p>
                            <p><strong>Preço:</strong>
                                <?php echo 'R$ ' . number_format($property['sale_value'], 2, ',', '.'); ?>
                            </p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p>Não há imóveis à venda no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $sql_apartment = "SELECT * FROM property WHERE type = 'Apartamento' ORDER BY created_at DESC LIMIT 5";
    $stmt_apartment = $pdo->prepare($sql_apartment);
    $stmt_apartment->execute();
    $apartment_properties = $stmt_apartment->fetchAll();
    ?>

    <section class="property-section" data-type="apartamento">
        <div class="container">
            <h2>Apartamentos</h2>

            <div class="apartment-properties-carousel">
                <?php if ($apartment_properties): ?>
                    <?php foreach ($apartment_properties as $property): ?>
                        <div class="property-item">
                            <?php
                            $images = explode(',', $property['images']);
                            $mainImagePath = '../uploads/' . $images[0];
                            if (file_exists($mainImagePath)): ?>
                                <img src="<?php echo $mainImagePath; ?>" alt="Imagem do Imóvel" class="property-image-main">
                            <?php else: ?>
                                <p class="image-error">Imagem não encontrada.</p>
                            <?php endif; ?>

                            <h3><?php echo htmlspecialchars($property['type']); ?></h3>
                            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($property['address']); ?></p>
                            <p><strong>Preço:</strong>
                                <?php
                                if ($property['property_status'] == 'aluguel') {
                                    echo 'R$ ' . number_format($property['rent_value'], 2, ',', '.');
                                } elseif ($property['property_status'] == 'venda') {
                                    echo 'R$ ' . number_format($property['sale_value'], 2, ',', '.');
                                }
                                ?>
                            </p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Não há apartamentos disponíveis no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $sql_house = "SELECT * FROM property WHERE type = 'Casa' ORDER BY created_at DESC LIMIT 5";
    $stmt_house = $pdo->prepare($sql_house);
    $stmt_house->execute();
    $house_properties = $stmt_house->fetchAll();
    ?>

    <section class="property-section" data-type="casa">
        <div class="container">
            <h2>Casas</h2>

            <div class="house-properties-carousel">
                <?php if ($house_properties): ?>
                    <?php foreach ($house_properties as $property): ?>
                        <div class="property-item">
                            <?php
                            $images = explode(',', $property['images']);
                            $mainImagePath = '../uploads/' . $images[0];
                            if (file_exists($mainImagePath)): ?>
                                <img src="<?php echo $mainImagePath; ?>" alt="Imagem do Imóvel" class="property-image-main">
                            <?php else: ?>
                                <p class="image-error">Imagem não encontrada.</p>
                            <?php endif; ?>

                            <h3><?php echo htmlspecialchars($property['type']); ?></h3>
                            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($property['address']); ?></p>
                            <p><strong>Preço:</strong>
                                <?php
                                if ($property['property_status'] == 'aluguel') {
                                    echo 'R$ ' . number_format($property['rent_value'], 2, ',', '.');
                                } elseif ($property['property_status'] == 'venda') {
                                    echo 'R$ ' . number_format($property['sale_value'], 2, ',', '.');
                                }
                                ?>
                            </p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Não há casas disponíveis no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $sql_cover = "SELECT * FROM property WHERE type = 'Cobertura' ORDER BY created_at DESC LIMIT 5";
    $stmt_cover = $pdo->prepare($sql_cover);
    $stmt_cover->execute();
    $cover_properties = $stmt_cover->fetchAll();
    ?>

    <section class="property-section" data-type="cobertura">
        <div class="container">
            <h2>Coberturas</h2>

            <div class="cover-properties-carousel">
                <?php if ($cover_properties): ?>
                    <?php foreach ($cover_properties as $property): ?>
                        <div class="property-item">
                            <?php
                            $images = explode(',', $property['images']);
                            $mainImagePath = '../uploads/' . $images[0];
                            if (file_exists($mainImagePath)): ?>
                                <img src="<?php echo $mainImagePath; ?>" alt="Imagem do Imóvel" class="property-image-main">
                            <?php else: ?>
                                <p class="image-error">Imagem não encontrada.</p>
                            <?php endif; ?>

                            <h3><?php echo htmlspecialchars($property['type']); ?></h3>
                            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($property['address']); ?></p>
                            <p><strong>Preço:</strong>
                                <?php
                                if ($property['property_status'] == 'aluguel') {
                                    echo 'R$ ' . number_format($property['rent_value'], 2, ',', '.');
                                } elseif ($property['property_status'] == 'venda') {
                                    echo 'R$ ' . number_format($property['sale_value'], 2, ',', '.');
                                }
                                ?>
                            </p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Não há coberturas disponíveis no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="path-to-bootstrap.js"></script>
    <script>
        function filterProperties(filter) {
            const sections = document.querySelectorAll('.property-section');

            sections.forEach(section => {
                const sectionType = section.getAttribute('data-type');

                if (sectionType === filter || filter === '') {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>