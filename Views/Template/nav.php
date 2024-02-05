  <div class="pcoded-main-container">
      <div class="pcoded-wrapper">
          <nav class="pcoded-navbar">
              <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
              <div class="pcoded-inner-navbar main-menu">
                  <div class="">
                      <div class="main-menu-header">
                          <img class="img-100 img-radius" src="Assets/images/avatar-3.png" alt="User-Profile-Image">
                          <div class="user-details">
                              <span id="more-details"><?= $_SESSION['idUsuario']['nombres']; ?> <?= $_SESSION['idUsuario']['apellidos']; ?><i class="fa fa-caret-down"></i></span>
                              <h6 class="text-white text-center"><?= $_SESSION['idUsuario']['nombrecargo']; ?></h6>
                          </div>
                      </div>
                      <div class="main-menu-content">

                          <li class="more-details">
                              <a href="<?php echo SERVER_URL; ?>/perfil"><i class="ti-user"></i>Ver perfil</a>
                              <a href="<?php echo SERVER_URL; ?>/login/logout"><i class="ti-layout-sidebar-left"></i>Salir</a>
                          </li>
                          </ul>
                      </div>
                  </div>
                  <div class="pcoded-navigation-label">Home</div>
                  <ul class="pcoded-item pcoded-left-item">
                      <li class="">
                          <a href="<?php echo SERVER_URL; ?>/inicio" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="fas fa-home"></i></span>
                              <span class="pcoded-mtext">Inicio</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                  </ul>
                  <div class="pcoded-navigation-label">Cuenta</div>
                  <ul class="pcoded-item pcoded-left-item">
                      <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador')) { ?>
                          <li class="pcoded-hasmenu">
                              <a href="javascript:void(0)" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="fas fa-users"></i></span>
                                  <span class="pcoded-mtext">Usuarios</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                              <ul class="pcoded-submenu">
                                  <li class="">
                                      <a href="<?php echo SERVER_URL; ?>/usuarios" class="waves-effect waves-dark">
                                          <span class="pcoded-micon"><i class="ti-angle-rght"></i></span>
                                          <span class="pcoded-mtext">Usuarios</span>
                                          <span class="pcoded-mcaret"></span>
                                      </a>
                                  </li>
                                  <li class="">
                                      <a href="<?php echo SERVER_URL; ?>/cargos" class="waves-effect waves-dark">
                                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                          <span class="pcoded-mtext">Cargos</span>
                                          <span class="pcoded-mcaret"></span>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      <?php } ?>
                  </ul>
                  <ul class="pcoded-item pcoded-left-item">
                      <li class="pcoded-hasmenu">
                          <a href="javascript:void(0)" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                              <span class="pcoded-mtext">Estudiantes</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                          <ul class="pcoded-submenu">
                              <li class=" ">
                                  <a href="<?php echo SERVER_URL; ?>/estudiantes" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                      <span class="pcoded-mtext">Estudiantes</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li class=" ">
                                  <a href="<?php echo SERVER_URL; ?>/tutores" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                      <span class="pcoded-mtext">Tutores</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  </ul>
                  <div class="pcoded-navigation-label"><?php if (
                                                            !empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador') ||
                                                            $_SESSION['idUsuario']['nombrecargo'] == 'Director'
                                                        ) { ?>Inscripciones<?php } ?></div>

                  <?php if (!empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador') || $_SESSION['idUsuario']['nombrecargo'] == 'Director') { ?>
                      <ul class="pcoded-item pcoded-left-item">
                          <li class="pcoded-hasmenu">
                              <a href="javascript:void(0)" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="fas fa-paste"></i></span>
                                  <span class="pcoded-mtext">Inscripciones</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                              <ul class="pcoded-submenu">
                                  <li class=" ">
                                      <a href="<?php echo SERVER_URL; ?>/prekinder" class="waves-effect waves-dark">
                                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                          <span class="pcoded-mtext">Estudiantes pre Kinder</span>
                                          <span class="pcoded-mcaret"></span>
                                      </a>
                                  </li>
                                  <li class=" ">
                                      <a href="<?php echo SERVER_URL; ?>/kinder" class="waves-effect waves-dark">
                                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                          <span class="pcoded-mtext">Estudiantes kinder</span>
                                          <span class="pcoded-mcaret"></span>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  <?php } ?>
                  <ul class="pcoded-item pcoded-left-item">
                      <li class="pcoded-hasmenu">
                          <a href="javascript:void(0)" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="fa fa-file" aria-hidden="true"></i></span>
                              <span class="pcoded-mtext">Reportes</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                          <ul class="pcoded-submenu">

                              <li class=" ">
                                  <a href="<?php echo SERVER_URL; ?>/reporteEstudiante" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                      <span class="pcoded-mtext">Reportes de estudiantes</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  </ul>
                  <ul class="pcoded-item pcoded-left-item">
                      <?php if (
                            !empty($_SESSION['idUsuario']['nombrecargo'] == 'Administrador') ||
                            $_SESSION['idUsuario']['nombrecargo'] == 'Director'
                        ) { ?>
                          <li class="pcoded-hasmenu">
                              <a href="javascript:void(0)" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                  <span class="pcoded-mtext">Configuración</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                              <ul class="pcoded-submenu">
                                  <li class=" ">
                                      <a href="<?php echo SERVER_URL; ?>/periodos" class="waves-effect waves-dark">
                                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                          <span class="pcoded-mtext">Periodo Académico</span>
                                          <span class="pcoded-mcaret"></span>
                                      </a>
                                  </li>
                                  <li class=" ">
                                      <a href="<?php echo SERVER_URL; ?>/aulas" class="waves-effect waves-dark">
                                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                          <span class="pcoded-mtext">Aulas</span>
                                          <span class="pcoded-mcaret"></span>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      <?php } ?>
                  </ul>

                  <ul class="pcoded-item pcoded-left-item">
                      <li class="">
                          <a href="<?php echo SERVER_URL; ?>/login/logout" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-layout-sidebar-left""></i></span>
                                        <span class=" pcoded-mtext">Cerrar Sesión</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>

                  </ul>
                  </li>
                  </ul>
              </div>
      </div>
      </nav>