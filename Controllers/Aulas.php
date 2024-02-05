<?php

class Aulas extends Controllers
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

	public function aulas()
	{
		$data['page_id'] = 4;
		$data['page_tab'] = "Aulas - U.E. Pitufi aldea";
		$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
		$data['page_title2'] = "Aulas";
		$data['page_welcome'] = "Bienvenido a Aulas";
		$data['page_name'] = "aulas";
		$this->views->getView($this, "aulas", $data);
	}
	public function getAulas()
	{
		$arrData = $this->model->selectAulas();
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
				<div class="dropdown-menu">
				<button class="btn btn-success  btn-mini btnVerAula" onClick="btnViewAula(' . $arrData[$i]['idaula'] . ')" title="Ver"><i class="fa fa-eye fa-2x"></i><h6>VISUALIZAR</h6></button>
					<button class="btn btn-primary btn-mini btnEditarAula" type="button" onclick="btnEditAula(' . $arrData[$i]['idaula'] . ');" title="Editar"><i class="fa fa-pencil-square-o fa-2x" ></i><h6>MODIFICAR</h6></button>
					<button class="btn btn-danger btn-mini btnEliminarAula" type="button" onclick="btnDeleteAula(' . $arrData[$i]['idaula'] . ');" title="Eliminar"><i class="fa fa-trash-o fa-2x"><h6>ELIMINAR</h6></i></button>
				</div>
			</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}
	//obtiene las secciones  que existen para seleccionadr
	public function getSelectSecciones()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectSecciones();
		if (count($arrData) > 0) {
			$htmlOptions = '<option value="0">Selecciona una opción</option>';
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['numeroseccion'] == 1 || $arrData[$i]['numeroseccion'] == 2) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idseccion'] . '">' . $arrData[$i]['numeroseccion'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	//obtiene todas las aulas para prekinder que existen para seleccionar
	public function getSelectAulasPrekinder()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectAulasPrekinder();
		if (count($arrData) > 0) {
			$htmlOptions = '<option value="0">Selecciona una opción</option>';
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['idaula'] > 0) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idaula'] . '">' . $arrData[$i]['nombreaula'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}
		//obtiene todas las aulas para kinder que existen para seleccionar
		public function getSelectAulaskinder()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectAulasKinder();
			if (count($arrData) > 0) {
				$htmlOptions = '<option value="0">Selecciona una opción</option>';
				for ($i = 0; $i < count($arrData); $i++) {
					if ($arrData[$i]['idaula'] > 0) {
						$htmlOptions .= '<option value="' . $arrData[$i]['idaula'] . '">' . $arrData[$i]['nombreaula'] . '</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}
	//registra y modifica un Aula
	public function setAulas()
	{
		$intIdAula = intval($_POST['idAula']);
		$strNombreAula =  $_POST['txtNombreAula'];
		$intCapacidadAula = intval($_POST['intCapacidadAula']);
		$intSeccionid = intval($_POST['listSeccionid']);

		if ($intIdAula == 0) {
			$request_aula = $this->model->registerAula($strNombreAula, $intCapacidadAula, $intSeccionid);
			$option = 1;
		} else {
			$request_aula = $this->model->editAula($intIdAula, $strNombreAula, $intCapacidadAula, $intSeccionid);
			$option = 2;
		}
		if ($request_aula > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Datos Actualizados correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Aula ya existe.');
			}
		} else if ($request_aula == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Aula ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

		
	function verAula(int $idaula)
	{
		$intIdAula = intval(($idaula));
		if ($intIdAula > 0) {
			$data = $this->model->selectViewAula($intIdAula);

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
	function editAula(int $idaula)
	{
		$intIdAula = intval(($idaula));
		if ($intIdAula > 0) {
			$data = $this->model->selectEditAula($intIdAula);

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
		public function deleteAula()
		{
			if ($_POST) {
				$intIdAula = intval($_POST['idaula']);
				$requestDel = $this->model->selectDeletAula($intIdAula);
				if ($requestDel) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el aula');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el aula.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	public function reporteAulas()
	{
		$arrData = $this->model->selectAulas();

		require "Fpdf/fpdf.php";


		$fpdf = new FPDF('portrait');
	
        $fpdf->AddPage();
		$fpdf->Image('Assets/images/escudo.jpg',10,8,33,33);	
		$fpdf->SetTitle('Reporte de Aulas');
  
        $fpdf->Cell(45);	
		$fpdf->SetFont('Arial','B',12);
		$fpdf->SetTextColor(56,54,129);	
        $fpdf->Cell(50, 10, 'UNIDAD EDUCATIVA PRIVADA "PITUFI-ALDEA"'); 
		$fpdf->Ln(4);
		$fpdf->Cell(57);	
		$fpdf->SetFont('Arial','B',12);	
        $fpdf->Cell(50, 10, utf8_decode('R.A. 3346/2013- CÓD. SIE: 80890137')); 
		
				
		$fpdf->Image('Assets/images/logotipo.jpg',170,8,33,33);	
        $fpdf->Ln(20);

        $fpdf->Cell(70);
        $fpdf->SetFont('Arial','B',14); 
		$fpdf->SetTextColor(0,0,0);	      
		$fpdf->Cell(50,10,'AULAS DE LA UNIDAD EDUCATIVA',0,1,'C');
		
        $fpdf->Ln(10);

		$fpdf->Image('Assets/images/fondotransparente.png',35,70,140,140);	
		$fpdf->Cell(25);
        $fpdf->SetMargins(10, 0, 0);
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->SetFillColor(68, 138, 255);
        $fpdf->SetTextColor(255, 255, 255);
        $fpdf->Cell(30, 15, '#', 1, 0, 'C', true);
        $fpdf->Cell(50, 15, 'Aula', 1, 0, 'C', true);
        $fpdf->Cell(30, 15, 'Capacidad', 1, 0, 'C', true);
        $fpdf->Cell(30, 15, utf8_decode('Sección'), 1, 1, 'C', true);
       
	
        $fpdf->SetTextColor(0, 0, 0);
		$fpdf->SetFont('Arial', '', 12);
        foreach ($arrData as $columna) { 
		
			$fpdf->Cell(25);	
            $fpdf->Cell(30, 15, $columna['idaula'], 1, 0, 'C');
            $fpdf->Cell(50, 15, $columna['nombreaula'], 1, 0, 'C');
            $fpdf->Cell(30, 15, $columna['capacidad'], 1, 0, 'C');
            $fpdf->Cell(30, 15, $columna['seccionid'], 1, 1, 'C');
            	
        }
        $fpdf->Output();
	}
}
