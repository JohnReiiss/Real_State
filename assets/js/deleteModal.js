document.addEventListener('DOMContentLoaded', () => {
    const deleteButton = document.querySelector('.bi-trash3-fill');
    const modalDelete = document.getElementById('modal-delete');
    const closeModalButton = document.querySelector('.close-modal');
    const confirmDeleteButton = document.getElementById('confirm-delete');

    // Função para abrir o modal
    function openDeleteModal(event) {
        event.preventDefault();
        modalDelete.showModal();
    }

    // Função para fechar o modal
    function closeModal() {
        modalDelete.close();
    }

    // Função para confirmar a exclusão
    function confirmDelete(event) {
        event.preventDefault();
        const property_id = new URLSearchParams(window.location.search).get('id');

        if (!property_id) {
            alert("ID do imóvel não foi encontrado.");
            return;
        }

        fetch(`delete_property.php?id=${property_id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na rede');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Redireciona após 1 segundo para dar tempo do usuário ver a mensagem
                    setTimeout(() => {
                        window.location.href = data.redirect || 'dados_usuario.php';
                    }, 1000);
                } else {
                    alert(data.message || 'Erro ao excluir o imóvel');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao conectar com o servidor');
            })
            .finally(() => {
                modalDelete.close();
            });
    }

    // Eventos
    if (deleteButton) deleteButton.addEventListener('click', openDeleteModal);
    if (closeModalButton) closeModalButton.addEventListener('click', closeModal);
    if (confirmDeleteButton) confirmDeleteButton.addEventListener('click', confirmDelete);
});