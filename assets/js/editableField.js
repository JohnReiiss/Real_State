document.addEventListener('DOMContentLoaded', () => {
    const editButton = document.querySelector('.edit-button');
    const closeButton = document.querySelector('.close-button');
    const checkButton = document.querySelector('.check-button'); // Ícone de salvar
    const editableFields = document.querySelectorAll('.editable-field');

    // Função para alternar entre visualização e modo de edição
    function toggleEditMode() {
        editableFields.forEach(field => {
            // Se o campo for um <span>, transformamos em um input
            if (field.tagName.toLowerCase() === 'span') {
                const fieldName = field.getAttribute('data-field');
                const fieldValue = field.textContent.trim();

                if (fieldName === 'type') {
                    // Caso o campo seja 'type', criamos um <select>
                    const selectElement = document.createElement('select');
                    selectElement.name = fieldName;
                    selectElement.className = 'form-input';
                    selectElement.required = true;

                    // Definindo as opções do select
                    const options = ['Casa', 'Apartamento', 'Cobertura', 'Comercial', 'Terreno'];
                    options.forEach(optionValue => {
                        const optionElement = document.createElement('option');
                        optionElement.value = optionValue;
                        optionElement.textContent = optionValue;
                        if (optionValue === fieldValue) {
                            optionElement.selected = true; // Marca a opção correta
                        }
                        selectElement.appendChild(optionElement);
                    });

                    field.innerHTML = ''; // Limpar conteúdo
                    field.appendChild(selectElement); // Adicionar o select
                } else {
                    // Para outros campos que não sejam 'type', cria um input normal
                    const inputElement = document.createElement('input');
                    inputElement.type = 'text';
                    inputElement.value = fieldValue;
                    field.innerHTML = ''; // Limpar conteúdo
                    field.appendChild(inputElement); // Adicionar o input
                }
            }
        });

        // Alterna a visibilidade dos ícones
        editButton.style.display = 'none';
        closeButton.style.display = 'block';
        checkButton.style.display = 'block'; // Mostrar o botão de salvar
    }

    // Função para sair do modo de edição e voltar ao estado inicial
    function exitEditMode() {
        editableFields.forEach(field => {
            // Verifica se o campo é um input ou select
            const inputElement = field.querySelector('input') || field.querySelector('select');
            if (inputElement) {
                // Cria um <span> com o valor do input/select
                const spanElement = document.createElement('span');
                spanElement.textContent = inputElement.value;
                field.innerHTML = ''; // Limpar o conteúdo atual
                field.appendChild(spanElement); // Adicionar o span com o valor
            }
        });

        // Alterna a visibilidade dos ícones
        editButton.style.display = 'block';
        closeButton.style.display = 'none';
        checkButton.style.display = 'none'; // Esconder o botão de salvar
    }

    // Função para salvar as edições (quando o ícone de check for clicado)
    function saveEditMode() {
        const updatedData = {};

        editableFields.forEach(field => {
            const inputElement = field.querySelector('input') || field.querySelector('select');
            if (inputElement) {
                const fieldName = field.getAttribute('data-field');
                updatedData[fieldName] = inputElement.value;

                // Após salvar, alteramos os inputs de volta para <span>
                const spanElement = document.createElement('span');
                spanElement.textContent = inputElement.value;
                field.innerHTML = ''; // Limpar o conteúdo atual
                field.appendChild(spanElement); // Adicionar o span com o valor
            }
        });

        // Obter o ID do imóvel da URL
        const property_id = new URLSearchParams(window.location.search).get('id');

        // Verificar se o ID foi encontrado
        if (!property_id) {
            alert("ID do imóvel não foi encontrado.");
            return;
        }

        // Enviar os dados para o servidor via fetch, incluindo o ID do imóvel na URL
        fetch('update_property.php?id=' + property_id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(updatedData).toString() // Converte os dados em formato URL encoded
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Dados atualizados com sucesso!');
                } else {
                    alert('Erro ao atualizar os dados.');
                }
            })
            .catch(error => {
                console.error('Erro ao enviar os dados:', error);
                alert('Erro ao tentar salvar as alterações.');
            });

        // Alterna a visibilidade dos ícones
        editButton.style.display = 'block';
        closeButton.style.display = 'none';
        checkButton.style.display = 'none'; // Esconder o botão de salvar
    }

    // Evento para ativar a edição ao clicar no ícone da caneta
    editButton.addEventListener('click', toggleEditMode);

    // Evento para sair do modo de edição ao clicar no ícone X
    closeButton.addEventListener('click', exitEditMode);

    // Evento para salvar as edições ao clicar no ícone de salvar (check)
    checkButton.addEventListener('click', saveEditMode);
});
