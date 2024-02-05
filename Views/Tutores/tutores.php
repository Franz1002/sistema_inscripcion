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
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo SERVER_URL; ?>/inicio"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?php echo SERVER_URL; ?>/tutores"><?php echo $data['page_name']; ?></a>

                        </li>
                    </ul>
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
                                            <form action="<?php echo SERVER_URL; ?>/Tutores/reporteTutores" target="_blank">
                                                <h5>PDF</h5>
                                                <button type="submit" class="btn waves-effect waves-light btn-primary">CONSULTAR TUTORES</button>
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
                                                        <table class="table table-hover table-bordered" id="tableTutores">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Carnet de identidad</th>
                                                                    <th>Expedido</th>
                                                                    <th>Nombres</th>
                                                                    <th>Apellidos</th>
                                                                    <th>Parentesco</th>
                                                                    <th>Telefono</th>
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
<div class="modal fade" id="modalViewTutor" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <td>Expedido(login):</td>
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