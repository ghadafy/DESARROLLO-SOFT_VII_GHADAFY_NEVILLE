
const radioDepto = document.getElementById('radioDepto');
const radioCargo = document.getElementById('radioCargo');
const casillaDepto = document.getElementById('casillaDepto');
const casillaCargo = document.getElementById('casillaCargo');

// Función para mostrar u ocultar la casilla de selección
function actualizarVisibilidad() {
    if (radioDepto.checked) {
        casillaDepto.style.display = 'block';
        casillaCargo.style.display = 'none';


    } else if (radioCargo.checked) {
        casillaDepto.style.display = 'none';

        casillaCargo.style.display = 'block';
    }
}

radioDepto.addEventListener('change', actualizarVisibilidad);
radioCargo.addEventListener('change', actualizarVisibilidad);
