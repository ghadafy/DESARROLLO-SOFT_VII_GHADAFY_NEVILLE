
// Definir constantes para los cargos
const DESARROLLADOR_ID = 4;
// ID del cargo de Desarrollador, ajusta según tu sistema

document.addEventListener('DOMContentLoaded', function () {
    const cargoSelect = document.getElementById('cargo');
    const experienciaField = document.getElementById('aniosExperiencia');
    const lenguajeField = document.getElementById('lenguaje');
    const lb_experienciaField = document.getElementById('lb_aniosExperiencia');
    const lb_lenguajeField = document.getElementById('lb_lenguaje');

    // Función para mostrar u ocultar los campos
    function toggleFields() {
        const selectedCargo = parseInt(cargoSelect.value);

        if (selectedCargo === DESARROLLADOR_ID) {
            // Mostrar los campos si es un desarrollador
            experienciaField.style.display = 'block';
            lenguajeField.style.display = 'block';
            lb_experienciaField.style.display = 'block';
            lb_lenguajeField.style.display = 'block';
        } else {
            // Ocultar los campos si no es un desarrollador
            experienciaField.style.display = 'none';
            lenguajeField.style.display = 'none';
            lb_experienciaField.style.display = 'none';
            lb_lenguajeField.style.display = 'none';
        }
    }

    // Ejecutar la función cuando la página se cargue y cuando el cargo cambie
    toggleFields();
    cargoSelect.addEventListener('change', toggleFields);
});

