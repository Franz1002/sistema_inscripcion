let tableUsuarios;
document.addEventListener('DOMContentLoaded', function () {
    tableUsuarios = $('#tableUsuarios').dataTable({
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
            "url": " " + baseUrl + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columns": [
            {
                "data": "idusuario"
            },
            {
                "data": "nombres"
            },
            {
                "data": "apellidos"
            },
            {
                "data": "user"
            },
            {
                "data": "telefono"
            },
            {
                "data": "nombrecargo"
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
//Nuevo Usuario
function openModalUsuario() {
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Registrar";
    document.getElementById("title").innerHTML = "Registrar Nuevo usuario";
    document.getElementById("modalFormUsuario").reset();
    $("#modalNuevoUsuario").modal("show");
}
window.addEventListener('load', function () {
    selectCargosUsuario();

}, false);

function selectCargosUsuario() {
    if (document.getElementById('listCargoid')) {
        const ajaxUrl = baseUrl + '/Cargos/getSelectCargos';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listCargoid').innerHTML = xhttp.responseText;
                $('#listCargoid').selectpicker('render');
            }
        }
    }

}

//Nuevo usuario
function registrarUsuario(e) {
    e.preventDefault();

    const intIdUsuario = document.querySelector('#idUsuario').value;
    const strCiUsuario = document.getElementById("txtCiUsuario");
    const strNombreUsuario = document.getElementById("txtNombreUsuario");
    const strApellidoUsuario = document.getElementById("txtApellidoUsuario");
    const strUserUsuario = document.getElementById("txtUserUsuario");
    const strPassword = document.getElementById("txtPasswordUsuario");
    const intTelefono = document.getElementById("intTelefonoUsuario");
    const intCargoid = document.getElementById("listCargoid");
    const intEstado = document.getElementById("listEstadoUsuario");
    if (strCiUsuario.value == "" || strNombreUsuario.value == "" || strApellidoUsuario.value == "" || strUserUsuario.value == "" ||
        strUserUsuario.value == "" || strPassword.value == "" || intTelefono.value == "" || intCargoid.value == ""
        || intEstado.value == "") {
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
        const ajaxUrl = baseUrl + '/Usuarios/setUsuario';
        const form = document.getElementById("modalFormUsuario");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>REGISTRADO</u></strong>',
                        html: '<h2>Usuario registrado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoUsuario').modal("hide");
                    modalFormUsuario.reset();
                    tableUsuarios.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Usuario modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoUsuario').modal("hide");
                    modalFormUsuario.reset();
                    tableUsuarios.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>La identificación o la cuenta de usuario ya existe</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }


            }
        }

    }
}

function btnViewUsuario(idusuario){ //para extraer datos del usuario
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Usuarios/verUsuario/' + idusuario;
    xhttp.open("GET",ajaxUrl,true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            const result = JSON.parse(xhttp.responseText);
            if(result.status)
            {
                const estadoUsuario = result.data.estado == 1 ?
                '<span class="badge badge-success" style="align: center; width:70%; text-align: center;">Activo</span>' :
                '<span class="badge badge-danger" style="align: center; width:70%; text-align: center;">Inactivo</span>';

                document.getElementById("viewCi").innerHTML = result.data.ci;
                document.getElementById("viewNombres").innerHTML = result.data.nombres;
                document.getElementById("viewApellidos").innerHTML = result.data.apellidos;
                document.getElementById("viewUsuario").innerHTML = result.data.user;
                document.getElementById("viewTelefono").innerHTML = result.data.telefono;
                document.getElementById("viewCargo").innerHTML = result.data.nombrecargo;       
                document.getElementById("viewEstado").innerHTML = estadoUsuario;   
                document.getElementById("viewFecharegistro").innerHTML = result.data.fechaRegistro;     
                $('#modalViewUser').modal('show');
            }else{
                swal("Error", result.msg, "error");
            }
        }
}  
     
}

function btnEditUsuario(idusuario) {
    document.getElementById("title").innerHTML = "Actualizar usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("cdu").classList.replace("float-label", "control-label");
    document.getElementById("ndu").classList.replace("float-label", "control-label");
    document.getElementById("adu").classList.replace("float-label", "control-label");
    document.getElementById("cu").classList.replace("float-label", "control-label");
    document.getElementById("pdu").classList.replace("float-label", "control-label");
    document.getElementById("tdu").classList.replace("float-label", "control-label");

    document.getElementById("btnText").innerHTML = "Actualizar";
    tableUsuarios.api().ajax.reload();
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Usuarios/editUsuario/' + idusuario;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idUsuario").value = result.data.idusuario;
                document.getElementById("txtCiUsuario").value = result.data.ci;
                document.getElementById("txtNombreUsuario").value = result.data.nombres;
                document.getElementById("txtApellidoUsuario").value = result.data.apellidos;
                document.getElementById("txtUserUsuario").value = result.data.user;
                document.getElementById("txtPasswordUsuario").value = result.data.password;
                document.getElementById("intTelefonoUsuario").value = result.data.telefono;
                document.getElementById("listCargoid").value = result.data.idcargo;
                if (result.data.estado == 1) {
                    document.getElementById("listEstadoUsuario").value = 1;
                } else {
                    document.getElementById("listEstadoUsuario").value = 2;
                }

                $('#listEstadoUsuario').selectpicker('render');
                $('#modalNuevoUsuario').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnDeleteUsuario(idusuario) {
    Swal.fire({
        title: 'Eliminar Usuario',
        text: "Confirma si desea eliminar al usuario",
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
            const ajaxUrl = baseUrl + '/Usuarios/deleteUsuario/';
            const strData = "idusuario="+idusuario;
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
                            'Usuario eliminado con exito.',
                            'success'
                        )
                        tableUsuarios.api().ajax.reload();       
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