<?php

class Cargos extends Controllers
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

	public function cargos()
	{
		$data['page_id'] = 2;
		$data['page_tab'] = "Cargos - U.E. Pitufi aldea";
		$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
		$data['page_title2'] = "Cargos del usuario";
		$data['page_welcome'] = "Bienvenido a cargos";
		$data['page_name'] = "cargos";
		$this->views->getView($this, "cargos", $data);
	}
	//Obtiene los datos de todos los cargos en un array
	public function getCargos()
	{
		$arrData = $this->model->selectCargos();
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
					<div class="dropdown-menu">
                		<button class="btn btn-primary btn-mini btnEditarCargo" type="button" onclick="btnEditCargo(' . $arrData[$i]['idcargo'] . ');" title="Editar"><i class="fa fa-pencil-square-o fa-2x" ></i><h6>MODIFICAR</h6></button>
               			<button class="btn btn-danger btn-mini btnEliminarCargo" type="button" onclick="btnDeleteCargo(' . $arrData[$i]['idcargo'] . ');" title="Eliminar"><i class="fa fa-trash-o fa-2x"><h6>ELIMINAR</h6></i></button>
					</div>
				</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}
	//obtiene a los cargos que existen para seleccionadr
	public function getSelectCargos()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectCargos();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['estado'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idcargo'] . '">' . $arrData[$i]['nombrecargo'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}
	//registra y modifica un cargo
	public function setCargo()
	{
		$intIdCargo = intval($_POST['idCargo']);
		$strNombreCargo =  $_POST['txtNombreCargo'];
		$strDescripcion = $_POST['txtDescripcion'];
		$intEstado = intval($_POST['listEstado']);

		if ($intIdCargo == 0) {
			$request_cargo = $this->model->registerCargo($strNombreCargo, $strDescripcion, $intEstado);
			$option = 1;
		} else {
			$request_cargo = $this->model->editCargo($intIdCargo, $strNombreCargo, $strDescripcion, $intEstado);
			$option = 2;
		}

		if ($request_cargo > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Datos Actualizados correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Cargo ya existe.');
			}
		} else if ($request_cargo == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Cargo ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

	//Selecciona un cargo por el id y permite editar
	function editCargo(int $idcargo)
	{
		$intIdCargo = intval(($idcargo));
		if ($intIdCargo > 0) {
			$data = $this->model->selectCargo($intIdCargo);

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
	public function deleteCargo()
	{
		if ($_POST) {
			$intIdCargo = intval($_POST['idcargo']);
			$requestDel = $this->model->deletCargo($intIdCargo);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el cargo');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el cargo.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
