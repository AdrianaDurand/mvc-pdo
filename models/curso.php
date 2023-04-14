<?php

require_once "Conexion.php";

//MODELO = CONTIENE LA LÓGICA
// extends : HERENCIA (POO) en PHP
class Curso extends Conexion{

  // Objeto que almacena la conexión que viene desde el padre (Conexion) y la compartirá con todos los métodos (CRUD+)
  private $accesoBD;

  // Constructor
  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion(); //El valor de retorno de esta funcion ha sido asignada a este objeto. Si getConexion devuelve el retorno al acceso.
  }
  
   // Método listar cursos
   public function listarCursos(){
    try {
      // 1. Preparamos la consulta
     $consulta = $this->accesoBD->prepare("CALL spu_curso_listar()");
     // 2. Ejecutamos la consulta
     $consulta->execute();
     // 3. Devolvemos el resultado
     return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   public function registrarCurso($datos = []){
    try {
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_registrar_cursos(?,?,?,?,?)");
      // 2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["nombrecurso"],
          $datos["especialidad"], 
          $datos["complejidad"], 
          $datos["fechainicio"], 
          $datos["precio"]
        )
      );

    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   public function eliminarCurso($idcurso = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_eliminar(?)");
      $consulta->execute(array($idcurso));
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   public function getCurso($idcurso = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_recuperar_id(?)");
      $consulta->execute(array($idcurso));
      //Retornar el registro encontrado
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());  
    }
   }

   public function actualizarCurso($datos = []){
    try {
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_actualizar(?,?,?,?,?,?)");
      // 2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["idcurso"],
          $datos["nombrecurso"],
          $datos["especialidad"], 
          $datos["complejidad"], 
          $datos["fechainicio"], 
          $datos["precio"]
        )
      );
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

}

?>