<!doctype html>
<html lang="es">

<head>
  <title>USUARIO PDO</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

     <!-- Íconos de Bootstrap
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"-->

  <!-- ÍCONOS FONTAWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<div class="container mt-3">
    <div class="card">
      <div class="card-header bg-primary text-light">
        <div class="row">
          <div class="col-md-6">
            <strong>LISTA DE USUARIOS</strong>
          </div>
          <div class="col-md-6 text-end">
            <button class="btn btn-success btn-sm" id="abrir-modal-usuario" data-bs-toggle="modal" data-bs-target="#modal-registro-usuarios"><i class="fa-solid fa-folder-plus"></i> Registrar Usuario</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="table table-sm table-striped" id="tabla-usuarios">
          <colgroup> <!-- colgroup: Permite ordenar las tablas -->
            <col width = "5%">
            <col width = "10%">
            <col width = "20%">
            <col width = "20%">
            <col width = "15%">
            <col width = "20%">
            <col width = "10">
          </colgroup>
          <thead>
            <tr>
              <th>#</th>
              <th>Usuario</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Nivel Acceso</th>
              <th>Fecha Registro</th>
              <th>Operaciones</th>
            </tr>
          </thead>
          <!-- DATOS DE PRUEBA -->
          <tbody>
          </tbody> <!-- FIN DE DATOS PRUEBA-->
        </table>
      </div>
    </div>
    <div class="card-footer text-end">
      <a href="../controllers/usuario.controller.php?operacion=finalizar">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"></path>
      <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path>
    </svg>  
      Cerrar sesión</a>
    </div>
  </div>
</div> <!-- FIN DEL CONTAINER -->

<div class="modal fade" id="modal-registro-usuarios" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modal-titulo">Registrar Usuarios</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="formulario-registro" autocomplete="off">
            <div class="mb-3">
              <label for="nombreusuario" class="form-label">Nombre Usuario</label>
              <input type="text" class="form-control form-control-sm" id="nombreusuario">
            </div>
            <div class="mb-3">
              <label for="claveacceso" class="form-label">Contraseña</label>
              <input type="password" class="form-control form-control-sm" id="claveacceso">
            </div>
            <div class="mb-3">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control form-control-sm" id="apellidos">
            </div>
            <div class="mb-3">
              <label for="nombres" class="form-label">Nombres</label>
              <input type="text" class="form-control form-control-sm" id="nombres">
            </div>
            <div class="mb-3">
              <label for="nivelacceso" class="form-label">Nivel Acceso</label>
              <select id="nivelacceso" class="form-select form-select-sm">
                <option value="">Seleccione</option>
                <option value="S">Supervisor</option>
                <option value="A">Administrador</option>
                <option value="I">Invitado</option>
              </select>
            </div>
            <!--<div class="mb-3">
              <label for="fecharegistro" class="form-label">Fecha de registro:</label>
              <input type="datetime-local" class="form-control form-control-sm" id="fecharegistro">
            </div>-->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success btn-sm" id="guardar-usuario">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script>
    $(document).ready(function (){

      function mostrarUsuarios(){
        $.ajax({
          url: '../controllers/usuario.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#tabla-usuarios tbody").html(result);
          }
        });
      }

      // REGISTRAR
      function registrarUsuario(){
        if(confirm("¿Está seguro de registrar este nuevo curso?")){
          $.ajax({
            url : '../controllers/usuario.controller.php',
            type : 'POST',
            data : {
              operacion : 'registrar',
              nombreusuario : $("#nombreusuario").val(),
              claveacceso : $("#claveacceso").val(),
              apellidos : $("#apellidos").val(),
              nombres : $("#nombres").val(),
              nivelacceso : $("#nivelacceso").val()
              //fecharegistro : $("#fecharegistro").val()
            },
            success: function(result){
              if (result == ""){
                $("#formulario-registro")[0].reset();

                mostrarUsuarios();

                $("#modal-registro-usuarios").modal('hide');
              }
            }
          });
        }
      }

      // FUNCION DE ABRIR MODAL
      function abrirModal(){
        datosNuevos = true;
        $("#modal-titulo").html("Registro de usuarios");
        $("#formulario-registro")[0].reset();
      }

      // Evento
      $("#guardar-usuario").click(registrarUsuario);
      $("#abrir-modal-usuario").click(abrirModal);

      

      $("#tabla-usuarios tbody").on("click", ".eliminar", function(){
        const idusuarioEliminar = $(this).data("idusuario");
        if (confirm("¿Está seguro de proceder?")){
          $.ajax({
            url: '../controllers/usuario.controller.php',
            type: 'POST',
            data: {
              operacion   : 'eliminar',
              idusuario   : idusuarioEliminar
            },
            success: function(result){
              if(result == ""){
              mostrarUsuarios();
              }
            }
          });
        }
      });

      // DETECTAR clic en EDITAR
      $("#tabla-usuarios tbody").on("click", ".editar", function(){
        const idusuarioeditar = $(this).data("idusuario");
        $.ajax({
          url : '../controllers/usuario.controller.php',
          type: 'POST',
          data : {
            operacion : 'obtenerusuario',
            idusuario : idusuarioeditar
          },
          dataType: 'JSON',
          success: function(result){
            console.log(result);

            // CONFIGURAR BANDERA
            datosNuevos = false;

            // RETORNANDO
            $("#nombreusuario").val(result["nombreusuario"]);
            $("#claveacceso").val(result["claveacceso"]);
            $("#apellidos").val(result["apellidos"]);
            $("#nombres").val(result["nombres"]);
            $("#nivelacceso").val(result["nivelacceso"]);

            // CAMBIAR TÍTULO MODAL
            $("#modal-titulo").html("Actualizar datos de curso");

            // PONEMOS AL MODAL EN PANTALLA
            $("#modal-registro-usuarios").modal("show");
          }
        });
      });


    // Ejecución automática
    mostrarUsuarios();

    });
  </script>
</body>

</html>