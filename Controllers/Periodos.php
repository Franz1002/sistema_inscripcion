<?php

class Periodos extends Controllers
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

	public function periodos()
	{
		$data['page_id'] = 6;
		$data['page_tab'] = "Periodo Académico - U.E. Pitufi aldea";
		$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
		$data['page_title2'] = "Periodo academico";
		$data['page_welcome'] = "Bienvenido al periodo académico";
		$data['page_name'] = "periodo";
		$this->views->getView($this, "periodos", $data);
	}
	//Obtiene los datos de todos los periodos en un array
	public function getPeriodos()
	{
		$arrData = $this->model->selectPeriodos();
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
					<button class="btn btn-success  btn-mini btnVerAula" onClick="btnViewPeriodo(' . $arrData[$i]['idperiodo'] . ')" title="Ver"><i class="fa fa-eye fa-2x"></i><h6>VISUALIZAR</h6></button>

					<button class="btn btn-primary btn-mini btnEditarPeriodo" type="button" onclick="btnEditPeriodo(' . $arrData[$i]['idperiodo'] . ');" title="Editar"><i class="fa fa-pencil-square-o fa-2x" ></i><h6>MODIFICAR</h6></button>
                    <button class="btn btn-danger btn-mini btnEliminarPeriodo" type="button" onclick="btnDeletePeriodo(' . $arrData[$i]['idperiodo'] . ');" title="Eliminar"><i class="fa fa-trash-o fa-2x"><h6>ELIMINAR</h6></i></button>

				</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}
	//obtiene todos los periodos  que existen para seleccionar
	public function getSelectPeriodosPrekinder()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectPeriodoEstudiante();
		if (count($arrData) > 0) {
			$htmlOptions = '<option value="0">Selecciona una opción</option>';

			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['idperiodo'] > 0) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idperiodo'] . '">' . $arrData[$i]['anio'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	//registra y modifica un cargo
	public function setPeriodo()
	{
		$intIdPeriodo = intval($_POST['idPeriodo']);
		$intPeriodoacademico =  intval($_POST['intPeriodo']);
		$dateFechaInicio = $_POST['dateFechaInicio'];
		$dateFechaFinal = $_POST['dateFechaFinal'];
		$estadoPeriodo = intval($_POST['listEstadoPeriodo']);

		if ($intIdPeriodo == 0) {
			$request_periodo = $this->model->registerPeriodo($intPeriodoacademico, $dateFechaInicio, $dateFechaFinal, $estadoPeriodo);
			$option = 1;
		} else {
			$request_periodo = $this->model->editPeriodo($intIdPeriodo, $intPeriodoacademico, $dateFechaInicio, $dateFechaFinal, $estadoPeriodo);
			$option = 2;
		}

		if ($request_periodo > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Datos Actualizados correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Periodo académico ya existe.');
			}
		} else if ($request_periodo == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Periodo académico ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

	function verPeriodo(int $idperiodo)
	{
		$intIdPeriodo = intval(($idperiodo));
		if ($intIdPeriodo > 0) {
			$data = $this->model->selectViewPeriodo($intIdPeriodo);

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
	function editPeriodo(int $idperiodo)
	{
		$intIdPeriodo = intval(($idperiodo));
		if ($intIdPeriodo > 0) {
			$data = $this->model->selectEditPeriodo($intIdPeriodo);

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
		public function deletePeriodo()
		{
			if ($_POST) {
				$intIdPeriodo = intval($_POST['idperiodo']);
				$requestDel = $this->model->selectDeletPeriodo($intIdPeriodo);
				if ($requestDel) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Periodo académico');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Periodo académico.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
}
