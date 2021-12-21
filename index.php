<!DOCTYPE html>
<html lang="en">

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
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">Buscador</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row top-buffer">
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
                                <div  class="col-lg-12 margensuperior">
                                    <table id="tablaResultados" class="table table-bordered table-striped display"></table>
                                </div>
                            </div>
                            

                        </div>
                    </div>

                    
                </div>
            </div>
        </div>    
          
    </body>
</html>
