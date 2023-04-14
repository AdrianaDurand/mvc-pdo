<?php

// Tabla
$claveusuario = "SENATI";

$claveMD5 = md5($claveusuario);
$claveSHA = sha1($claveusuario);
$claveHAS = password_hash($claveusuario, PASSWORD_BCRYPT);

// Clave acceso (LOGIN)
$claveAcceso =  "SENATI";

//var_dump($claveHAS);

// Validar la clave HASH
if (password_verify($claveAcceso, $claveHAS)){
  echo "Acceso correcto";
}