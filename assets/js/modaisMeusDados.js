// JS modal para atualizar os dados do usuário

document.getElementById('form-username').addEventListener('submit', function (e) {
    e.preventDefault();

    let currentUsername = document.getElementById('current-username').value;
    let newUsername = document.getElementById('new-username').value;

    fetch('update_user_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'action': 'update_username',
            'current_username': currentUsername,
            'new_username': newUsername
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Nome de usuário atualizado com sucesso!');

                let saudacaoElement = document.querySelector('.saudacao h2');

                let saudacaoTexto = saudacaoElement.textContent;
                let novaSaudacao = saudacaoTexto.replace(/, .*!/, `, ${newUsername}!`);
                saudacaoElement.textContent = novaSaudacao;

                let userNameCard = document.querySelector('.user-name-card p');
                if (userNameCard) {
                    userNameCard.innerHTML = `Nome de usuário: ${newUsername}`;
                }

                document.getElementById('modal-username').close();
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            alert('Erro na requisição: ' + error);
        });
});

// JS modal para atualizar e-mail do usuário

document.getElementById('form-email').addEventListener('submit', function (e) {
    e.preventDefault();

    let currentEmail = document.getElementById('current-email').value;
    let newEmail = document.getElementById('new-email').value;

    fetch('update_user_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'action': 'update_email',
            'current_email': currentEmail,
            'new_email': newEmail
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('E-mail atualizado com sucesso!');

                let emailCard = document.querySelector('.user-email-card p');
                if (emailCard) {
                    emailCard.innerHTML = `E-mail: ${newEmail}`;
                }

                let mailCard = document.querySelector('.mail-card p');
                if (mailCard) {
                    mailCard.innerHTML = `E-mail: ${newEmail}`;
                }

                document.getElementById('modal-email').close();
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            alert('Erro na requisição: ' + error);
        });
});

// JS modal para atualizar a senha do usuário

document.getElementById('form-password').addEventListener('submit', function (e) {
    e.preventDefault();

    let currentPassword = document.getElementById('current-password').value;
    let newPassword = document.getElementById('new-password').value;

    fetch('update_user_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'action': 'update_password',
            'current_password': currentPassword,
            'new_password': newPassword
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Senha alterada com sucesso!');

                document.getElementById('modal-password').close();

                document.getElementById('form-password').reset();
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            alert('Erro na requisição: ' + error);
        });
});