<?php include('../includes/header.php'); ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Imobiliária Nara - Encontre os melhores imóveis para compra e venda.">
    <title>Imobiliária Nara - Adicione seu imóvel</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/add_property.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
</head>

<body>

    <main class="add-property-main">
        <div class="form-wrapper">
            <h1 class="add-property-title">Adicione o seu imóvel</h1>
            <form action="add_property_process.php" method="POST" enctype="multipart/form-data" class="add-property-form">
                <label for="type" class="form-label">Tipo:</label>
                <select name="type" class="form-input" required>
                    <option value="Casa">Casa</option>
                    <option value="Apartamento">Apartamento</option>
                    <option value="Cobertura">Cobertura</option>
                    <option value="Comercial">Comercial</option>
                    <option value="Terreno">Terreno</option>
                </select>

                <label for="address" class="form-label">Endereço:</label>
                <input type="text" name="address" class="form-input" required>

                <label for="city" class="form-label">Cidade:</label>
                <input type="text" name="city" class="form-input" required>

                <label for="property_status" class="form-label">Status do Imóvel:</label>
                <select id="property_status" name="property_status" class="form-input" required onchange="toggleValues()">
                    <option value="aluguel">Aluguel</option>
                    <option value="venda">Venda</option>
                </select>

                <div id="rent_fields" class="status-fields" style="display:none;">
                    <label for="rent_value" class="form-label">Valor do Aluguel (R$):</label>
                    <input type="number" step="0.01" name="rent_value" class="form-input">
                </div>

                <div id="sale_fields" class="status-fields" style="display:none;">
                    <label for="sale_value" class="form-label">Valor de Venda (R$):</label>
                    <input type="number" step="0.01" name="sale_value" class="form-input">
                </div>

                <label for="condominium" class="form-label">Tem Condomínio?</label>
                <select name="condominium" class="form-input" id="condominium" onchange="toggleCondominiumValue()" required>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>

                <div id="condominium_value_field" style="display:none;">
                    <label for="condominium_value" class="form-label">Valor do Condomínio (R$):</label>
                    <input type="number" step="0.01" name="condominium_value" class="form-input">
                </div>

                <script>
                    function toggleCondominiumValue() {
                        var condominium = document.getElementById('condominium').value;
                        var condominiumValueField = document.getElementById('condominium_value_field');

                        if (condominium == '1') {
                            condominiumValueField.style.display = 'block';
                        } else {
                            condominiumValueField.style.display = 'none';
                        }
                    }

                    window.onload = function() {
                        toggleCondominiumValue();
                        toggleValues();
                    };

                    function toggleValues() {
                        var propertyStatus = document.getElementById('property_status').value;
                        var rentFields = document.getElementById('rent_fields');
                        var saleFields = document.getElementById('sale_fields');

                        if (propertyStatus === 'aluguel') {
                            rentFields.style.display = 'block';
                            saleFields.style.display = 'none';
                        } else if (propertyStatus === 'venda') {
                            rentFields.style.display = 'none';
                            saleFields.style.display = 'block';
                        }
                    }
                </script>

                <label for="garage_spaces" class="form-label">Vagas de Garagem:</label>
                <input type="number" name="garage_spaces" class="form-input">

                <label for="bedrooms" class="form-label">Quartos:</label>
                <input type="number" name="bedrooms" class="form-input">

                <label for="bathrooms" class="form-label">Banheiros:</label>
                <input type="number" name="bathrooms" class="form-input">

                <label for="area" class="form-label">Área (m²):</label>
                <input type="number" step="0.01" name="area" class="form-input" required>

                <label for="postal_code" class="form-label">CEP:</label>
                <input type="text" name="postal_code" class="form-input" required>

                <label for="neighborhood" class="form-label">Bairro:</label>
                <input type="text" name="neighborhood" class="form-input" required>

                <label for="owner_whatsapp" class="form-label">WhatsApp do Proprietário:</label>
                <input type="text" name="owner_whatsapp" class="form-input">

                <label for="owner_email" class="form-label">E-mail do Proprietário:</label>
                <input type="email" name="owner_email" class="form-input">

                <label for="property_images" class="form-label">Imagens do imóvel:</label>
                <input type="file" name="property_images[]" id="property_images" class="form-input" multiple style="display: none;">
                <button type="button" class="btn btn-add-images" onclick="document.getElementById('property_images').click();">Adicionar as fotos do seu imóvel</button>

                <div id="image_preview" class="image-preview">

                </div>

                <script>
                    document.getElementById('property_images').addEventListener('change', function(event) {
                        var files = event.target.files;
                        var previewContainer = document.getElementById('image_preview');
                        previewContainer.innerHTML = '';

                        if (files) {
                            for (var i = 0; i < files.length; i++) {
                                var file = files[i];
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    var img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.style.width = '100px';
                                    img.style.margin = '5px';
                                    img.classList.add('sortable-image');
                                    previewContainer.appendChild(img);
                                };

                                reader.readAsDataURL(file);
                            }
                        }
                    });

                    var sortable = new Sortable(document.getElementById('image_preview'), {
                        onEnd: function(evt) {
                        }
                    });
                </script>


                <button type="submit" class="btn btn-submit">Cadastrar Imóvel</button>
            </form>
        </div>
    </main>

    <?php include('../includes/footer.php'); ?>

</body>

</html>