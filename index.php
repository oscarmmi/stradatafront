<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stradata Front</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="librerias/js/jquery-3.3.1.js"></script>
        <script src="librerias/js/bootstrap.min.js"></script>
        <script src="librerias/js/alertify.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="librerias/css/alertify.min.css" />
        <!-- Default theme -->
        <link rel="stylesheet" href="librerias/css/default.min.css" />
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="librerias/css/semantic.min.css" />
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="librerias/css/alertify-bootstrap.min.css" />

        <script src="librerias/js/Chart.bundle.min.js"></script>
        <script src="librerias/js/Chart.js"></script>
        <link rel="stylesheet" href="librerias/css/Chart.css"/>


        <script type="text/javascript" src="librerias/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="librerias/js/dataTables.select.min.js"></script>
        <script type="text/javascript" src="librerias/js/dataTables.buttons.min.js"></script>

        <link rel="stylesheet" href="librerias/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="librerias/css/select.dataTables.min.css" />
        <link rel="stylesheet" href="librerias/css/buttons.dataTables.min.css" />

        <style>
            .margensuperior {
                margin-top:10px;
            }
        </style>

        <script src="librerias/js/funciones.js"></script>
    </head>
    <body class="container-fluid">
        <div class="row margensuperior">
            <div class="col-lg-12">
                <div class="row" style="margin-top:30px;">
                    <div class="col-lg-8">
                        &nbsp;
                    </div>
                    <div id="botonesIngreso" class="col-lg-4 text-right">
                        <button type="button" id="btnIngreso" class="btn btn-primary">
                            Ingresar
                        </button>
                    </div>
                    <div id="botonesLogueado" class="col-lg-4 hidden">
                        <h5>
                            Bienvenido, <span id="emailUsuario" class="text-primary"></span>
                            &nbsp;&nbsp;&nbsp;
                            <span id="btnCerrarSesion"
                                class="glyphicon glyphicon-remove text-danger" 
                                aria-hidden="true" title="Cerrar Sesi??n"
                                style="cursor:pointer;"></span>
                        </h5>
                        
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#buscador">
                            Buscador
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#historico">
                            Historico
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="buscador" class="tab-pane fade in active">
                        <div class="row" style="margin-top:50px;">
                            <div class="col-lg-4">
                                <span class="h5" style="cursor:help;font-weight: bold;" title="Nombres y Apellidos">
                                    Nombres y Apellidos
                                </span>
                            </div>
                            <div class="col-lg-4">
                                <span class="h5" style="cursor:help;font-weight: bold;" title="Porcentaje coincidencia">
                                    Porcentaje coincidencia
                                </span>
                            </div>
                            <div class="col-lg-4">
                                &nbsp;
                            </div>  
                            <div class="col-lg-4 margensuperior">
                                <input type="text" class="form-control" 
                                    id="nombre_buscado" 
                                    placeholder="Ej: Alejandro Hernandez">
                            </div>  
                            <div class="col-lg-4 margensuperior">
                                <input type="text" class="form-control" 
                                    id="porcentaje_buscado" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                    placeholder="Ej: 95">
                            </div>  
                            <div class="col-lg-4 margensuperior">
                                <button id="btnBuscar" class="btn btn-primary">Buscar</button>
                                <button id="btnExportar" class="btn btn-info hidden">Exportar</button>
                            </div>                                
                        </div>   

                        
                        <div id="graficaResultados" class="row margensuperior">
                            <div  class="col-lg-12">
                                <h4 class="text-success">
                                    Resultados
                                </h4>
                            </div>
                            <div  class="col-lg-12">
                                <h5>
                                    Esta consulta y sus resultados fueron almacenadas con el identificador unico (Uuid) # 
                                    <span id="texto_uuid" style="cursor:pointer;" 
                                        class="text-primary h4"></span>
                                </h5>
                            </div>
                            <div  class="col-lg-12 margensuperior">
                                <table id="tablaResultados" class="table table-bordered table-striped display"></table>
                            </div>
                        </div>
                    </div>
                    <div id="historico" class="tab-pane fade">
                        <div class="row" style="margin-top:50px;">
                            <div class="col-lg-4">
                                <span class="h5" style="cursor:help;font-weight: bold;" title="Identificador ??nico(Uuid) del historico de las consultas realizadas">
                                    Uuid
                                </span>
                            </div>
                            <div class="col-lg-8">
                                &nbsp;
                            </div>  
                            <div class="col-lg-4 margensuperior">
                                <input type="text" class="form-control" 
                                    id="uuid" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                    placeholder="Ej: Digite el uuid de la consulta">
                            </div>  
                            <div class="col-lg-4 margensuperior">
                                <button id="btnBuscarUuid" class="btn btn-primary">Buscar</button>                                
                            </div>                                
                        </div>   

                        <div id="resultadosLog" class="row margensuperior hidden">
                            <div  class="col-lg-12">
                                <h4 class="text-success">
                                    Resultados Historicos
                                </h4>
                            </div>
                            <div  class="col-lg-6 busqueda_log_error">
                                <h5 class="text-danger">
                                    La consulta realizada no arroj?? resultados
                                </h5>
                            </div>
                            <div  class="col-lg-6 busqueda_log_exitoso">
                                <h5>
                                    Uuid: &nbsp;
                                    <span id="log_uuid" style="cursor:pointer;" 
                                        class="text-primary h4"></span>
                                </h5>
                            </div>
                            <div  class="col-lg-6 busqueda_log_exitoso">
                                <h5>
                                    Nombre Buscado: &nbsp;
                                    <span id="log_nombre_buscado" style="cursor:pointer;" 
                                        class="text-primary h4"></span>
                                </h5>
                            </div>
                            <div  class="col-lg-6 busqueda_log_exitoso">
                                <h5>
                                    Porcentaje Buscado: &nbsp;
                                    <span id="log_porcentaje_buscado" style="cursor:pointer;" 
                                        class="text-primary h4"></span>
                                </h5>
                            </div>
                            <div  class="col-lg-6 busqueda_log_exitoso">
                                <h5>
                                    Registros Encontrados: &nbsp;
                                    <span id="log_registros_encontrados" style="cursor:pointer;" 
                                        class="text-primary h4"></span>
                                </h5>
                            </div>
                            <div  class="col-lg-6 busqueda_log_exitoso">
                                <h5>
                                    Estado ejecuci&oacute;n: &nbsp;
                                    <span id="log_estado_ejecucion" style="cursor:pointer;" 
                                        class="text-primary h4"></span>
                                </h5>
                            </div>
                            <div  class="col-lg-6 busqueda_log_exitoso">
                                <h5>
                                    Fecha de Creaci&oacute;n: &nbsp;
                                    <span id="log_created_at" style="cursor:pointer;" 
                                        class="text-primary h4"></span>
                                </h5>
                            </div>
                            <div  class="col-lg-12">
                                <h4 class="text-success">
                                    Detalles relacionados con el Uuid Buscado
                                </h4>
                                <button id="btnExportarLog" class="btn btn-info hidden">
                                    Exportar
                                </button>
                            </div>
                            <div  class="col-lg-12 margensuperior busqueda_log_exitoso">
                                <table id="tablaResultadosLog" class="table table-bordered table-striped display"></table>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>    
          
        <!-- Modal -->
        <div id="modalAuth" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Autenticaci&oacute;n</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row margensuperior">
                            <div class="col-lg-12">
                                <h5>
                                    Ingrese sus credenciales de acceso
                                </h5>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" style="cursor:help;" title="Email">
                                        Email
                                    </span>
                                    <input type="email" class="form-control ingreso" id="ingreso_email" 
                                        onblur="validarEmail(this)">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon" style="cursor:help;" 
                                        title="Contrase??a">
                                        Contrase??a
                                    </span>
                                    <input type="password" class="form-control ingreso" 
                                        id="ingreso_password" onblur="validarPassword(this)">
                                </div>
                            </div>
                            <div class="col-lg-2 margensuperior">
                                <button type="button" id="btnIngresarLogin" class="btn btn-primary">
                                    Ingresar
                                </button>                        
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
