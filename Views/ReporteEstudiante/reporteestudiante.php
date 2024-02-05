<?php require "Views/Template/header.php"; ?>
<?php require "Views/Template/nav.php"; ?>
<?php require "Fpdf/fpdf.php"; ?>
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
                                    <h5>REPORTE DE ESTUDIANTES</h5>

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
                                <div class="card-block">
                                    <ol class="breadcrumb bg-primary mb-2">
                                        <li class="breadcrumb-item active text-white">REPORTE DE ESTUDIANTES</li>
                                    </ol>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <form action="<?php echo SERVER_URL; ?>/ReporteEstudiante/reporteRude" method="POST" target="_blank">
                                                <div class="form-row form-default">
                                                    <div class="form-group col-md-6">
                                                        <input class="form-control" type="text" name="reporteRude" id="reporteRude">
                                                     
                                                        <label class="float-label control-label" id="cdu">RUDE del estudiante</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn waves-effect waves-light btn-primary">GENERAR PDF</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <form action="<?php echo SERVER_URL; ?>/ReporteEstudiante/reporteAula" method="POST" target="_blank">
                                                <div class="form-row form-default">
                                                    <div class="form-group col-md-6">
                                                        <input class="form-control" type="text" name="reporteAula" id="reporteAula">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label control-label" id="cdu">Aula</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn waves-effect waves-light btn-primary">GENERAR PDF</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <form action="<?php echo SERVER_URL; ?>/ReporteEstudiante/reporteSeccion" method="POST" target="_blank">
                                                <div class="form-row form-default">
                                                    <div class="form-group col-md-6">
                                                        <input class="form-control" type="text" name="reporteSeccion" id="reporteSeccion">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label control-label" id="cdu">Sección</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn waves-effect waves-light btn-primary">GENERAR PDF</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <ol class="breadcrumb bg-primary">
                                        <li class="breadcrumb-item active text-white">REPORTE POR FECHA DE INSCRIPCIÓN</li>
                                    </ol>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <form action="<?php echo SERVER_URL; ?>/ReporteEstudiante/reporteFecha" method="POST" target="_blank">
                                                <div class="form-row form-default">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                        <label class="float-label control-label" for="fechainscripciond">Desde</label>
                                                            <input class="form-control" type="date" value="<?php echo date('d-m-Y'); ?>" name="fechainscripciond" id="fechainscripciond">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                        <label class="float-label control-label" for="fechainscripcionh">Hasta</label>

                                                        <input class="form-control" type="date" value="<?php echo date('Y-m-d');  ?>" name="fechainscripcionh" id="fechainscripcionh">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">

                                                            <div class="form-group text-center">
                                                                <button type="submit" class="btn waves-effect waves-light btn-primary">GENERAR PDF</button>
    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    </form>
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

<?php require "Views/Template/footer.php"; ?>