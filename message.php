<?php

header('Content-Type: text/html; charset=UTF-8');

// conectando a la base de datos
$conn = mysqli_connect("localhost", "id22020111_root", "Admin1234!", "id22020111_chatbot") or die("Database Error");

// obteniendo el mensaje del usuario a través de ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);






$palabras_clave = array('terror', 'acción', 'comedia', 'drama', 'ciencia ficción', 'suspenso', 'animación', 'romance', 'fantasía', 'documental', 'thriller', 'western', 'musical', 'misterio', 'aventura', 'biografía', 'suspenso psicológico', 'histórico', 'terror psicológico', 'superhéroes', 'romance adolescente', 'comedia romántica', 'ciencia ficción espacial', 'cine negro', 'thriller psicológico', 'cine de culto', 'acción y aventura', 'romance dramático', 'comedia negra', 'animación japonesa', 'cine de guerra', 'películas de culto', 'cine de época', 'cine experimental', 'cine de animación stop-motion', 'cine de vampiros', 'cine de zombis', 'cine de monstruos', 'cine de artes marciales', 'cine de persecución', 'cine de espías');

// Obtener la consulta del usuario
//es $getMesg

// Iterar sobre las palabras clave
foreach ($palabras_clave as $palabra) {
    // Verificar si la palabra clave está presente en la consulta del usuario
    if (strpos($getMesg, $palabra) !== false) {
        // Si la palabra clave está presente, ejecutar la consulta SQL correspondiente
        // Aquí asumimos que tienes una función para ejecutar la consulta SQL basada en la palabra clave
        $getMesg = $palabra;
        break; // Terminamos el bucle una vez que encontramos una coincidencia
    }
}









//comprobando la consulta del usuario a la consulta de la base de datos
$check_data = "SELECT respuesta FROM chatbot WHERE mensaje LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

#$log = "INSERT INTO chatbot (Mensaje) VALUES ('$getMesg')";
#$run_query2 = mysqli_query($conn, $log) or die("Error");

// si la consulta del usuario coincide con la consulta de la base de datos, mostraremos la respuesta; de lo contrario, irá a otra declaración
if (mysqli_num_rows($run_query) > 0) {
    //recuperando la reproducción de la base de datos de acuerdo con la consulta del usuario
    $fetch_data = mysqli_fetch_assoc($run_query);
    //almacenando la respuesta a una variable que enviaremos a ajax
    $replay = $fetch_data['respuesta'];
    echo $replay;
} else {
    
    echo "No te he entendido";
    
}

$eliminar = "DELETE FROM `chatbot` WHERE mensaje LIKE '%contraseña%'";
$run_query3 = mysqli_query($conn, $eliminar) or die("Error");

$delete = "DELETE FROM `chatbot` WHERE mensaje LIKE '%Hola%'";
$run_query4 = mysqli_query($conn, $delete) or die("Error");
