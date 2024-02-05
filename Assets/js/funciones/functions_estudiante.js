let tableEstudiantes;
document.addEventListener('DOMContentLoaded', function () {
    tableEstudiantes = $('#tableEstudiantes').dataTable({
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
            "url": " " + baseUrl + "/Estudiantes/getEstudiantes",
            "dataSrc": ""
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columns": [         
            {
                "data": "rude"
            },
            {
                "data": "ciestudiante"
            },  
            {
                "data": "expedido"
            },
            {
                "data": "apellidopaterno"
            },
            {
                "data": "apellidomaterno"
            },
            {
                "data": "primernombre"
            },
            {
                "data": "segundonombre"
            },
           
            {
                "data": "estado"
            },
            {
                "data": "opciones"
            }
        ],
    });
    
    $("#listRudes").autocomplete({
        appendTo: "#modalNuevoTutor", 
       
        source: function (request, response) {
            $.ajax({
                url: "ajax.php",
                dataType: "json",
                data: {
                    est: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        focus: function (event, ui) {
            $("#idTutor").val(ui.id); 
            $("#listRudes").val(ui.item.label);
            $("#primerNombre").val(ui.item.pNombre);
            $("#segundoNombre").val(ui.item.sNombre);
            $("#apellidoPaterno").val(ui.item.aPaterno);
            $("#apellidoMaterno").val(ui.item.aMaterno);
        }
    })
})

//Abrir modal estudiante
function openModalEstudiante() {
    document.querySelector('#idEstudiante').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Registrar";
    document.getElementById("title").innerHTML = "Registrar Nuevo estudiante";
    document.getElementById("modalFormEstudiante").reset();
    $("#modalNuevoEstudiante").modal("show");
    removePhoto();
}


window.addEventListener('load', function () {
    //selectTutorEstudiante();
    selectCedulaEstudiante();
}, false);

function selectCedulaEstudiante() {
    if (document.getElementById('listCedula')) {
        const ajaxUrl = baseUrl + '/Estudiantes/getSelectCedulas';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listCedula').innerHTML = xhttp.responseText;
                $('#listCedula').selectpicker('render');
            }
        }
    }

}
/*function selectTutorEstudiante() {
    if (document.getElementById('listTutorid')) {
        const ajaxUrl = baseUrl + '/Tutores/getSelectTutores';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listTutorid').innerHTML = xhttp.responseText;
                $('#listTutorid').selectpicker('render');
            }
        }
    }

}*/

//Nuevo estudiante
function registrarEstudiante(e) {
    e.preventDefault();

    const intIdEstudiante = document.querySelector('#idEstudiante').value;
    const strCiEstudiante = document.getElementById("txtCiEstudiante");
    const strExpedidoEstudiante = document.getElementById("listExpedidoEstudiante");
    const strPrimerNombre = document.getElementById("txtPrimerNombre");
    const strSegundoNombre = document.getElementById("txtSegundoNombre");
    const strApellidoPaterno = document.getElementById("txtApellidoPaterno");
    const strApellidomaterno = document.getElementById("txtApellidoMaterno");
    const strFechaNacimiento = document.getElementById("dateFechaNacimiento");
    const strGeneroEstudiante = document.getElementById("listGenero");
    const strDeptoNacido = document.getElementById("listDepartamentoEstudiante");
    const strDomicilioEstudiante = document.getElementById("txtDomicilioEstudiante");
    const intMatriculaid = document.getElementById("intMatricula");
    const intEstado = document.getElementById("listEstado");
    if (strCiEstudiante.value == "" ||
        strExpedidoEstudiante.value == 0 ||
        strPrimerNombre.value == "" ||
        strApellidoPaterno.value == "" ||        
        strFechaNacimiento.value == "" ||
        strGeneroEstudiante.value == 0 ||
        strDeptoNacido.value == 0 ||
        strDomicilioEstudiante.value == "" ||
        intMatriculaid.value == "" ||      
        intEstado.value == "") {
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
        const ajaxUrl = baseUrl + '/Estudiantes/setEstudiante';
        const form = document.getElementById("modalFormEstudiante");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>REGISTRADO</u></strong>',
                        html: '<h2>Estudiante registrado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoEstudiante').modal("hide");
                    modalFormEstudiante.reset();
                    tableEstudiantes.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Estudiante modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoEstudiante').modal("hide");
                    modalFormEstudiante.reset();
                    tableEstudiantes.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>El estudiante ya existe</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }
            }
        }
    }
}

//Nuevo TUTOR
function registrarTutore(e) {
    e.preventDefault();

    const intIdTutor = document.querySelector('#idTutor').value;
    const intCiTutor = document.getElementById("txtCiTutor");
    const strExpedido = document.getElementById("listExpedido");
    const strParentesco = document.getElementById("listParentesco");
    const strNombreTutor = document.getElementById("txtNombreTutor");
    const strApellidoTutor = document.getElementById("txtApellidoTutor");
    const intTelefonoTutor = document.getElementById("intTelefonoTutor");
    const intEstudiante = document.getElementById("listRudes");



 
    if (intCiTutor.value == "" || strExpedido.value == 0 
    || strParentesco.value == 0 || strNombreTutor.value == "" 
    || strApellidoTutor.value == "" || strApellidoTutor.value == ""
    || intTelefonoTutor.value == "" || intEstudiante.value == "") {
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
        const ajaxUrl = baseUrl + '/Estudiantes/setTutore';
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
                        html: '<h2>Asignación exitosa</h2>',
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
                        html: '<h2>La asignación ya existe</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }


            }
        }

    }
}


