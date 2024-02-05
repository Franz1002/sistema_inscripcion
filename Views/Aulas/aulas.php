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
                                            <button class="btn waves-effect waves-light btn-primary" type="button" onclick="openModalAula();"> <i class="fas fa-plus-circle"></i>Nuevo aula</button>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <form action="<?php echo SERVER_URL; ?>/Aulas/reporteAulas" target="_blank">
                                                <h5>PDF</h5>
                                                <button type="submit" class="btn waves-effect waves-light btn-primary">CONSULTAR AULAS</button>
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
                                                        <table class="table table-hover table-bordered" id="tableAulas">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Aula</th>
                                                                    <th>Capacidad</th>
                                                                    <th>Sección</th>
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
<div class="modal fade" id="modalNuevoAula" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="title"><b>Nuevo aula</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card">
                <div class="card-block">
                    <form class="form-material" id="modalFormAula" name="modalFormAula">
                        <input type="hidden" id="idAula" name="idAula" value="">
                        <div class="form-group form-default">
                            <input type="text" name="txtNombreAula" id="txtNombreAula" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label control-label" id="nda">Nombre del aula</label>
                        </div>
                        <br><br>
                        <div class="form-group form-default">
                            <input type="text" name="intCapacidadAula" id="intCapacidadAula" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label control-label" id="cda">Capacidad máximo de estudiantes</label>
                        </div>
                        <div class="form-row form-default">
                            <div class="form-group col-md-8">
                                <label for="exampleSelect1">Sección</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="listSeccionid" id="listSeccionid" required="">

                                    </select>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <br>
                        <button class="btn btn-success waves-effect waves-light" type="button" onclick="registrarAula(event);" id="btnGuardarForm"><i class="fa fa-check" aria-hidden="true"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-info waves-effect waves-light" data-dismiss="modal" id="btnCancelar"><i class="fa fa-times" aria-hidden="true"></i>Cancelar</button>


                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalViewAula" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Aula</th>
                                <td id="viewNombreAula"></td>
                            </tr>
                            <tr>
                                <td>Capacidad:</td>
                                <td id="viewCapacidad"></td>
                            </tr>
                            <tr>
                                <td>Seccion:</td>
                                <td id="viewSeccionid"></td>
                            </tr>                    
                        </tbody>
                    </table>
                </div>
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