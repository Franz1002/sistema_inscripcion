<?php require "Views/Template/header.php"; ?>
<?php require "Views/Template/nav.php"; ?>
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><?php echo $data['page_title']; ?></h5>
                        <p class="m-b-0"><?php echo $data['page_welcome']; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
         
         <div class="page-header-title">
             <h5 class="m-b-10"><?php setlocale(LC_TIME, "spanish");
                                 echo strftime("%A, %d de %B de %Y");
                                 ?>
             </h5>
         </div>
     </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <h5><?php echo $data['page_title2']; ?></h5>
                                            <button class="btn waves-effect waves-light btn-primary" type="button" onclick="openModalEstudiante();"> <i class="fas fa-plus-circle"></i>Nuevo Estudiante</button>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <h5>Tutor</h5>
                                            <button class="btn waves-effect waves-light btn-primary" type="button" onclick="openModalTutor();"> <i class="fas fa-plus-circle"></i>Asignar Apoderado</button>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <form action="<?php echo SERVER_URL; ?>/Estudiantes/reporteEstudiantes" target="_blank">
                                                <h5>PDF</h5>
                                                <button type="submit" class="btn waves-effect waves-light btn-primary">CONSULTAR ESTUDIANTES</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li>
                                                <i class="fa fa fa-wrench open-card-option"></i>
                                            </li>
                                            <li>
                                                <i class="fa fa-window-maximize full-card"></i>
                                            </li>
                                            <li>
                                                <i class="fa fa-minus minimize-card"></i>
                                            </li>
                                            <li>
                                                <i class="fa fa-refresh reload-card"></i>
                                            </li>
                                            <li>
                                                <i class="fa fa-trash close-card"></i>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tile">
                                                <div class="tile-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered" id="tableEstudiantes">
                                                            <thead class="thead-dark">
                                                                <tr>                                                                 
                                                                    <th>Código RUDE</th>
                                                                    <th>Carnet Identidad</th>
                                                                    <th>Exp.</th>
                                                                    <th>Apellido Paterno</th>
                                                                    <th>Apellido Materno</th>
                                                                    <th>Primer nombre</th>
                                                                    <th>Segundo nombre</th>                                                                 
                                                                                                                             
                                                                    <th>Estado</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNuevoEstudiante" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="title"><b>Nuevo Estudiante</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card">
                <div class="card-block">
                    <form class="form-material" id="modalFormEstudiante" name="modalFormEstudiante">
                        <input type="hidden" id="idEstudiante" name="idEstudiante" value="">
                        <input type="hidden" id="foto_actual" name="foto_actual" value="">
                        <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                        <h5 class="text-center">Datos del estudiante</h5><br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtCiEstudiante" id="txtCiEstudiante" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="cde">Carnet de identidad</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Expedido</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="listExpedidoEstudiante" id="listExpedidoEstudiante" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>LP</option>
                                        <option>CB</option>
                                        <option>SC</option>
                                        <option>PD</option>
                                        <option>BE</option>
                                        <option>CH</option>
                                        <option>TJ</option>
                                        <option>OR</option>
                                        <option>PT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtPrimerNombre" id="txtPrimerNombre" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="pne">Primer nombre</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="txtSegundoNombre" id="txtSegundoNombre" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="sne">Segundo nombre</label>
                            </div>
                        </div>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="ape">Apellido paterno</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="txtApellidoMaterno" id="txtApellidoMaterno" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="ame">Apellido materno</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="date" name="dateFechaNacimiento" id="dateFechaNacimiento" class="form-control">
                                <span class="form-bar"></span>
                                <label class="control-label">Fecha de nacimiento</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Genero</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" name="listGenero" id="listGenero" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>MASCULINO</option>
                                        <option>FEMENINO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtDomicilioEstudiante" id="txtDomicilioEstudiante" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="dme">Domicilio</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect">Lugar de nacimiento</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="listDepartamentoEstudiante" id="listDepartamentoEstudiante" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>LA PAZ</option>
                                        <option>COCHABAMBA</option>
                                        <option>SANTA CRUZ</option>
                                        <option>PANDO</option>
                                        <option>BENI</option>
                                        <option>SUCRE</option>
                                        <option>TARIJA</option>
                                        <option>ORURO</option>
                                        <option>POTOSI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="intMatricula" id="intMatricula" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="cre">Código RUDE</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Estado</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" name="listEstado" id="listEstado" required="">
                                        <option value="1">Habilitado</option>
                                        <option value="2">Abandono</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="photo">

                                    <h5 class="text-center">Foto del estudiante</h5>

                                    <div class="prevPhoto">
                                        <span class="delPhoto notBlock">X</span>
                                        <label for="fotoEstudiante"></label>
                                        <div>
                                            <img id="img" src="<?php echo SERVER_URL; ?>/images/defect.png">
                                        </div>
                                    </div>
                                    <div class="upimg">
                                        <input type="file" name="fotoEstudiante" id="fotoEstudiante">
                                    </div>
                                    <div id="form_alert"></div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="text-center">
                            <button class="btn btn-success waves-effect waves-light" type="button" onclick="registrarEstudiante(event);" id="btnGuardarForm"><i class="fa fa-check" aria-hidden="true"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-info waves-effect waves-light" data-dismiss="modal" id="btnCancelar"><i class="fa fa-times" aria-hidden="true"></i>Cancelar</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNuevoEstudianteupd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="title"><b>ac Estudiante</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card">
                <div class="card-block">
                    <form class="form-material" id="modalFormEstudianteupd" name="modalFormEstudianteupd">
                        <input type="hidden" id="idEstudiante" name="idEstudiante" value="">
                        <input type="hidden" id="foto_actual" name="foto_actual" value="">
                        <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                        <h5 class="text-center">Datos del estudiante</h5><br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtCiEstudiante" id="txtCiEstudiante" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="cde">Carnet de identidad</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Expedido</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="listExpedidoEstudiante" id="listExpedidoEstudiante" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>LP</option>
                                        <option>CB</option>
                                        <option>SC</option>
                                        <option>PD</option>
                                        <option>BE</option>
                                        <option>CH</option>
                                        <option>TJ</option>
                                        <option>OR</option>
                                        <option>PT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtPrimerNombre" id="txtPrimerNombre" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="pne">Primer nombre</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="txtSegundoNombre" id="txtSegundoNombre" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="sne">Segundo nombre</label>
                            </div>
                        </div>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="ape">Apellido paterno</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="txtApellidoMaterno" id="txtApellidoMaterno" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="ame">Apellido materno</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="date" name="dateFechaNacimiento" id="dateFechaNacimiento" class="form-control">
                                <span class="form-bar"></span>
                                <label class="control-label">Fecha de nacimiento</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Genero</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" name="listGenero" id="listGenero" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>MASCULINO</option>
                                        <option>FEMENINO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtDomicilioEstudiante" id="txtDomicilioEstudiante" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="dme">Domicilio</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect">Lugar de nacimiento</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="listDepartamentoEstudiante" id="listDepartamentoEstudiante" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>LA PAZ</option>
                                        <option>COCHABAMBA</option>
                                        <option>SANTA CRUZ</option>
                                        <option>PANDO</option>
                                        <option>BENI</option>
                                        <option>SUCRE</option>
                                        <option>TARIJA</option>
                                        <option>ORURO</option>
                                        <option>POTOSI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="intMatricula" id="intMatricula" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="cre">Código RUDE</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Estado</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" name="listEstado" id="listEstado" required="">
                                        <option value="1">Habilitado</option>
                                        <option value="2">Abandono</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="photo">

                                    <h5 class="text-center">Foto del estudiante</h5>

                                    <div class="prevPhoto">
                                        <span class="delPhoto notBlock">X</span>
                                        <label for="fotoEstudiante"></label>
                                        <div>
                                            <img id="img" src="<?php echo SERVER_URL; ?>/images/defect.png">
                                        </div>
                                    </div>
                                    <div class="upimg">
                                        <input type="file" name="fotoEstudiante" id="fotoEstudiante">
                                    </div>
                                    <div id="form_alert"></div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="text-center">
                            <button class="btn btn-success waves-effect waves-light" type="button" onclick="updateEstudiante(event);" id="btnGuardarForm"><i class="fa fa-check" aria-hidden="true"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-info waves-effect waves-light" data-dismiss="modal" id="btnCancelar"><i class="fa fa-times" aria-hidden="true"></i>Cancelar</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>

