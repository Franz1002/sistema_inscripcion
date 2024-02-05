let tableTutores;
document.addEventListener('DOMContentLoaded', function () {
    tableTutores = $('#tableTutores').dataTable({
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
            "url": " " + baseUrl + "/Tutores/getTutores",
            "dataSrc": ""
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columns": [
            {
                "data": "idtutor"
            },
            {
                "data": "citutor"
            },
            {
                "data": "expedido"
            },
            {
                "data": "nombres"
            },
            {
                "data": "apellidos"
            },
            {
                "data": "parentesco"
            },
            {
                "data": "telefono"
            },
            {
                "data": "opciones"
            }
        ],
    });
})
//abre el modan para registrar un nuevo tutor
function openModalTutor(){
    document.querySelector('#idTutor').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Registrar";
    document.getElementById("title").innerHTML = "Registrar Nuevo tutor";
    document.getElementById("modalFormTutor").reset();
    $("#modalNuevoTutor").modal("show");
}

//Nuevo TUTOR
function registrarTutor(e) {
    e.preventDefault();

    const intIdTutor = document.querySelector('#idTutor').value;
    const intCiTutor = document.getElementById("txtCiTutor");
    const strExpedido = document.getElementById("listExpedido");
    const strParentesco = document.getElementById("listParentesco");
    const strNombreTutor = document.getElementById("txtNombreTutor");
    const strApellidoTutor = document.getElementById("txtApellidoTutor");
    const intTelefonoTutor = document.getElementById("intTelefonoTutor");
 
    if (intCiTutor.value == "" || strExpedido.value == 0 
    || strParentesco.value == 0 || strNombreTutor.value == "" 
    || strApellidoTutor.value == "" || strApellidoTutor.value == ""
    || intTelefonoTutor.value == "") {
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
        const ajaxUrl = baseUrl + '/Tutores/setTutor';
        const form = document.getElementById("modalFormTutor");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>REGISTRADO</u></strong>',
                        html: '<h2>Tutor registrado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoTutor').modal("hide");
                    modalFormTutor.reset();
                    tableTutores.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Tutor modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoTutor').modal("hide");
                    modalFormTutor.reset();
                    tableTutores.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>Carnet de identidad del tutor ya existe</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }


            }
        }

    }
}


function btnViewTutor(idtutor){ //para extraer datos
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Tutores/verTutor/' + idtutor;
    xhttp.open("GET",ajaxUrl,true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            const result = JSON.parse(xhttp.responseText);
            if(result.status)
            {
                const estadoEstudiante = result.data.estado == 1 ?
                '<span class="badge badge-success" style="align: center; width:70%; text-align: center;">Habilitado</span>' :
                '<span class="badge badge-danger" style="align: center; width:70%; text-align: center;">Abandonado</span>';

                document.getElementById("viewFotoEstudiante").innerHTML = '<img src="'+result.data.url_image+'"></img>';   
                document.getElementById("viewRudeEstudiante").innerHTML = result.data.rude;
                document.getElementById("viewCiEstudiante").innerHTML = result.data.ciestudiante;                 
                document.getElementById("viewExpedidoEstudiante").innerHTML = result.data.expedido;
                document.getElementById("viewPrimerNombreEstudiante").innerHTML = result.data.primernombre;   
                document.getElementById("viewSegundoNombreEstudiante").innerHTML = result.data.segundonombre;
                document.getElementById("viewApellidoPaternoEstudiante").innerHTML = result.data.apellidopaterno;   
                document.getElementById("viewApellidoMaternoEstudiante").innerHTML = result.data.apellidomaterno;
                document.getElementById("viewFechaNacimientoEstudiante").innerHTML = result.data.fechaNacimiento;   
                document.getElementById("viewGeneroEstudiante").innerHTML = result.data.genero;
                document.getElementById("viewDeptoEstudiante").innerHTML = result.data.deptonacido;   
                document.getElementById("viewDomicilioEstudiante").innerHTML = result.data.domicilio;
                document.getElementById("viewEstadoEstudiante").innerHTML = estadoEstudiante;
                document.getElementById("viewCiTutor").innerHTML = result.data.citutor;
                document.getElementById("viewExpedidoTutor").innerHTML = result.data.expedido;   
                document.getElementById("viewNombreTutor").innerHTML = result.data.nombres;  
                document.getElementById("viewApellidosTutor").innerHTML = result.data.apellidos;  
                document.getElementById("viewParentescoTutor").innerHTML = result.data.parentesco;  
                document.getElementById("viewTelefonoTutor").innerHTML = result.data.telefono;  
                $('#modalViewTutor').modal('show');
            }else{
                swal("Error", result.msg, "error");
            }
        }
}  
     
}

function btnEditTutor(idtutor) {
    document.getElementById("title").innerHTML = "Actualizar Tutor";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("cdt").classList.replace("float-label", "control-label");
    document.getElementById("ndt").classList.replace("float-label", "control-label");
    document.getElementById("adt").classList.replace("float-label", "control-label");
    document.getElementById("tdt").classList.replace("float-label", "control-label");
    document.getElementById("btnText").innerHTML = "Actualizar";
    tableTutores.api().ajax.reload();
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Tutores/editTutor/' + idtutor;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idTutor").value = result.data.idtutor;
                document.getElementById("txtCiTutor").value = result.data.citutor;
                document.getElementById("listExpedido").value = result.data.expedido;
                document.getElementById("listParentesco").value = result.data.parentesco;
                document.getElementById("txtNombreTutor").value = result.data.nombres;
                document.getElementById("txtApellidoTutor").value = result.data.apellidos;
                document.getElementById("intTelefonoTutor").value = result.data.telefono;
                document.getElementById("listRudes").value = result.data.estudianteid;
                    
                $('#modalNuevoTutor').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnDeleteTutor(idtutor) {
    Swal.fire({
        title: 'Eliminar Tutor',
        text: "Confirma si desea eliminar al tutor",
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
            const ajaxUrl = baseUrl + '/Tutores/deleteTutor/';
            const strData = "idtutor="+idtutor;
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
                            'Tutor eliminado con éxito.',
                            'success'
                        )
                        tableTutores.api().ajax.reload();       
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