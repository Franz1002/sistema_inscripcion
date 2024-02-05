<?php

class Usuarios extends Controllers
{
	public function __construct()
	{
		session_start();
		if(empty($_SESSION['login']))
		{
			header('location: '.SERVER_URL);
		}
		parent::__construct();
	}

	public function usuarios()
	{

		$data['page_id'] = 3;
		$data['page_tab'] = "Usuarios - U.E. Pitufi aldea";
		$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
		$data['page_title2'] = "Usuarios";
		$data['page_welcome'] = "Bienvenido a usuarios";
		$data['page_name'] = "usuarios";
		$this->views->getView($this, "usuarios", $data);
	}



	//Obtiene los datos de todos los usuarios en un array
	public function getUsuarios()
	{
		$arrData = $this->model->selectUsuarios();
		/*$format  = print_r('<pre>');
			$format .= print_r($arrData);
			$format .= print_r('</pre>');
			return $format;*/
		for ($i = 0; $i < count($arrData); $i++) {
			if ($arrData[$i]['estado'] == 1) {
				$arrData[$i]['estado'] = '<span class="badge badge-success" style="align:center;width:100%;text-align:center;">Activo</span>';
			} else {
				$arrData[$i]['estado'] = '<span class="badge badge-danger" style="align:center;width:100%;text-align:center;">Inactivo</span>';
			}

			$arrData[$i]['opciones'] = '							
			<div class="text-center">
				<button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu ">
					<button class="btn btn-success  btn-mini btnVerUsuario" onClick="btnViewUsuario(' . $arrData[$i]['idusuario'] . ')" title="Ver"><i class="fa fa-eye fa-2x"></i><h6>VISUALIZAR</h6></button>
					<button class="btn btn-primary btn-mini btnEditarUsuario" type="button" onclick="btnEditUsuario(' . $arrData[$i]['idusuario'] . ');" title="Editar"><i class="fa fa-pencil-square-o fa-2x" ></i><h6>MODIFICAR</h6></button>
					<button class="btn btn-danger btn-mini btnEliminarUsuario" type="button" onclick="btnDeleteUsuario(' . $arrData[$i]['idusuario'] . ');" title="Eliminar"><i class="fa fa-trash-o fa-2x"><h6>ELIMINAR</h6></i></button>
				</div>
			</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}

	//registra o modifica un usuario
	public function setUsuario()
	{
		$intIdUsuario = intval($_POST['idUsuario']);
		$strCiUsuario =  $_POST['txtCiUsuario'];
		$strNombreUsuario =  $_POST['txtNombreUsuario'];
		$strApellidoUsuario = $_POST['txtApellidoUsuario'];
		$strUserUsuario =  $_POST['txtUserUsuario'];
		$strPassword = $_POST['txtPasswordUsuario'];
		$intTelefono = intval($_POST['intTelefonoUsuario']);
		$intCargoid = intval($_POST['listCargoid']);
		$intEstado = intval($_POST['listEstadoUsuario']);

		if ($intIdUsuario == 0) {
			$request_usuario = $this->model->registerUsuario(
				$strCiUsuario,
				$strNombreUsuario,
				$strApellidoUsuario,
				$strUserUsuario,
				$strPassword,
				$intTelefono,
				$intCargoid,
				$intEstado
			);
			$option = 1;
		} else {
			$request_usuario = $this->model->editUsuario(
				$intIdUsuario,
				$strCiUsuario,
				$strNombreUsuario,
				$strApellidoUsuario,
				$strUserUsuario,
				$strPassword,
				$intTelefono,
				$intCargoid,
				$intEstado
			);
			$option = 2;
		}

		if ($request_usuario > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Datos Actualizados correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Usuario ya existe.');
			}
		} else if ($request_usuario == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Usuario ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}


	function verUsuario(int $idusuario)
	{
		$intIdUsuario = intval(($idusuario));
		if ($intIdUsuario > 0) {
			$data = $this->model->selectViewUsuario($intIdUsuario);

			if (empty($data)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $data);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}

	//Selecciona un cargo por el id y permite editar
	function editUsuario(int $idusuario)
	{
		$intIdUsuario = intval(($idusuario));
		if ($intIdUsuario > 0) {
			$data = $this->model->selectUsuario($intIdUsuario);

			if (empty($data)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $data);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}
	//Selecciona un cargo por el id y permite eliminar
	public function deleteUsuario()
	{
		if ($_POST) {
			$intIdUsuario = intval($_POST['idusuario']);
			$requestDel = $this->model->deletUsuario($intIdUsuario);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
