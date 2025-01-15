<?php

//se inicia una nueva sesión o reanuda la existente
session_start();

//se destruye toda la información registrada en la sesión actual
session_destroy();

//se redirige al usuario a la página de inicio de sesión
header('Location: ../sesion.php');