<!-- Modal tutor-->
<div class="modal fade" id="modalNuevoTutor" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="title"><b>Nuevo Tutor</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-block">

                    <form class="form-material" method="post" id="modalFormTutor" name="modalFormTutor">
                        <input type="hidden" id="idTutor" name="idTutor" value="1">
                        <h5 class="text-center">Datos del tutor o apoderado</h5><br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtCiTutor" id="txtCiTutor" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="cdt">Carnet de identidad</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Expedido</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" name="listExpedido" id="listExpedido" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>LP</option>
                                        <option>CB</option>
                                        <option>SC</option>
                                        <option>PN</option>
                                        <option>BN</option>
                                        <option>CH</option>
                                        <option>TJ</option>
                                        <option>OR</option>
                                        <option>PT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtNombreTutor" id="txtNombreTutor" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="ndt">Nombre del tutor</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="txtApellidoTutor" id="txtApellidoTutor" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="adt">Apellidos del tutor</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="intTelefonoTutor" id="intTelefonoTutor" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="tdt">Telefono</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Parentesco</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="listParentesco" id="listParentesco" required="">
                                        <option value='0'>Selecciona una opción</option>
                                        <option>MADRE</option>
                                        <option>PADRE</option>
                                        <option>TIO</option>
                                        <option>TIA</option>
                                        <option>HERMANO</option>
                                        <option>HERMANA</option>
                                        <option>ABUELO</option>
                                        <option>ABUELA</option>
                                        <option>PRIMO</option>
                                        <option>PRIMA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-center">Datos del estudiante</h5><br>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label>RUDE del estudiante</label>
                                <input type="text" name="listRudes" id="listRudes" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-sm-3">
                                <div class="form-group">
                                    <label>Apellido paterno</label>
                                    <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <div class="form-group">
                                    <label>Apellido materno</label>
                                    <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <div class="form-group">
                                    <label>Primer nombre</label>
                                    <input type="text" name="primerNombre" id="primerNombre" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <div class="form-group">
                                    <label>Segundo nombre</label>
                                    <input type="text" name="segundoNombre" id="segundoNombre" class="form-control" disabled required>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-success waves-effect waves-light" type="button" onclick="registrarTutore(event);" id="btnGuardarForm"><i class="fa fa-check" aria-hidden="true"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-info waves-effect waves-light" data-dismiss="modal" id="btnCancelar"><i class="fa fa-times" aria-hidden="true"></i>Cancelar</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewEstudiante" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="2"><h5>DATOS DEL ESTUDIANTE</h5></td>
                        </tr>
                        <tr>
                        <td class="text-center" colspan="2"><h6>Foto del estudiante</h6></td>
                           
                        </tr>
                        <tr>
                        <td colspan="2" id="viewFotoEstudiante"></td>
                        </tr>
                        <tr>
                            <td><h6>Código RUDE:</h6></td>
                            <td id="viewRudeEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Carnet de identidad:</td>
                            <td id="viewCiEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Expedido:</td>
                            <td id="viewExpedidoEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Primer Nombre:</td>
                            <td id="viewPrimerNombreEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Segundo Nombre</td>
                            <td id="viewSegundoNombreEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Apellido Paterno:</td>
                            <td id="viewApellidoPaternoEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Apellido Materno:</td>
                            <td id="viewApellidoMaternoEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Fecha de nacimiento: </tde=>
                            <td id="viewFechaNacimientoEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Género:</td>
                            <td id="viewGeneroEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Lugar de nacimiento:</td>
                            <td id="viewDeptoEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Domicilio:</td>
                            <td id="viewDomicilioEstudiante"></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="viewEstadoEstudiante"></td>
                        </tr>      
                        <tr>
                            <td class="text-center" colspan="2"><h5>DATOS DEL TUTOR</h5></td>
                        </tr>           
                        <tr>
                            <td>Carnet de identidad:</td>
                            <td id="viewCiTutor"></td>
                        </tr>
                        <tr>
                            <td>Expedido:</td>
                            <td id="viewExpedidoTutor"></td>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td id="viewNombreTutor"></td>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td id="viewApellidosTutor"></td>
                        </tr>
                        <tr>
                            <td>Parentesco:</td>
                            <td id="viewParentescoTutor"></td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td id="viewTelefonoTutor"></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="text-center">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Cerrar</button>
            </div>
            <div clas="modal-footer">
                <h1></h1>
            </div>
        </div>
    </div>
</div>

<?php require "Views/Template/footer.php"; ?>