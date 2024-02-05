let tableAulas;
document.addEventListener('DOMContentLoaded', function () {
    tableAulas = $('#tableAulas').dataTable({
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
            "url": " " + baseUrl + "/Aulas/getAulas",
            "dataSrc": ""
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columns": [
            {
                "data": "idaula"
            },
            {
                "data": "nombreaula"
            },
            {
                "data": "capacidad"
            },
            {
                "data": "seccionid"
            },            
            {
                "data": "opciones"
            }
        ],
    });
})
//Nuevo Aula
function openModalAula(){
    document.querySelector('#idAula').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Registrar";
    document.getElementById("title").innerHTML = "Registrar Nueva aula";
    document.getElementById("modalFormAula").reset();
    $("#modalNuevoAula").modal("show");
}
window.addEventListener('load', function(){
    selectSeccionAula(); 
}, false);

function selectSeccionAula(){
    if(document.getElementById('listSeccionid')){
        const ajaxUrl = baseUrl+'/Aulas/getSelectSecciones';
        const xhttp = new XMLHttpRequest();        
        xhttp.open("GET",ajaxUrl,true);
        xhttp.send();
        xhttp.onreadystatechange = function(){
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
                document.getElementById('listSeccionid').innerHTML = xhttp.responseText;
                $('#listSeccionid').selectpicker('render');
            }   
        }   
    }

}

//Nuevo aula
function registrarAula(e) {
    e.preventDefault();

    const intIdAula = document.querySelector('#idAula').value;
    const strNombreAula = document.getElementById("txtNombreAula");
    const intCapacidadAula = document.getElementById("intCapacidadAula");
    const intSeccionid = document.getElementById("listSeccionid");
    if (strNombreAula.value == "" || intCapacidadAula.value == "" || intSeccionid.value == 0) {
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
        const ajaxUrl = baseUrl + '/Aulas/setAulas';
        const form = document.getElementById("modalFormAula");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>REGISTRADO</u></strong>',
                        html: '<h2>Aula registrado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoAula').modal("hide");
                    modalFormAula.reset();
                    tableAulas.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Aula modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoAula').modal("hide");
                    modalFormAula.reset();
                    tableAulas.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>El aula ya existe</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }


            }
        }

    }
}

function btnViewAula(idaula){ //para extraer datos
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Aulas/verAula/' + idaula;
    xhttp.open("GET",ajaxUrl,true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            const result = JSON.parse(xhttp.responseText);
            if(result.status)
            {
                const seccionAula = result.data.numeroseccion == 1 ?
                '<span class="badge badge-success" style="align: center; width:70%; text-align: center;">1</span>' :
                '<span class="badge badge-danger" style="align: center; width:70%; text-align: center;">2</span>';

                document.getElementById("viewNombreAula").innerHTML = result.data.nombreaula;
                document.getElementById("viewCapacidad").innerHTML = result.data.capacidad;                 
                document.getElementById("viewSeccionid").innerHTML = seccionAula;   
             
                $('#modalViewAula').modal('show');
            }else{
                swal("Error", result.msg, "error");
            }
        }
}  
     
}

function btnEditAula(idaula) {
    document.getElementById("title").innerHTML = "Actualizar Aula";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.getElementById("nda").classList.replace("float-label", "control-label");
    document.getElementById("cda").classList.replace("float-label", "control-label");

    document.getElementById("btnText").innerHTML = "Actualizar";
    tableAulas.api().ajax.reload();
    const xhttp = new XMLHttpRequest();
    const ajaxUrl = baseUrl + '/Aulas/editAula/' + idaula;
    xhttp.open("GET", ajaxUrl, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            const result = JSON.parse(xhttp.responseText);
            if (result.status) {
                document.getElementById("idAula").value = result.data.idaula;
                document.getElementById("txtNombreAula").value = result.data.nombreaula;
                document.getElementById("intCapacidadAula").value = result.data.capacidad;
         
                if (result.data.seccionid == 1) {
                    document.getElementById("listSeccionid").value = 1;
                } else {
                    document.getElementById("listSeccionid").value = 2;
                }

                $('#listSeccionid').selectpicker('render');
                $('#modalNuevoAula').modal('show');
            } else {
                swal("Error", result.msg, "error");
            }
        }
    }
}

function btnDeleteAula(idaula) {
    Swal.fire({
        title: 'Eliminar Aula',
        text: "Confirma si desea eliminar el aula",
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
            const ajaxUrl = baseUrl + '/Aulas/deleteAula/';
            const strData = "idaula="+idaula;
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
                            'Aula eliminado con éxito.',
                            'success'
                        )
                        tableAulas.api().ajax.reload();       
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