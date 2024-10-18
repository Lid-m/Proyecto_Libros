<?php
session_start();
session_destroy(); // Cerrar sesión
header("Location: login.php"); // Redirigir al login
exit();