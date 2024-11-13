<?php
session_start();

// Obtener el ID Token desde el frontend (en lugar de un Access Token)
$idToken = $_POST['id_token'] ?? null; // Recibes el ID Token a través de POST

// Verificar si el token ha sido proporcionado
if (!$idToken) {
    echo json_encode(['status' => 'error', 'message' => 'ID Token no proporcionado']);
    exit;
}

// Función para verificar el ID Token con Google
function verifyIdToken($idToken)
{
    // La URL de Google para verificar el token
    $url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $idToken;

    // Realiza la solicitud para verificar el token
    $response = file_get_contents($url);

    // Si la solicitud falla
    if ($response === FALSE) {
        error_log("Error al verificar el ID Token con Google: " . $response);
        return false;
    }

    // Decodifica la respuesta JSON
    $payload = json_decode($response, true);
    error_log("Respuesta de Google: " . json_encode($payload));

    // Verifica si la respuesta contiene el campo 'sub', indicando que el token es válido
    if (isset($payload['sub'])) {
        return $payload; // El token es válido, se devuelve la respuesta de Google
    } else {
        error_log("Respuesta de Google no contiene 'sub': " . json_encode($payload));
    }

    return false; // El token no es válido
}

$userData = verifyIdToken($idToken);

if ($userData) {
    // El token es válido, puedes acceder a los datos del usuario
    echo json_encode(['status' => 'success', 'message' => 'Autenticación exitosa']);

    // Obtener los datos del usuario
    $googleId = $userData['sub']; // Este es el user_id de Google (debe coincidir con el Google ID)
    $name = $userData['name'];
    $email = $userData['email'];
    $picture = $userData['picture'];

    // Guardar la información del usuario en la sesión
    $_SESSION['user'] = [
        'id_google' => $googleId,
        'nombre' => $name,
        'email' => $email,
        'imagen' => $picture
    ];
} else {
    // Si el token no es válido
    echo json_encode(['status' => 'error', 'message' => 'ID Token no válido']);
}
