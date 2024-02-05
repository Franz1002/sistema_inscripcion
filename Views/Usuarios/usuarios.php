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
                                    <button class="btn waves-effect waves-light btn-primary" type="button" onclick="openModalUsuario();"> <i class="fas fa-plus-circle"></i>Registrar Nuevo usuario</button>
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
                                                        <table class="table table-hover table-bordered" id="tableUsuarios">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Nombres</th>
                                                                    <th>Apellidos</th>
                                                                    <th>User</th>
                                                                    <th>Telefono</th>
                                                                    <th>Cargo</th>
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
<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="title"><b>Nuevo Usuario</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="card">
                <div class="card-block">
                    <form class="form-material" id="modalFormUsuario" name="modalFormUsuario">
                        <input type="hidden" id="idUsuario" name="idUsuario" value="">
                        <h5 class="text-center">Datos del usuario</h5>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtCiUsuario" id="txtCiUsuario" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="cdu">Carnet de identidad</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtNombreUsuario" id="txtNombreUsuario" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="ndu">Nombre del usuario</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="txtApellidoUsuario" id="txtApellidoUsuario" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="adu">Apellidos del usuario</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="txtUserUsuario" id="txtUserUsuario" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="cu">Cuenta de usuario</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" name="txtPasswordUsuario" id="txtPasswordUsuario" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="pdu">Contraseña</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <input type="text" name="intTelefonoUsuario" id="intTelefonoUsuario" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label control-label" id="tdu">Telefono</label>
                            </div>
                        </div>
                        <br>
                        <div class="form-row form-default">
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Cargo del usuario</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="listCargoid" id="listCargoid" required="">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Estado</label>
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" name="listEstadoUsuario" id="listEstadoUsuario" required="">
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="text-center">
                            <button class="btn btn-success waves-effect waves-light" type="button" onclick="registrarUsuario(event);" id="btnGuardarForm"><i class="fa fa-check" aria-hidden="true"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
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
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>

                                <th scope="row">Carnet de identidad: </th>
                                <td id="viewCi"></td>
                            </tr>
                            <tr>
                                <td>Nombres:</td>
                                <td id="viewNombres"></td>
                            </tr>
                            <tr>
                                <td>Apellidos:</td>
                                <td id="viewApellidos"></td>
                            </tr>
                            <tr>
                                <td>Usuario(login):</td>
                                <td id="viewUsuario"></td>
                            </tr>
                            <tr>
                                <td>Teléfono:</td>
                                <td id="viewTelefono"></td>
                            </tr>
                            <tr>
                                <td>Cargo del Usuario:</td>
                                <td id="viewCargo"></td>
                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td id="viewEstado"></td>
                            </tr>
                            <tr>
                                <td>Fecha de registro:</td>
                                <td id="viewFecharegistro"></td>
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