
function setupPersonSearch(searchInputId, hiddenInputId, selectId, tipo = null, sexo = null) {
    const searchInput = document.getElementById(searchInputId);
    const hiddenInput = document.getElementById(hiddenInputId);
    const selectElement = document.getElementById(selectId);

    if (!searchInput || !hiddenInput || !selectElement) {
        console.error(`Elementos no encontrados para: ${searchInputId}`);
        return;
    }

    function showLoading() {
        selectElement.innerHTML = '<option>Buscando...</option>';
        selectElement.style.display = 'block';
    }

    function hideSelect() {
        selectElement.style.display = 'none';
    }

    let typingTimer;
    const doneTypingInterval = 500;

    searchInput.addEventListener('input', function () {
        const searchValue = this.value;

        clearTimeout(typingTimer);

        if (searchValue.length > 2) {
            showLoading();

            typingTimer = setTimeout(() => {
                let url = `/api/personas/buscar?search=${searchValue}`;

                // Agregar tipo si está definido
                if (tipo) {
                    url += `&tipo=${tipo}`;
                }

                // Agregar sexo si está definido
                if (sexo) {
                    url += `&sexo=${sexo}`;
                }

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }
                        return response.json();
                    })
                    .then(data => {
                        selectElement.innerHTML = '';

                        if (data.data && data.data.length > 0) {
                            data.data.forEach(person => {
                                const option = document.createElement('option');
                                option.value = person.persona_id;
                                option.textContent = `${person.nombres} ${person.apellidos} - ${person.dpi_cui || 'Sin DPI'}`;
                                selectElement.appendChild(option);
                            });
                            selectElement.style.display = 'block';
                        } else {
                            selectElement.innerHTML = '<option>No se encontraron resultados</option>';
                            setTimeout(hideSelect, 2000);
                        }
                    })
                    .catch(error => {
                        console.error('Error en la búsqueda:', error);
                        selectElement.innerHTML = '<option>Error en la búsqueda</option>';
                        setTimeout(hideSelect, 2000);
                    });
            }, doneTypingInterval);
        } else {
            hideSelect();
        }
    });

    selectElement.addEventListener('change', function () {
        if (this.selectedIndex >= 0) {
            const selectedOption = this.options[this.selectedIndex];
            const personaId = selectedOption.value;
            const personaText = selectedOption.textContent;

            hiddenInput.value = personaId;
            searchInput.value = personaText;

            searchInput.classList.add('is-valid');

            hideSelect();
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target !== searchInput && event.target !== selectElement) {
            hideSelect();
        }
    });
}
