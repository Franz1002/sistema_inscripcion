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
                        <li class="breadcrumb-item"><a href="<?php echo SERVER_URL; ?>/inicio">Inicio</a>
                        </li>
                    </ul>
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
                                    <h5>DASHBOARD</h5>

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
                                    <div class="col-xl-12 col-md-12">
                                        <div class="row">
                                            <!-- sale card start -->
                                            <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador')){ ?>
                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">USUARIOS</h4>                                                   
                                                            <i class="fa fa-users f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <span class="d-block f-36"><?php echo $data['usuarios']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                        <a href="<?php echo SERVER_URL; ?>/usuarios" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>                                          
                                            <?php } ?>
                                            <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador')){ ?>
                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">CARGOS</h4>
                                                            <i class="fa fa-user f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <span class="d-block f-36"><?php echo $data['cargos']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/cargos" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador' || $_SESSION['idUsuario']['nombrecargo'] == 'Director' )){ ?>

                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">GESTIONES</h4>
                                                            <i class="fa fa-calendar f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <span class="d-block f-36"><?php echo $data['gestiones']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/periodos" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador' || $_SESSION['idUsuario']['nombrecargo'] == 'Director' )){ ?>
                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">AULAS</h4>
                                                            <i class="fa fa-university f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <span class="d-block f-36"><?php echo $data['aulas']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/aulas" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">ESTUDIANTES</h4>
                                                            <i class="fa fa-graduation-cap f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <span class="d-block f-36"><?php echo $data['estudiantes']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/estudiantes" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">TUTORES</h4>
                                                            <i class="fa fa-user-circle-o f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <span class="d-block f-36"><?php echo $data['tutores']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/tutores" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador' || $_SESSION['idUsuario']['nombrecargo'] == 'Director' )){ ?>
                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">INSCRITOS PREKINDER</h4>
                                                            <i class="fa fa-graduation-cap f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <span class="d-block f-36"><?php echo $data['prekinder']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/prekinder" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador' || $_SESSION['idUsuario']['nombrecargo'] == 'Director' )){ ?>

                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">INSCRITOS KINDER</h4>
                                                            <i class="fa fa-graduation-cap f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                        <span class="d-block f-36"><?php echo $data['kinder']['total']; ?></span>
                                                            <h5 class="m-b-0">Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/kinder" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-4">
                                                <div class="card text-center order-visitor-card">
                                                    <div class="card-block">
                                                        <div class="card-header borderless pb-0">
                                                            <h4 class="m-b-0">REPORTES</h4>
                                                            <i class="fa fa-file-pdf-o f-40"></i>
                                                        </div>
                                                        <div class="card-body text-center">
                                                       
                                                            <h5 class="m-b-0">Detalle de todos los estudiantes inscritos en la Unidad Educativa</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-black border-0">
                                                    <a href="<?php echo SERVER_URL; ?>/reporteEstudiante" class="text-white"> <h5 class="text-white m-b-0">Ver módulo</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- sale card end -->
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
</div>

<?php require "Views/Template/footer.php"; ?>