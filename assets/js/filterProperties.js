document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchForm = document.querySelector(".search-form");

    searchForm.addEventListener("submit", function (event) {
        event.preventDefault();
        filterProperties(searchInput.value);
    });
});

function filterProperties(searchTerm) {
    fetch("fetch_properties.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `search=${encodeURIComponent(searchTerm)}`,
    })
    .then(response => response.json())
    .then(properties => {
        const sections = {
            'Casa': document.querySelector(".house-properties-section"),
            'Apartamento': document.querySelector(".apartment-properties-section"),
            'Cobertura': document.querySelector(".cover-properties-section"),
            'venda': document.querySelector(".sale-properties-section"),
            'aluguel': document.querySelector(".rent-properties-section"),
            'recentes': document.querySelector(".recent-properties-section")
        };

        const carousels = {
            'Casa': document.querySelector(".house-properties-section .house-properties-carousel"),
            'Apartamento': document.querySelector(".apartment-properties-section .apartment-properties-carousel"),
            'Cobertura': document.querySelector(".cover-properties-section .cover-properties-carousel"),
            'venda': document.querySelector(".sale-properties-section .sale-properties-carousel"),
            'aluguel': document.querySelector(".rent-properties-section .rent-properties-carousel"),
            'recentes': document.querySelector(".recent-properties-section .recent-properties-carousel")
        };

        Object.values(carousels).forEach(carousel => {
            if (carousel) carousel.innerHTML = "";
        });

        Object.values(sections).forEach(section => {
            if (section) section.style.display = "none";
        });

        if (properties.length === 0) {
            Object.values(carousels).forEach(carousel => {
                if (carousel) carousel.innerHTML = "<p>Nenhum imóvel encontrado.</p>";
            });
            return;
        }

        properties.forEach(property => {
            const sectionKey = carousels[property.type] ? property.type : (carousels[property.property_status] ? property.property_status : 'recentes');
            const targetCarousel = carousels[sectionKey];
            const targetSection = sections[sectionKey];

            if (targetCarousel) {
                const propertyItem = document.createElement("div");
                propertyItem.classList.add("property-item");
                propertyItem.innerHTML = `
                    <img src="${property.image}" alt="Imagem do Imóvel" class="property-image-main">
                    <h3>${property.type}</h3>
                    <p><strong>Endereço:</strong> ${property.address}</p>
                    <p><strong>Preço:</strong> ${property.price}</p>
                    <a href="property_details.php?id=${property.id}">Ver detalhes</a>
                `;
                targetCarousel.appendChild(propertyItem);

                if (targetSection) {
                    targetSection.style.display = "block";
                }
            }
        });
    })
    .catch(error => console.error("Erro ao buscar imóveis:", error));
}
