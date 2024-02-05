let tableKinder;
document.addEventListener('DOMContentLoaded', function () {
    tableKinder = $('#tableKinder').dataTable({
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
            "url": " " + baseUrl + "/Kinder/getEstKinder",
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


    $("#listMatricula").autocomplete({
        appendTo: "#modalFormInsKinder",

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
            $("#listMatricula").val(ui.item.label);
            $("#primerNombre").val(ui.item.pNombre);
            $("#segundoNombre").val(ui.item.sNombre);
            $("#apellidoPaterno").val(ui.item.aPaterno);
            $("#apellidoMaterno").val(ui.item.aMaterno);
        }
    })
})

//Nueva inscripcion a kinder
function openModalKinder() {
    document.querySelector('#idInscripcion').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById("btnText").innerHTML = "Inscribir";
    document.getElementById("title").innerHTML = "Inscripciones a Kinder";
    document.getElementById("modalFormInsKinder").reset();
    $("#modalNuevoInsKinder").modal("show");
}

window.addEventListener('load', function () {

    selectAulakinder();    
    //selectPeriodoEstudiante();

}, false);



function selectAulakinder() {
    if (document.getElementById('listAulak')) {
        const ajaxUrl = baseUrl + '/Aulas/getSelectAulaskinder';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listAulak').innerHTML = xhttp.responseText;
                $('#listAulak').selectpicker('render');
            }
        }
    }

}
/*function selectPeriodoEstudiante() {
    if (document.getElementById('listPeriodo')) {
        const ajaxUrl = baseUrl + '/Periodos/getSelectPeriodos';
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", ajaxUrl, true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('listPeriodo').innerHTML = xhttp.responseText;
                $('#listPeriodo').selectpicker('render');

            }
        }
       
    }

}*/
//Nueva Inscripcion a Kinder
function registrarEstKinder(e) {
    e.preventDefault();

    const intIdInscripcion = document.querySelector('#idInscripcion').value;
    const intMatricula = document.getElementById("listMatricula");   
    const strAula = document.getElementById("listAulak");
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
        const ajaxUrl = baseUrl + '/Kinder/setKinder';
        const form = document.getElementById("modalFormInsKinder");
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
                    $('#modalNuevoInsKinder').modal("hide");
                    modalFormInsKinder.reset();
                    tableKinder.api().ajax.reload();
                } else if (result.statuss) {

                    Swal.fire({
                        icon: 'success',
                        title: '<strong><u>MODIFICADO</u></strong>',
                        html: '<h2>Inscripcion modificado exitósamente</h2>',
                        showConfirmButton: true,
                        timer: 4000
                    });
                    $('#modalNuevoInsKinder').modal("hide");
                    modalFormInsKinder.reset();
                    tableKinder.api().ajax.reload();

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