function btnViewEstudiante(rude){ //para extraer datos
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Estudiantes/verEstudiante/' + rude;
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
                $('#modalViewEstudiante').modal('show');
            }else if(result.statusss){
                Swal.fire({
                    icon: 'error',
                    title: '<strong><u>Error</u></strong>',
                    html: '<h2>Debe asignar un tutor para ver estudiante</h2>',
                    showConfirmButton: true,
                    timer: 4000
                });
            }
        }
}  
     
}

function btnEditEstudiante(idestudiante) {
    document.getElementById("title").innerHTML = "Actualizar Estudiante";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("cde").classList.replace("float-label", "control-label");
    document.getElementById("pne").classList.replace("float-label", "control-label");
    document.getElementById("sne").classList.replace("float-label", "control-label");
    document.getElementById("ape").classList.replace("float-label", "control-label");
    document.getElementById("ame").classList.replace("float-label", "control-label");
    document.getElementById("dme").classList.replace("float-label", "control-label");
    document.getElementById("cre").classList.replace("float-label", "control-label");

    document.getElementById("btnText").innerHTML = "Actualizar";
    tableEstudiantes.api().ajax.reload();
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Estudiantes/editEstudiante/' + idestudiante;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idEstudiante").value = result.data.idestudiante;
                document.getElementById("txtCiEstudiante").value = result.data.ciestudiante;
                document.getElementById("listExpedidoEstudiante").value = result.data.expedido;
                document.getElementById("txtPrimerNombre").value = result.data.primernombre;
                document.getElementById("txtSegundoNombre").value = result.data.segundonombre;
                document.getElementById("txtApellidoPaterno").value = result.data.apellidopaterno;
                document.getElementById("txtApellidoMaterno").value = result.data.apellidomaterno;
                document.getElementById("dateFechaNacimiento").value = result.data.fechanacimiento;
                document.getElementById("listGenero").value = result.data.genero;
                document.getElementById("listDepartamentoEstudiante").value = result.data.deptonacido;
                document.getElementById("txtDomicilioEstudiante").value = result.data.domicilio;
                document.getElementById("intMatricula").value = result.data.rude;
                document.getElementById("listEstado").value = result.data.estado;
                document.getElementById("foto_actual").value = result.data.fotoestudiante;  
                document.getElementById("foto_remove").value = 0;
                   
                if(result.data.estado == 1){
                    document.querySelector("#listEstado").value = 1;
                }else{
                    document.querySelector("#listEstado").value = 2;
                }
                $('#listEstado').selectpicker('render');

                if(document.getElementById('img')){
                    document.getElementById('img').src = result.data.url_image;
                }else{
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+result.data.url_image+">";
                }
                if(result.data.fotoestudiante == 'defect.png'){
                    document.querySelector('.delPhoto').classList.add("notBlock");                    
                }else{
                    document.querySelector('.delPhoto').classList.remove("notBlock");  
                }

                $('#modalNuevoEstudiante').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnDeleteEstudiante(rude) {
    Swal.fire({
        title: 'Eliminar Estudiante',
        text: "Confirma si desea eliminar al estudiante",
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
            const ajaxUrl = baseUrl + '/Estudiantes/deleteEstudiante/';
            const strData = "rude="+rude;
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
                            'Estudiante eliminado con éxito.',
                            'success'
                        )
                        tableEstudiantes.api().ajax.reload();       
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


if (document.querySelector("#fotoEstudiante")) {
    const fotoEstudiante = document.querySelector("#fotoEstudiante");
    fotoEstudiante.onchange = function (e) {
        const uploadFoto = document.querySelector("#fotoEstudiante").value;
        const fileimg = document.querySelector("#fotoEstudiante").files;
        const nav = window.URL || window.webkitURL;
        const contactAlert = document.querySelector("#form_alert");
        if (uploadFoto != '') {
            const type = fileimg[0].type;
            const name = fileimg[0].name;
            if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.add("notBlock");
                fotoEstudiante.value = "";
                return false;
            } else {
                contactAlert.innerHTML = '';
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.remove("notBlock");
                const objeto_url = nav.createObjectURL(this.files[0]);
                document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + ">";
            }
        } else {
            alert("No selecciono foto");
            if (document.querySelector('#img')) {
                document.querySelector('#img').remove();
            }
        }
    }
}
if (document.querySelector(".delPhoto")) {
    const delPhoto = document.querySelector(".delPhoto");
    delPhoto.onclick = function (e) {
        //document.querySelector("#foto_remove").value = 1;
        removePhoto();
    }
}

function removePhoto() {
    document.querySelector('#fotoEstudiante').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}


