let tablePeriodo;
document.addEventListener('DOMContentLoaded', function () {
    tablePeriodo = $('#tablePeriodo').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + baseUrl + "/Periodos/getPeriodos",
            "dataSrc": ""
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columns": [
            {
                "data": "idperiodo"
            },
            {
                "data": "anio"
            },
            {
                "data": "fechaInicio"
            },
            {
                "data": "fechaFinal"
            }, 
            {
                "data": "estado"
            },            
            {
                "data": "opciones"
            }
        ],
    });
})

function openModalPeriodo(){
    //document.querySelector('#idTutor').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Registrar";
    document.getElementById("title").innerHTML = "Registrar Nuevo periodo";
    document.getElementById("modalFormPeriodo").reset();
    $("#modalNuevoPeriodo").modal("show");
}

//Nuevo periodo académico
function registrarPeriodo(e) {
    e.preventDefault();

    const intIdPeriodo = document.querySelector('#idPeriodo').value;
    const intPeriodoacademico = document.getElementById("intPeriodo");
    const dateFechaInicio = document.getElementById("dateFechaInicio");
    const dateFechaFinal = document.getElementById("dateFechaFinal");
    if (intPeriodoacademico.value == "" || dateFechaInicio.value == "" || dateFechaFinal.value == "") {
        Swal.fire({
            icon: 'error',
            showCloseButton: true,
            title: 'Error!',
            text: 'Todos los campos son obligatorios',
            color: '#716add',
            timer: '5000',
            timerProgressBar: 'true',
            background: '#fffff',
            backdrop: `
                      rgba(2,0,106,0.3)                     
                      left top
                      no-repeat
                  `
        });

    } else {
        const xhttp = new XMLHttpRequest();
        const ajaxUrl = baseUrl + '/Periodos/setPeriodo';
        const form = document.getElementById("modalFormPeriodo");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>REGISTRADO</u></strong>',
                        html: '<h2>Periodo registrado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoPeriodo').modal("hide");
                    modalFormPeriodo.reset();
                    tablePeriodo.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Periodo modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoPeriodo').modal("hide");
                    modalFormPeriodo.reset();
                    tablePeriodo.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>El periodo ya existe</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }


            }
        }

    }
}
function btnViewPeriodo(idperiodo){ //para extraer datos
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Periodos/verPeriodo/' + idperiodo;
    xhttp.open("GET",ajaxUrl,true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            const result = JSON.parse(xhttp.responseText);
            if(result.status)
            {
                const estadoPeriodo = result.data.estado == 1 ?
                '<span class="badge badge-success" style="align: center; width:70%; text-align: center;">1</span>' :
                '<span class="badge badge-danger" style="align: center; width:70%; text-align: center;">2</span>';

                document.getElementById("viewAnio").innerHTML = result.data.anio;
                document.getElementById("viewFechaInicio").innerHTML = result.data.fechaInicio;                 
                document.getElementById("viewFechaFinal").innerHTML = result.data.fechaFinal;    
                document.getElementById("viewEstadoPeriodo").innerHTML = estadoPeriodo;   

                $('#modalViewPeriodo').modal('show');
            }else{
                swal("Error", result.msg, "error");
            }
        }
}  
     
}

function btnEditPeriodo(idperiodo) {
    document.getElementById("title").innerHTML = "Actualizar Periodo Académico";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("pae").classList.replace("float-label", "control-label");


    document.getElementById("btnText").innerHTML = "Actualizar";
    tablePeriodo.api().ajax.reload();
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Periodos/editPeriodo/' + idperiodo;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idPeriodo").value = result.data.idperiodo;
                document.getElementById("intPeriodo").value = result.data.anio;
                document.getElementById("dateFechaInicio").value = result.data.fechainicio;
                document.getElementById("dateFechaFinal").value = result.data.fechafinal;
                document.getElementById("listEstadoPeriodo").value = result.data.estado;

                if (result.data.estado == 1) {
                    document.getElementById("listEstadoPeriodo").value = 1;
                } else {
                    document.getElementById("listEstadoPeriodo").value = 2;
                }

                $('#listEstadoPeriodo').selectpicker('render');
                $('#modalNuevoPeriodo').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnDeletePeriodo(idperiodo) {
    Swal.fire({
        title: 'Eliminar Periodo académico',
        text: "Confirma si desea eliminar el periodo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5B77F5',
        cancelButtonColor: '#FF7272',    
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText:'No, cancelar',
        closeOnConfirm: false,
        closeOnCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            const ajaxUrl = baseUrl + '/Periodos/deletePeriodo/';
            const strData = "idperiodo="+idperiodo;
            const xhttp = new XMLHttpRequest();

            xhttp.open("POST", ajaxUrl, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(strData);
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    const result = JSON.parse(xhttp.responseText);
                    if (result.status) {
                        Swal.fire(
                            'Mensaje!',
                            'Periodo académico eliminado con éxito.',
                            'success'
                        )
                        tablePeriodo.api().ajax.reload();       
                    }else{
                        Swal.fire(
                            'Mensaje!',
                            result,
                            'error'
                        )   
                    }
                }
            }
        }
    })   
}