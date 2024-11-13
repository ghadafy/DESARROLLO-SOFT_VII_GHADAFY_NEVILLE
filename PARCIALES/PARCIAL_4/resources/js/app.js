window.onload = function () {
    // Asegúrate de que la API de Google esté cargada
    if (typeof google === 'undefined' || !google.accounts || !google.accounts.id) {
        console.error("La API de Google no está cargada correctamente.");
        return;
    }

    // Inicializa la API de Google
    google.accounts.id.initialize({
        client_id: '528282339510-0g5fv2f34pjst8pcl5otq09c3700ljck.apps.googleusercontent.com',
        callback: handleCredentialResponse  // El callback que se ejecutará cuando el usuario se autentique
    });

    // Renderiza el botón en el div con el id "g_id_onload"
    google.accounts.id.renderButton(
        document.getElementById("g_id_onload"),
        { theme: "outline", size: "large" }  // Personaliza el botón
    );
};

// Función para manejar la respuesta de Google
function handleCredentialResponse(response) {
    const idToken = response.credential;  // Obtener el ID Token de la respuesta
    console.log('ID Token:', idToken);

    if (!idToken) {
        alert("Error: No se obtuvo el ID Token");
        return;
    }

    // Enviar el ID Token al backend para verificarlo
    fetch('verify_token.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_token=${idToken}`  // Aquí enviamos el ID Token al backend
    })
        .then(res => res.json())
        .then(data => {
            console.log('Respuesta del servidor:', data);

            if (data.status === 'success') {
                alert('Autenticación exitosa');
                window.location.href = 'index.php';  // Redirigir al usuario al inicio
            } else {
                alert('Error en la autenticación: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error en la verificación del token:', error);
            alert('Hubo un error en la verificación del token');
        });
}
