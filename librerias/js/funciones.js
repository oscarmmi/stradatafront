
var RUTA_API = "http://localhost:8000/api/busquedaCoincidencias";

$(document).ready(function () {
    funcionesClick();
    crearTablaCorrespondiente('tablaResultados', []);
    $("#graficaResultados").addClass('hidden');
});

function funcionesClick(){
    $("#btnBuscar").click(buscar);
}

function validarCampos(){
    let respuesta = {
        errores: [], 
        datos: {}
    };
    respuesta.datos.nombrecompleto = document.querySelector("#nombrecompleto").value;
    if(respuesta.datos.nombrecompleto==''){
        respuesta.errores.push("- El nombre no puede estar vacío");
    }
    respuesta.datos.porcentajecoincidencia = document.querySelector("#porcentajecoincidencia").value;
    if(respuesta.datos.porcentajecoincidencia==''){
        respuesta.errores.push("- El porcentaje de coincidencia no puede estar vacío");
    }else if(!$.isNumeric(respuesta.datos.porcentajecoincidencia)){
        respuesta.errores.push("- El porcentaje de coincidencia debe ser un valor númerico");
    }else if(!Number.isInteger(parseInt(respuesta.datos.porcentajecoincidencia))){
        respuesta.errores.push("- El porcentaje de coincidencia debe ser un valor entero");
    }else if(parseInt(respuesta.datos.porcentajecoincidencia)<0 || parseInt(respuesta.datos.porcentajecoincidencia)>100){
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
            crearTablaCorrespondiente('tablaResultados', respuesta.data);
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
                data: 'nombre',
                title: 'Nombre',
                className: 'text-capitalize'
            },
            {
                data: 'tipopersona',
                title: 'Tipo Persona',
                className: 'text-capitalize'
            },
            {
                data: 'tipocargo',
                title: 'Tipo Cargo',
                className: 'text-capitalize dt-body-center'
            },
            {
                data: 'departamento',
                title: 'Departamento',
                className: 'text-capitalize dt-body-center'
            },
            {
                data: 'municipio',
                title: 'Municipio',
                className: 'text-capitalize dt-body-center'
            }
        ]
    });
}