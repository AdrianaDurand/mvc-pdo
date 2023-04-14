<?php

class Persona{

  private $apellidos;
  private $nombres;
  private $estadoCivil;
  private $numeroHijo;
  private $telefono;

  // Métodos mágicos
  public function __GET($atributo){
    return $this->$atributo;
  }

  public function __SET($atributo, $valor){
    $this->$atributo = $valor;
  }

}

// INSTANCIA
$persona1 = new Persona();

$persona1->__SET("apellidos", "HERNANDEZ YEREN");
$persona1->__SET("nombres", "YORGHET FERNANDA");
$persona1->__SET("telefono", "946989937");

echo $persona1->__GET("apellidos");
echo $persona1->__GET("nombres");
echo $persona1->__GET("telefono");