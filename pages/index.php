<?php
include('../includes/header.php');
include('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Imobiliária Nara - Encontre os melhores imóveis para compra e venda.">
    <title>Imobiliária Nara - Página Inicial</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/search_bar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <main class="index-main">
        <section class="banner">
            <a href="list_properties.php">
                <img src="../assets/images/banner-imobiliaria-nara.jpg" alt="Banner promocional da Imobiliária Nara, mostrando uma bela imagem de imóveis à venda" />
            </a>
        </section>

        <section class="search-section">
            <div class="container">
                <div class="search-container">
                    <form onsubmit="event.preventDefault(); filterProperties(document.getElementById('searchInput').value, '', '');" class="search-form">
                        <div class="input-group">
                            <input type="text" id="searchInput" placeholder="Pesquise seu imóvel" class="form-control search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button type="submit" class="btn-search">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <?php
        include('../includes/db.php');

        $sql = "SELECT * FROM property ORDER BY created_at DESC LIMIT 5";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $recent_properties = $stmt->fetchAll();
        ?>

        <section class="recent-properties-section">
            <div class="container">
                <h2>Imóveis Adicionados Recentemente</h2>
                <div class="recent-properties-carousel">
                    <?php if ($recent_properties): ?>
                        <?php foreach ($recent_properties as $property): ?>
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
                        <p>Não há imóveis adicionados recentemente.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php
        $sql_rent = "SELECT * FROM property WHERE property_status = 'aluguel' ORDER BY created_at DESC LIMIT 5";
        $stmt_rent = $pdo->prepare($sql_rent);
        $stmt_rent->execute();
        $rent_properties = $stmt_rent->fetchAll();
        ?>

        <section class="rent-properties-section">
            <div class="container">
                <h2>Imóveis para Alugar</h2>

                <div class="rent-properties-carousel">
                    <?php
                    $search_term = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

                    if ($search_term) {
                        $sql_rent = "SELECT * FROM property WHERE property_status = 'aluguel' AND (address LIKE ? OR type LIKE ? OR description LIKE ?) ORDER BY created_at DESC LIMIT 5";
                        $stmt_rent = $pdo->prepare($sql_rent);
                        $stmt_rent->execute([$search_term, $search_term, $search_term]);
                    } else {
                        $sql_rent = "SELECT * FROM property WHERE property_status = 'aluguel' ORDER BY created_at DESC LIMIT 5";
                        $stmt_rent = $pdo->prepare($sql_rent);
                        $stmt_rent->execute();
                    }
                    $rent_properties = $stmt_rent->fetchAll();
                    ?>

                    <?php if ($rent_properties): ?>
                        <?php foreach ($rent_properties as $property): ?>
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
                                    echo 'R$ ' . number_format($property['rent_value'], 2, ',', '.');
                                    ?>
                                </p>
                                <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Não há imóveis para alugar no momento.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <?php
        $sql_sale = "SELECT * FROM property WHERE property_status = 'venda' ORDER BY created_at DESC LIMIT 5";
        $stmt_sale = $pdo->prepare($sql_sale);
        $stmt_sale->execute();
        $sale_properties = $stmt_sale->fetchAll();
        ?>

        <section class="sale-properties-section">
            <div class="container">
                <h2>Imóveis à Venda</h2>

                <div class="sale-properties-carousel">
                    <?php
                    $search_term = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

                    if ($search_term) {
                        $sql_sale = "SELECT * FROM property WHERE property_status = 'venda' AND (address LIKE ? OR type LIKE ? OR description LIKE ?) ORDER BY created_at DESC LIMIT 5";
                        $stmt_sale = $pdo->prepare($sql_sale);
                        $stmt_sale->execute([$search_term, $search_term, $search_term]);
                    } else {
                        $sql_sale = "SELECT * FROM property WHERE property_status = 'venda' ORDER BY created_at DESC LIMIT 5";
                        $stmt_sale = $pdo->prepare($sql_sale);
                        $stmt_sale->execute();
                    }
                    $sale_properties = $stmt_sale->fetchAll();
                    ?>

                    <?php if ($sale_properties): ?>
                        <?php foreach ($sale_properties as $property): ?>
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
                                    echo 'R$ ' . number_format($property['sale_value'], 2, ',', '.');
                                    ?>
                                </p>
                                <a href="property_details.php?id=<?php echo $property['id']; ?>">Ver detalhes</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
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

        <section class="apartment-properties-section">
            <div class="container">
                <h2>Apartamentos</h2>

                <div class="apartment-properties-carousel">
                    <?php
                    $search_term = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

                    if ($search_term) {
                        $sql_apartment = "SELECT * FROM property WHERE type = 'Apartamento' AND (address LIKE ? OR description LIKE ?) ORDER BY created_at DESC LIMIT 5";
                        $stmt_apartment = $pdo->prepare($sql_apartment);
                        $stmt_apartment->execute([$search_term, $search_term]);
                    } else {
                        $sql_apartment = "SELECT * FROM property WHERE type = 'Apartamento' ORDER BY created_at DESC LIMIT 5";
                        $stmt_apartment = $pdo->prepare($sql_apartment);
                        $stmt_apartment->execute();
                    }
                    $apartment_properties = $stmt_apartment->fetchAll();
                    ?>

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

        <section class="house-properties-section">
            <div class="container">
                <h2>Casas</h2>

                <div class="house-properties-carousel">
                    <?php
                    $search_term = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

                    if ($search_term) {
                        $sql_house = "SELECT * FROM property WHERE type = 'Casa' AND (address LIKE ? OR description LIKE ?) ORDER BY created_at DESC LIMIT 5";
                        $stmt_house = $pdo->prepare($sql_house);
                        $stmt_house->execute([$search_term, $search_term]);
                    } else {
                        $sql_house = "SELECT * FROM property WHERE type = 'Casa' ORDER BY created_at DESC LIMIT 5";
                        $stmt_house = $pdo->prepare($sql_house);
                        $stmt_house->execute();
                    }
                    $house_properties = $stmt_house->fetchAll();
                    ?>

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

        <section class="cover-properties-section">
            <div class="container">
                <h2>Coberturas</h2>

                <div class="cover-properties-carousel">
                    <?php
                    $search_term = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

                    if ($search_term) {
                        $sql_cover = "SELECT * FROM property WHERE type = 'Cobertura' AND (address LIKE ? OR description LIKE ?) ORDER BY created_at DESC LIMIT 5";
                        $stmt_cover = $pdo->prepare($sql_cover);
                        $stmt_cover->execute([$search_term, $search_term]);
                    } else {
                        $sql_cover = "SELECT * FROM property WHERE type = 'Cobertura' ORDER BY created_at DESC LIMIT 5";
                        $stmt_cover = $pdo->prepare($sql_cover);
                        $stmt_cover->execute();
                    }
                    $cover_properties = $stmt_cover->fetchAll();
                    ?>

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

    </main>

    <?php include('../includes/footer.php'); ?>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/filterProperties.js"></script>
</body>

</html>