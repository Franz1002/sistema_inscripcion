<?php

class Kinder extends Controllers
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

	public function kinder()
	{
		$data['page_id'] = 8;
		$data['page_tab'] = "kinder - U.E. Pitufi aldea";
		$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
		$data['page_title2'] = "kinder";
		$data['page_welcome'] = "Bienvenido a Estudiantes de kinder";
		$data['page_name'] = "kinder";
		$this->views->getView($this, "kinder", $data);
	}

	public function getEstKinder()
	{
		$arrData = $this->model->selectEstKinder();

		/*$format  = print_r('<pre>');
			$format .= print_r($arrData);
			$format .= print_r('</pre>');
			return $format;*/
		for ($i = 0; $i < count($arrData); $i++) {
			if ($arrData[$i]['seccionid'] == 1) {
				$arrData[$i]['seccionid'] = '<span class="badge badge-success" style="align:center;width:100%;text-align:center;">1</span>';
			} else {
				$arrData[$i]['seccionid'] = '<span class="badge badge-danger" style="align:center;width:100%;text-align:center;">2</span>';;
			}

		
			$arrData[$i]['opciones'] = '							
			<div class="text-center">
				<button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu ">
					<button class="btn btn-success  btn-mini btnVerEstKinder" onClick="btnViewEstKinder(' . $arrData[$i]['idinscripcion'] . ')" title="Ver"><i class="fa fa-eye fa-2x"></i><h6>VISUALIZAR</h6></button>
					<button class="btn btn-primary btn-mini btnEditarEstKinder" type="button" onclick="btnEditEstKinder(' . $arrData[$i]['idinscripcion'] . ');" title="Editar"><i class="fa fa-pencil-square-o fa-2x" ></i><h6>MODIFICAR</h6></button>
					<button class="btn btn-danger btn-mini btnEliminarEstKinder" type="button" onclick="btnDeleteEstKinder(' . $arrData[$i]['idinscripcion'] . ');" title="Eliminar"><i class="fa fa-trash-o fa-2x"><h6>ELIMINAR</h6></i></button>
				</div>
			</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}
	//registra y modifica una inscripcion
	public function setKinder()
	{
		$intIdInscripcion = intval($_POST['idInscripcion']);
		$intMatricula = intval($_POST['listMatricula']);
		$strAula = $_POST['listAulak'];
		$intPeriodo = $_POST['listPeriodoAcademico'];
		$strFechainscripcion = $_POST['dateFechainscripcion'];

		if ($intIdInscripcion == 0) {
			$request_insKinder = $this->model->registerInsKinder($intMatricula, $strAula, $intPeriodo, $strFechainscripcion);
		
			$option = 1;
		} else {
			/*$request_insKinder = $this->model->editInsKinder($intIdInscripcion,$intMatricula, $strAula, $intPeriodo);
			$option = 2;*/
		}

		if ($request_insKinder > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Datos Actualizados correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El estudiante ya se encuentra inscrito.');
			}
		} else if ($request_insKinder == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El estudiante ya se encuentra inscrito.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}


	

	

}
