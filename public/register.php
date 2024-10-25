<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ERROR AL INGRESAR LOS DATOS</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
        :root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --background-color: #f5f7fa;
    --text-color: #34495e;
    --card-background: #ffffff;
    --shadow-color: rgba(0, 0, 0, 0.1);
}
   body{

   }
.container{
    display:flex;
    justify-content : center;
    background:var(--primary-color);
    align-items:center;
    width: 100%;
    height:80px;


}
.container__nav{
    padding:0% 5% 0% 5%;

   margin:5%;

}
.container__nav ul,
.container__nav a
{

   list-style: none;
   text-decoration:none;

 font-family: 'Montserrat', sans-serif;

 color:var(    --card-background);
  font-size:1.5rem;
   width: 100%;
   font-weight:bold;

}
.respuesta{
    display:flex;
    flex-flow:column wrap;

    justify-content : center;
    background:write;
    align-items:center;
    width: 100%;
    height:100%;


}
.respuesta p{
    font-family: 'Montserrat', sans-serif;
    font-weight:bold;

  font-size:1.5rem;

}
.img{
    justify-content : center;
    align-items:center;


    width: 50%;
    height:450px;
}
.img img{


      flex-shrink: 1;
      width: 100%;
      height:100%;


    justify-content : center;
    align-items:center;

}




    </style>
</head>
<body>



<?php
require_once __DIR__ . '/../includes/User.php';
$result=null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);
    $result= (!isset($_POST['name']) || !isset($_POST['mail']) || !isset($_POST['telephone']) || !isset($_POST['password']));
    if  (!isset($_POST['name']) || !isset($_POST['mail']) || !isset($_POST['telephone']) || !isset($_POST['password'])) {
        echo '<div id="responseMessage" class="respuesta" >

        <p style="color: red;">Todos los campos son obligatorios, vuelve al inicio</p>
        <div class="img">
         <img  src="/prueba/img/sin-datos.gif" alt="icono de error" srcset="">

        </div>



        </div>' ;

        exit;


    }
    }else {
        echo json_encode(['error' => 'Método no permitido']);
    }

    $user = new User();
    $result = $user->register($_POST['name'], $_POST['mail'],$_POST['telephone'], $_POST['password']);
 echo json_encode($result);



?>


<script>
    document.getElementById('registerForm').addEventListener('submit', async function(event) {
        event.preventDefault(); // Evitar que se recargue la página al enviar el formulario

        // Recoger los datos del formulario
        const formData = new FormData(this);

        // Enviar los datos con Fetch API
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });

        // Leer la respuesta como texto HTML
        const result = await response.text();


        // Insertar el HTML devuelto en el div con id 'responseMessage'
        document.getElementById('responseMessage').innerHTML = result;
    });


/*codigo php anterior */
    /*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);
    if (!isset($_POST['name']) || !isset($_POST['mail']) || !isset($_POST['telephone']) || !isset($_POST['password'])) {
        echo json_encode(['error' => 'Todos los campos son obligatorios']);

        exit;


    }

    $user = new User();
    $result = $user->register($_POST['name'], $_POST['mail'],$_POST['telephone'], $_POST['password']);
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Método no permitido']);
} */
</script>

</body>
</html>

