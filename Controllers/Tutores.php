<?php

class Tutores extends Controllers
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

	public function tutores()
	{
		$data['page_id'] = 5;
		$data['page_tab'] = "Tutores - U.E. Pitufi aldea";
		$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
		$data['page_title2'] = "Tutores";
		$data['page_welcome'] = "Bienvenido a tutores";
		$data['page_name'] = "tutores";
		$this->views->getView($this, "tutores", $data);
	}
	//Obtiene los datos de todos los tutores en un array
	public function getTutores()
	{
		$arrData = $this->model->selectTutores();
		/*$format  = print_r('<pre>');
                $format .= print_r($arrData);
                $format .= print_r('</pre>');
                return $format;*/
		for ($i = 0; $i < count($arrData); $i++) {		
	
			$arrData[$i]['opciones'] = '							
				<div class="text-center">
					<button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="sr-only">Toggle Dropright</span>
					</button>
					<div class="dropdown-menu ">
					<button class="btn btn-success  btn-mini btnVerTutor" onClick="btnViewTutor(' . $arrData[$i]['idtutor'] . ')" title="Ver"><i class="fa fa-eye fa-2x"></i><h6>VISUALIZAR</h6></button>
                		<button class="btn btn-primary btn-mini btnEditarTutor" type="button" onclick="btnEditTutor(' . $arrData[$i]['idtutor'] . ');" title="Editar"><i class="fa fa-pencil-square-o fa-2x" ></i><h6>MODIFICAR</h6></button>
               			<button class="btn btn-danger btn-mini btnEliminarTutor" type="button" onclick="btnDeleteTutor(' . $arrData[$i]['idtutor'] . ');" title="Eliminar"><i class="fa fa-trash-o fa-2x"><h6>ELIMINAR</h6></i></button>
					</div>
				</div>';
		}

		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}

		//obtiene a los tutores que existen para seleccionadr
		public function getSelectTutores()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectTutores();
			if (count($arrData) > 0) {
				$htmlOptions = '<option value="0">Selecciona una opción</option>';
	
				for ($i = 0; $i < count($arrData); $i++) {
					if ($arrData[$i]['idtutor'] > 0) {
						$htmlOptions .= '<option value="' . $arrData[$i]['idtutor'] . '">' . $arrData[$i]['citutor'] . '</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}

	function verTutor(int $idtutor)
	{
		$intIdTutor = intval(($idtutor));
		if ($intIdTutor > 0) {
			$data = $this->model->selectViewTutor($intIdTutor);

			if (empty($data)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$data['url_image'] = SERVER_URL. '/Assets/images/upload/' . $data['fotoestudiante'];
				$arrResponse = array('status' => true, 'data' => $data);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}

	//Selecciona un cargo por el id y permite editar
	function editTutor(int $idtutor)
	{
		$intIdTutor = intval(($idtutor));
		if ($intIdTutor > 0) {
			$data = $this->model->selectEditTutor($intIdTutor);

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
		public function deleteTutor()
		{
			if ($_POST) {
				$intIdTutor = intval($_POST['idtutor']);
				$requestDel = $this->model->selectDeletTutor($intIdTutor);
				if ($requestDel) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Tutor');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el tutor.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}


	public function reporteTutores()
	{
		$arrData = $this->model->selectTutores();
		
		require "Fpdf/fpdf.php";

		$fpdf = new FPDF('portrait');
        $fpdf->AddPage();
		$fpdf->Image('Assets/images/escudo.jpg',10,8,33,33);	

		$fpdf->SetTitle('Reporte de Tutores');
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
		$fpdf->Cell(50,10,'TUTORES DE LA UNIDAD EDUCATIVA',0,1,'C');
		
        $fpdf->Ln(10);

		$fpdf->Image('Assets/images/fondotransparente.png',35,70,140,140);	
		$fpdf->Cell(12);
        $fpdf->SetMargins(10, 0, 0);      
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->SetFillColor(68, 138, 255);
        $fpdf->SetTextColor(255, 255, 255);
        $fpdf->Cell(10, 15, '#', 1, 0, 'C', true);
        $fpdf->Cell(25, 15, utf8_decode('Cédula'), 1, 0, 'C', true);
        $fpdf->Cell(20, 15, 'Expedido', 1, 0, 'C', true);
		$fpdf->Cell(35, 15, 'Nombres', 1, 0, 'C', true);
        $fpdf->Cell(35, 15, 'Apellidos', 1, 0, 'C', true);
        $fpdf->Cell(25, 15, 'Parentesco', 1, 0, 'C', true);
        $fpdf->Cell(20, 15, utf8_decode('Teléfono'), 1, 1, 'C', true);
       
	
        $fpdf->SetTextColor(0, 0, 0);
		$fpdf->SetFont('Arial', '', 11);
        foreach ($arrData as $columna) { 
		
			$fpdf->Cell(12);	
            $fpdf->Cell(10, 10, $columna['idtutor'], 1, 0, 'C');
            $fpdf->Cell(25, 10, $columna['citutor'], 1, 0, 'C');
            $fpdf->Cell(20, 10, $columna['expedido'], 1, 0, 'C');
			$fpdf->Cell(35, 10, $columna['nombres'], 1, 0, 'C');
            $fpdf->Cell(35, 10, $columna['apellidos'], 1, 0, 'C');
            $fpdf->Cell(25, 10, $columna['parentesco'], 1, 0, 'C');
            $fpdf->Cell(20, 10, $columna['telefono'], 1, 1, 'C');
            	
        }
        $fpdf->Output();
	}

}
