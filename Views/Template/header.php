<!DOCTYPE html>
<html lang="en">

<head>  
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="description" content="Sistema de inscripciones de estudiantes para la Unidad Educatica Privada Pitufi-aldea">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Franz Erik Cori">
    <title><?php echo $data['page_tab'];?></title>
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo SERVER_URL;?>/Assets/images/favicon.png" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="<?php echo SERVER_URL;?>/Assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="<?php echo SERVER_URL;?>/Assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" rel="stylesheet" href="<?php echo SERVER_URL;?>/Assets/css/jquery-ui.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/css/bootstrap-select.min.css">
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="<?php echo SERVER_URL;?>/Assets/DataTables/datatables.min.css"/>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>                        
                        <a href="<?php echo SERVER_URL;?>/inicio">
                            <img class="img-130 img-fluid" src="Assets/images/logo.png" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="Assets/images/avatar-3.png" class="img-100 img-radius" alt="User-Profile-Image">
                                    <span><?= $_SESSION['idUsuario']['nombres'];?> <?= $_SESSION['idUsuario']['apellidos'];?></span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="<?php echo SERVER_URL;?>/perfil">
                                            <i class="ti-user"></i> Perfil
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="<?php echo SERVER_URL; ?>/login/logout">
                                            <i class="ti-layout-sidebar-left"></i> Cerrar sesión
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
