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
                                    <h5><?php echo $data['page_title2']; ?></h5>
                                    <button class="btn waves-effect waves-light btn-primary" type="button" onclick="openModalKinder();"> <i class="fas fa-plus-circle"></i>Inscribir estudiante</button>
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
                                                        <table class="table table-hover table-bordered" id="tableKinder">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Código RUDE</th>
                                                                    <th>Primer Nombre</th>
                                                                    <th>Apellido paterno</th>
                                                                    <th>Apellido materno</th>
                                                                    <th>Aula</th>
                                                                    <th>Sección</th>
                                                                    <th>Fecha de inscripción</th>
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
<div class="modal fade" id="modalNuevoInsKinder" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="title"><b>Nuevo estudiante</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card">
                <div class="card-block">
                    <form class="form-material" method="post" id="modalFormInsKinder" name="modalFormInsKinder">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <input type="hidden" id="idInscripcion" name="idInscripcion" value="1" required>
                                <label>Código RUDE del estudiante</label>
                                <input type="text" name="listMatricula" id="listMatricula" class="form-control" required>
                            </div>
                    
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label>Apellido paterno</label>
                                    <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label>Apellido materno</label>
                                    <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label>Primer nombre</label>
                                    <input type="text" name="primerNombre" id="primerNombre" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label>Segundo nombre</label>
                                    <input type="text" name="segundoNombre" id="segundoNombre" class="form-control" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleSelect1">Aula</label>
                            <div class="col-sm-12">
                                <select class="form-control" data-live-search="true" name="listAulak" id="listAulak" required="">

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleSelect1">Periodo académico</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="listPeriodoAcademico" id="listPeriodoAcademico" required="">
                                    <option value='0'>Selecciona una opción</option>


                                </select>
                            </div>
                        </div>
                        <div s="form-group col-md-6">
                            <input type="date" name="dateFechainscripcion" id="dateFechainscripcion" value="<?php echo date("Y-m-d"); ?>" class="form-control">
                            <span clclasass="form-bar"></span>
                            <label class="text-center">Fecha de inscripción</label>
                        </div>
                        <div class="form-group col-md-6">

                        </div>
                    </form>
                </div>

                <br>
                <div class="text-center">
                    <button class="btn btn-success waves-effect waves-light" type="button" onclick="registrarEstKinder(event);" id="btnGuardarForm"><i class="fa fa-check" aria-hidden="true"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-info waves-effect waves-light" data-dismiss="modal" id="btnCancelar"><i class="fa fa-times" aria-hidden="true"></i>Cancelar</button>
                </div>

                </form>
            </div>
        </div>

    </div>
</div>


<?php require "Views/Template/footer.php"; ?>