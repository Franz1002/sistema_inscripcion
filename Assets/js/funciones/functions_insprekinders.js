let tablePrekinders;
document.addEventListener('DOMContentLoaded', function () {
    tablePrekinders = $('#tablePrekinders').dataTable({
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
            "url": " " + baseUrl + "/Prekinder/getEstPrekinders",
            "dataSrc": ""
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "columns": [
            {
                "data": "idinscripcion"
            },
            {
                "data": "estudianteid"
            },
            {
                "data": "primernombre"
            },
            {
                "data": "apellidopaterno"
            },
            {
                "data": "apellidomaterno"
            },
            {
                "data": "nombreaula"
            },
            {
                "data": "seccionid"
            },
            {
                "data": "fechainscripcion"
            },
            {
                "data": "opciones"
            }
        ],
    });


    $("#listRude").autocomplete({
        appendTo: "#modalFormInsPrekinder",

        source: function (request, response) {
            $.ajax({
                url: "ajax.php",
                dataType: "json",
                data: {
                    q: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        focus: function (event, ui) {
            $("#idInscripcion").val(ui.id);
            $("#listRude").val(ui.item.label);
            $("#primerNombre").val(ui.item.pNombre);
            $("#segundoNombre").val(ui.item.sNombre);
            $("#apellidoPaterno").val(ui.item.aPaterno);
            $("#apellidoMaterno").val(ui.item.aMaterno);
        }
    })
})
//Nueva inscripcion a prekinder
function openModalPrekinder() {
    document.querySelector('#idInscripcion').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Inscribir";
    document.getElementById("title").innerHTML = "Inscripciones a Prekinder";
    document.getElementById("modalFormInsPrekinder").reset();
    $("#modalNuevoInsPrekinder").modal("show");
}

window.addEventListener('load', function () {
    //selectMatriculaEstudiante();
    //selectTutorEstudiante();
    selectAulaEstudiante();
    selectPeriodoEstudiante();

}, false);

/*function selectMatriculaEstudiante() {
    if (document.getElementById('listRude')) {
        const ajaxUrl = baseUrl + '/Estudiantes/getSelectMatriculas';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listMatricula').innerHTML = xhttp.responseText;
                $('#listMatricula').selectpicker('render');
            }
        }
    }

}*/
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
function selectAulaEstudiante() {
    if (document.getElementById('listAula')) {
        const ajaxUrl = baseUrl + '/Aulas/getSelectAulasPrekinder';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listAula').innerHTML = xhttp.responseText;
                $('#listAula').selectpicker('render');
            }
        }
    }

}
function selectPeriodoEstudiante() {
    if (document.getElementById('listPeriodoAcademico')) {
        const ajaxUrl = baseUrl + '/Periodos/getSelectPeriodosPrekinder';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listPeriodoAcademico').innerHTML = xhttp.responseText;
                $('#listPeriodoAcademico').selectpicker('render');
            }
        }
    }

}
//Nueva Inscripcion a Prekinder
function registrarEstPrekinder(e) {
    e.preventDefault();

    const intIdInscripcion = document.querySelector('#idInscripcion').value;
    const intMatricula = document.getElementById("listRude");   
    const strAula = document.getElementById("listAula");
    const intPeriodo = document.getElementById("listPeriodoAcademico");
    const strFechainscripcion = document.getElementById("dateFechainscripcion")
    if (intMatricula.value == "" || strAula.value == 0 || intPeriodo.value == 0 || strFechainscripcion.value == "") {
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
        const ajaxUrl = baseUrl + '/Prekinder/setPrekinder';
        const form = document.getElementById("modalFormInsPrekinder");
        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result.status) {
                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>INSCRITO</u></strong>',
                        html: '<h2>Estudiante inscrito exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoInsPrekinder').modal("hide");
                    modalFormInsPrekinder.reset();
                    tablePrekinders.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Inscripcion modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoInsPrekinder').modal("hide");
                    modalFormInsPrekinder.reset();
                    tablePrekinders.api().ajax.reload();

                } else if (result.statusss) {
                    Swal.fire({
                        icon: 'error',
                        title: '<strong><u>Error</u></strong>',
                        html: '<h2>El estudiante ya se encuentra inscrito en este periodo</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                }


            }
        }

    }
}