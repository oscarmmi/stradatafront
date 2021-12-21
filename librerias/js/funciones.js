
var RUTA_API = "http://localhost:8000/api/busquedaCoincidencias";

$(document).ready(function () {
    funcionesClick();
    crearTablaCorrespondiente('tablaResultados', []);
    $("#graficaResultados").addClass('hidden');
});

function funcionesClick(){
    $("#btnBuscar").click(buscar);
    $("#btnExportar").click(confirmarExportar);
}

function confirmarExportar(){
    let datos = $('#tablaResultados').dataTable().fnGetData();
    if(!parseInt(datos.length)){
        alertify.error("- No hay datos para generar un CSV");
        return;
    }
    alertify.confirm(
        'Esta seguro que desea exportar los resultados actuales como archivo CSV? ',
        function () {
            let aleatorio = Math.floor(Math.random() * 1000);
            exportToCsv('resultadoCoincidencias_'+aleatorio, datos);
        }
    );
}

function validarCampos(){
    let respuesta = {
        errores: [], 
        datos: {}
    };
    respuesta.datos.nombre_buscado = document.querySelector("#nombre_buscado").value;
    if(respuesta.datos.nombre_buscado==''){
        respuesta.errores.push("- El nombre no puede estar vacío");
    }
    respuesta.datos.porcentaje_buscado = document.querySelector("#porcentaje_buscado").value;
    if(respuesta.datos.porcentaje_buscado==''){
        respuesta.errores.push("- El porcentaje de coincidencia no puede estar vacío");
    }else if(!$.isNumeric(respuesta.datos.porcentaje_buscado)){
        respuesta.errores.push("- El porcentaje de coincidencia debe ser un valor númerico");
    }else if(!Number.isInteger(parseInt(respuesta.datos.porcentaje_buscado))){
        respuesta.errores.push("- El porcentaje de coincidencia debe ser un valor entero");
    }else if(parseInt(respuesta.datos.porcentaje_buscado)<0 || parseInt(respuesta.datos.porcentaje_buscado)>100){
        respuesta.errores.push("- El porcentaje de coincidencia debe estar entre el rango de 0 a 100");
    }
    return respuesta;
}

function buscar(){
    let respuesta = validarCampos();
    if(parseInt(respuesta.errores.length)){
        for (const a in respuesta.errores) {
            alertify.error(respuesta.errores[a]);
        }
        return;
    }
    let datos = respuesta.datos;
    $.ajax({
        url: RUTA_API,
        data: {
            datos
        },
        type: 'POST',
        dataType: 'json',
        success: function (respuesta) {
            if($("#graficaResultados").hasClass('hidden')){
                $("#graficaResultados").removeClass('hidden');
            }
            if($("#btnExportar").hasClass('hidden')){
                $("#btnExportar").removeClass('hidden');
            }
            if(respuesta.estado_ejecucion){
                alertify.success(respuesta.estado_ejecucion);
            }
            crearTablaCorrespondiente('tablaResultados', respuesta.datos);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            if(XMLHttpRequest.responseJSON.estado_ejecucion){
                alertify.error(XMLHttpRequest.responseJSON.estado_ejecucion);
            }
            if(XMLHttpRequest.responseJSON.errors && parseInt(XMLHttpRequest.responseJSON.errors.length)){
                let numeroErrores = parseInt(XMLHttpRequest.responseJSON.errors.length);
                for(let i=0; i<numeroErrores; i++){
                    alertify.error(XMLHttpRequest.responseJSON.errors[i]['message']);
                }
            }
        }     
    });
}

function crearTablaCorrespondiente(id, datos) {
    if (parseInt(datos.length) === 0) {
        datos = [];
    }
    $('#' + id).DataTable({
        paging: 'numbers',
        bFilter: false,
        destroy: true,
        select: true,
        dom: 'T<"clear">lfrtip', // Permite cargar la herramienta tableTools
        tableTools: {
            aButtons: [],
            sRowSelect: "single"
        },
        data: datos,
        columns: [{
                data: 'nombre_encontrado',
                title: 'Nombre',
                className: 'text-capitalize'
            },
            {
                data: 'tipo_persona',
                title: 'Tipo Persona',
                className: 'text-capitalize dt-body-center dt-head-center'
            },
            {
                data: 'tipo_cargo',
                title: 'Tipo Cargo',
                className: 'text-capitalize dt-body-center dt-head-center'
            },
            {
                data: 'departamento',
                title: 'Departamento',
                className: 'text-capitalize dt-body-center dt-head-center'
            },
            {
                data: 'municipio',
                title: 'Municipio',
                className: 'text-capitalize dt-body-center dt-head-center'
            }
            ,
            {
                data: 'porcentaje_encontrado',
                title: '% Coincidencia',
                className: 'text-capitalize dt-body-center dt-head-center',
                render: function (data, type, full, meta) {
                    return data+' %';
                }
            }
        ]
    });
}

function exportToCsv(filename, rows) {
    var processRow = function (row) {
        let aCampos = [];
        for (const a in row) {
            aCampos.push(row[a]);
        }
        return aCampos.join(",")+ '\n';
    };
    var csvFile = 'Nombre, Tipo Persona, Tipo Cargo, Departamento, Municipio, % Coincidencia\n';
    for (var i = 0; i < rows.length; i++) {
        csvFile += processRow(rows[i]);
    }

    var blob = new Blob([csvFile], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, filename);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}