<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do usuário</title>
    <?php include('../includes/header.php'); ?>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/dados_do_usuario.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
</head>

<body>

    <?php
    include('../includes/db.php');

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    //Query do usuário
    $sql = "SELECT name FROM users LIMIT 1";
    $stmt = $pdo->query($sql);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $username = $user['name'];
    } else {
        $username = "Usuário não encontrado";
    }

    //Query do e-mail
    $sql = "SELECT email FROM users LIMIT 1";
    $stmt = $pdo->query($sql);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $email = $user['email'];
    } else {
        $email = "E-mail não encontrado";
    }
    ?>

    <main>
        <section class="container">
            <div class="card-section">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z" />
                </svg>
                <h4>MEUS DADOS</h4>

                <div class="user-name-card">
                    <p>Nome de usuário: <?php echo htmlspecialchars($username); ?></p>
                    <svg class="open-modal" data-modal="modal-username" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                    </svg>
                </div>

                <div class="mail-card">
                    <p>E-mail: <?php echo htmlspecialchars($email); ?></p>
                    <svg class="open-modal" data-modal="modal-email" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                    </svg>
                </div>

                <div class="password-card">
                    <p>Senha:</p>
                    <svg class="open-modal" data-modal="modal-password" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                    </svg>
                </div>

                <div class="alert">
                    <p>* Por questões de segurança sua senha não é exibida, mas você pode alterá-la clicando no ícone da caneta</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill-alert" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                    </svg>
                </div>
            </div>
        </section>

        <?php
        include 'get_properties.php';
        ?>

        <section class="container">
            <div class="card-propery-section">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-houses-fill" viewBox="0 0 16 16">
                    <path d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354z" />
                    <path d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708z" />
                </svg>
                <h4>MEUS IMÓVEIS</h4>
                <p>* Você pode atualizar informações do seu imóvel nesta seção, adicionar mais imóveis ou excluir eles.</p>
            </div>

            <div class="card-list-property">
                <?php foreach ($properties as $property): ?>
                    <div class="property-card">
                        <?php
                        $images = explode(',', $property['images']);
                        $mainImagePath = '../uploads/' . $images[0];
                        if (file_exists($mainImagePath)): ?>
                            <img src="<?php echo $mainImagePath; ?>" alt="Imagem principal do imóvel" class="property-image-main">
                        <?php else: ?>
                            <p class="image-error">Imagem não encontrada.</p>
                        <?php endif; ?>

                        <h5><?php echo htmlspecialchars($property['address']); ?></h5>
                        <p>Tipo: <?php echo htmlspecialchars($property['type']); ?></p>
                        <p>Cidade: <?php echo htmlspecialchars($property['city']); ?></p>

                        <?php if (!empty($property['sale_value']) && empty($property['rent_value'])): ?>
                            <p>Preço de venda: R$ <?php echo number_format($property['sale_value'], 2, ',', '.'); ?></p>
                        <?php elseif (!empty($property['rent_value']) && empty($property['sale_value'])): ?>
                            <p>Preço de aluguel: R$ <?php echo number_format($property['rent_value'], 2, ',', '.'); ?></p>
                        <?php elseif (!empty($property['sale_value']) && !empty($property['rent_value'])): ?>
                            <p>Preço de venda: R$ <?php echo number_format($property['sale_value'], 2, ',', '.'); ?></p>
                            <p>Preço de aluguel: R$ <?php echo number_format($property['rent_value'], 2, ',', '.'); ?></p>
                        <?php endif; ?>

                        <p>Quartos: <?php echo $property['bedrooms']; ?></p>
                        <p>Banheiros: <?php echo $property['bathrooms']; ?></p>
                        <p>Garagem: <?php echo $property['garage_spaces']; ?> vagas</p>

                        <div class="property-actions-details">
                            <a href="property_details.php?id=<?= $property['id']; ?>" class="edit-property-link">
                                <button class="edit-property">+ detalhes</button>
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </section>
    </main>

    <!-- Modal para editar nome de usuário -->
    <dialog class="modal-username" id="modal-username">
        <form id="form-username">
            <h1>Editar nome de usuário</h1>
            <input type="text" id="current-username" placeholder="Nome de usuário atual">
            <input type="text" id="new-username" placeholder="Novo nome de usuário">
            <div>
                <button type="submit">Salvar</button>
                <button class="close-modal" type="button" data-modal="modal-username">Fechar</button>
            </div>
        </form>
    </dialog>

    <!-- Modal para editar e-mail -->
    <dialog class="modal-email" id="modal-email">
        <form id="form-email">
            <h1>Editar e-mail</h1>
            <input type="email" id="current-email" placeholder="Endereço de e-mail atual">
            <input type="email" id="new-email" placeholder="Novo endereço de e-mail">
            <div>
                <button type="submit">Salvar</button>
                <button class="close-modal" type="button" data-modal="modal-email">Fechar</button>
            </div>
        </form>
    </dialog>

    <!-- Modal para alterar senha -->
    <dialog class="modal-password" id="modal-password">
        <form id="form-password">
            <h1>Alterar Senha</h1>
            <input type="password" id="current-password" placeholder="Senha atual">
            <input type="password" id="new-password" placeholder="Nova senha">
            <div>
                <button type="submit">Salvar</button>
                <button class="close-modal" type="button" data-modal="modal-password">Fechar</button>
            </div>
        </form>
    </dialog>

    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/modaisMeusDados.js"></script>
</body>


<?php include('../includes/footer.php'); ?>