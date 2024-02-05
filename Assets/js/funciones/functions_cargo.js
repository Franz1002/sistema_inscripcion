let tableCargos;
document.addEventListener('DOMContentLoaded', function () {
    tableCargos = $('#tableCargos').dataTable({
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
            "url": " " + baseUrl + "/Cargos/getCargos",
            "dataSrc": ""
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columns": [
            {
                "data": "idcargo"
            },
            {
                "data": "nombrecargo"
            },
            {
                "data": "descripcion"
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

//Abre el modal Cargo
function openModalCargo() {
    document.querySelector('#idCargo').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Guardar";
    document.getElementById("title").innerHTML = "Nuevo Cargo";
    document.getElementById("ndc").classList.replace("control-label", "float-label");
    document.getElementById("ddc").classList.replace("control-label", "float-label");
    document.getElementById("modalFormCargo").reset();
    $("#modalNuevoCargo").modal("show");
}
//Nuevo cargo
function registrarCargo(e) {
    e.preventDefault();

    const intIdCargo = document.querySelector('#idCargo').value;
    const strNombreCargo = document.getElementById("txtNombreCargo");
    const strDescripcion = document.getElementById("txtDescripcion");
    const intEstado = document.getElementById("listEstado");
    if (strNombreCargo.value == "" || strDescripcion.value == "" || intEstado.value == "") {
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
        const ajaxUrl = baseUrl + '/Cargos/setCargo';
        const form = document.getElementById("modalFormCargo");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>REGISTRADO</u></strong>',
                        html: '<h2>Cargo registrados exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoCargo').modal("hide");
                    modalFormCargo.reset();
                    tableCargos.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Cargo modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoCargo').modal("hide");
                    modalFormCargo.reset();
                    tableCargos.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>El cargo ya existe</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }


            }
        }

    }
}



function btnEditCargo(idcargo) {
    document.getElementById("title").innerHTML = "Actualizar cargo";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("ndc").classList.replace("float-label", "control-label");
    document.getElementById("ddc").classList.replace("float-label", "control-label");
    document.getElementById("btnText").innerHTML = "Actualizar";
    tableCargos.api().ajax.reload();
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Cargos/editCargo/' + idcargo;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idCargo").value = result.data.idcargo;
                document.getElementById("txtNombreCargo").value = result.data.nombrecargo;
                document.getElementById("txtDescripcion").value = result.data.descripcion;

                if (result.data.estado == 1) {
                    document.getElementById("listEstado").value = 1;
                } else {
                    document.getElementById("listEstado").value = 2;
                }
                $('#listEstado').selectpicker('render');
                $('#modalNuevoCargo').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnDeleteCargo(idcargo) {
    Swal.fire({
        title: 'Eliminar Cargo',
        text: "Confirma si desea eliminar el cargo",
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
            const ajaxUrl = baseUrl + '/Cargos/deleteCargo/';
            const strData = "idcargo="+idcargo;
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
                            'Cargo eliminado con éxito.',
                            'success'
                        )
                        tableCargos.api().ajax.reload();       
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


