document.addEventListener("DOMContentLoaded", function () {
    const yearElement = document.getElementById('year');
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }

    const searchInput = document.getElementById('searchInput');
    const placeholderText = 'Pesquise seu imóvel';
    let placeholderIndex = 0;
    let typing = true;

    // Função auto typing
    function typeEffect() {
        if (typing) {
            searchInput.placeholder = placeholderText.substring(0, placeholderIndex + 1);
            placeholderIndex++;
            if (placeholderIndex === placeholderText.length) {
                typing = false;
                setTimeout(typeEffect, 1000);
                return;
            }
        } else {
            // Apaga o texto
            searchInput.placeholder = placeholderText.substring(0, placeholderIndex - 1);
            placeholderIndex--;
            if (placeholderIndex === 0) {
                typing = true;
                setTimeout(typeEffect, 1000);
                return;
            }
        }
        setTimeout(typeEffect, 100);
    }

    if (searchInput) {
        typeEffect();
    }
});
