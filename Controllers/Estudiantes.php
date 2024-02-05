<?php

class Estudiantes extends Controllers
{
	public function __construct()
	{
		session_start();
		if (empty($_SESSION['login'])) {
			header('location: ' . SERVER_URL);
		}
		parent::__construct();
	}

	public function estudiantes()
	{
		$data['page_id'] = 7;
		$data['page_tab'] = "Estudiantes - U.E. Pitufi aldea";
		$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
		$data['page_title2'] = "Estudiantes";
		$data['page_welcome'] = "Bienvenido a Estudiantes";
		$data['page_name'] = "estudiantes";
		$this->views->getView($this, "Estudiantes", $data);
	}


	//Obtiene los datos de todos los Estudiantes en un array
	public function getEstudiantes()
	{
		$arrData = $this->model->selectEstudiantes();
		/*$format  = print_r('<pre>');
			$format .= print_r($arrData);
			$format .= print_r('</pre>');
			return $format;*/
		for ($i = 0; $i < count($arrData); $i++) {
			if ($arrData[$i]['estado'] == 1) {
				$arrData[$i]['estado'] = '<span class="badge badge-success" style="align:center;width:100%;text-align:center;">Habilitado</span>';
			} else {
				$arrData[$i]['estado'] = '<span class="badge badge-danger" style="align:center;width:100%;text-align:center;">Abandono</span>';
			}

			$arrData[$i]['opciones'] = '							
			<div class="text-center">
				<button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropright</span>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
					<button class="btn btn-success  btn-mini btnVerEstudiante" type="button" onClick="btnViewEstudiante(' . $arrData[$i]['rude'] . ')" title="Ver"><i class="fa fa-eye fa-2x"></i><h6>VISUALIZAR</h6></button>
					<button class="btn btn-primary btn-mini btnEditarEstudiante" type="button" onclick="btnEditEstudiante(' . $arrData[$i]['idestudiante'] . ');" title="Editar"><i class="fa fa-pencil-square-o fa-2x" ></i><h6>MODIFICAR</h6></button>
					<button class="btn btn-danger btn-mini btnEliminarEstudiante" type="button" onclick="btnDeleteEstudiante(' . $arrData[$i]['rude'] . ');" title="Eliminar"><i class="fa fa-trash-o fa-2x"><h6>ELIMINAR</h6></i></button>
				</div>
			</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}

	//registra y modifica un estudiante
	public function setEstudiante()
	{

		$intIdEstudiante = intval($_POST['idEstudiante']);
		$strCiEstudiante =  $_POST['txtCiEstudiante'];
		$strExpedidoEstudiante = $_POST['listExpedidoEstudiante'];
		$strPrimerNombre = $_POST['txtPrimerNombre'];
		$strSegundoNombre = $_POST['txtSegundoNombre'];
		$strApellidoPaterno =  $_POST['txtApellidoPaterno'];
		$strApellidomaterno = $_POST['txtApellidoMaterno'];
		$strFechaNacimiento = $_POST['dateFechaNacimiento'];
		$strGeneroEstudiante = $_POST['listGenero'];
		$strDeptoNacido =  $_POST['listDepartamentoEstudiante'];
		$strDomicilioEstudiante = $_POST['txtDomicilioEstudiante'];
		$intMatriculaid = $_POST['intMatricula'];
		$intEstado = intval($_POST['listEstado']);

		$fotoEstudiante = $_FILES['fotoEstudiante'];
		$nombre_foto    = $fotoEstudiante['name'];
		$imgEstudiante     = 'defect.png';
		$request_estudiante = "";

		if ($nombre_foto != '') {
			$imgEstudiante = 'img_' . md5(date('d-m-Y H:m:s')) . '.jpg';
		}

		if ($intIdEstudiante == 0) {
			$request_estudiante = $this->model->registerEstudiante(
				$imgEstudiante,
				$strCiEstudiante,
				$strExpedidoEstudiante,
				$strPrimerNombre,
				$strSegundoNombre,
				$strApellidoPaterno,
				$strApellidomaterno,
				$strFechaNacimiento,
				$strGeneroEstudiante,
				$strDeptoNacido,
				$strDomicilioEstudiante,
				$intMatriculaid,
				$intEstado
			);
			$option = 1;
		} else {
			$request_estudiante = $this->model->editEstudiante(
				$intIdEstudiante,
				$imgEstudiante,
				$strCiEstudiante,
				$strExpedidoEstudiante,
				$strPrimerNombre,
				$strSegundoNombre,
				$strApellidoPaterno,
				$strApellidomaterno,
				$strFechaNacimiento,
				$strGeneroEstudiante,
				$strDeptoNacido,
				$strDomicilioEstudiante,
				$intMatriculaid,
				$intEstado
			);
			$option = 2;
		}

		if ($request_estudiante > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				if ($nombre_foto != '') {
					$nombre_foto = $fotoEstudiante['name'];
					$url_temp = $fotoEstudiante['tmp_name'];
					$destino = "Assets/images/upload/" . $imgEstudiante;
					move_uploaded_file($url_temp, $destino);
				}
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Datos Actualizados correctamente.');
				if ($nombre_foto != '') {
					$nombre_foto = $fotoEstudiante['name'];
					$url_temp = $fotoEstudiante['tmp_name'];
					$destino = "Assets/images/upload/" . $imgEstudiante;
					move_uploaded_file($url_temp, $destino);
				}
				if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'defect.png') || ($nombre_foto != '' && $_POST['foto_actual'] != 'defect.png')) {

					//deleteFile($_POST['foto_actual']);
				}
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Estudiante ya existe.');
			}
		} else if ($request_estudiante == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! El Estudiante ya existe.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}
	//registra o modifica un 
	public function setTutore()
	{
		$intIdTutor = intval($_POST['idTutor']);
		$intCiTutor =  intval($_POST['txtCiTutor']);
		$strExpedido =  $_POST['listExpedido'];
		$strParentesco = $_POST['listParentesco'];
		$strNombreTutor =  $_POST['txtNombreTutor'];
		$strApellidoTutor = $_POST['txtApellidoTutor'];
		$intTelefonoTutor = intval($_POST['intTelefonoTutor']);
		$intEstudiante = intval($_POST['listRudes']);

		if ($intIdTutor == 0) {
			$request_tutor = $this->model->registerTutore(
				$intCiTutor,
				$strExpedido,
				$strParentesco,
				$strNombreTutor,
				$strApellidoTutor,
				$intTelefonoTutor,
				$intEstudiante
			);
			$option = 1;
		} else {
			$request_tutor = $this->model->editTutore(
				$intIdTutor,
				$intCiTutor,
				$strExpedido,
				$strParentesco,
				$strNombreTutor,
				$strApellidoTutor,
				$intTelefonoTutor,
				$intEstudiante
			);
			$option = 2;
		}

		if ($request_tutor > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
			} else if ($option == 2) {
				$arrResponse = array('statuss' => true, 'msg' => 'Datos Actualizados correctamente.');
			} else {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención! la asignaciòn ya existe.');
			}
		} else if ($request_tutor == 0) {
			$arrResponse = array('statusss' => true, 'msg' => '¡Atención! Error .');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}


	//obtiene las matrículas  que existen para seleccionar
	public function getSelectMatriculas()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectMatriculas();
		if (count($arrData) > 0) {
			$htmlOptions = '<option value="0">Selecciona una opción</option>';

			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['idestudiante'] > 0) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idestudiante'] . '">' . $arrData[$i]['rude'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	//obtiene las matrículas  que existen para seleccionar
	public function getSelectCedulas()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectCedulas();
		if (count($arrData) > 0) {
			$htmlOptions = '<option value="0">Selecciona una opción</option>';

			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['idestudiante'] > 0) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idestudiante'] . '">' . $arrData[$i]['ciestudiante'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	function verEstudiante(int $rude)
	{
		$intIdRude = intval(($rude));
		if ($intIdRude > 0) {
			$data = $this->model->selectViewEstudiante($intIdRude);
			if (empty($data)) {
				$arrResponse = array('statusss' => true, 'msg' => '¡Atención!.');
			} else {
				$data['url_image'] = SERVER_URL . '/Assets/images/upload/' . $data['fotoestudiante'];

				$arrResponse = array('status' => true, 'data' => $data);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}

	//Selecciona un cargo por el id y permite editar
	function editEstudiante(int $idestudiante)
	{
		$intIdEstudiante = intval(($idestudiante));
		if ($intIdEstudiante > 0) {
			$data = $this->model->selectEditEstudiante($intIdEstudiante);

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
	public function deleteEstudiante()
	{
		if ($_POST) {
			$intIdRude = intval($_POST['rude']);
			$requestDel = $this->model->selectDeletEstudiante($intIdRude);
			if ($requestDel) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado al Estudiante');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar Estudiante.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	//registra y modifica un estudiante


	public function reporteEstudiantes()
	{
		$data = $this->model->selectEstudiantes();

		require "Fpdf/fpdf.php";



		$fpdf = new FPDF('landscape');

		$fpdf->AddPage();

		$fpdf->Image('Assets/images/escudo.jpg', 10, 8, 33, 33);


		$fpdf->Cell(90);
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetTextColor(56, 54, 129);
		$fpdf->Cell(50, 10, 'UNIDAD EDUCATIVA PRIVADA "PITUFI-ALDEA"');
		$fpdf->SetDrawColor(61,174,233);
		$fpdf->SetLineWidth(2);
		$fpdf->Line(95, 50, 205, 50);
		$fpdf->Ln(4);
		$fpdf->Cell(101);
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->Cell(50, 10, utf8_decode('R.A. 3346/2013- CÓD. SIE: 80890137'));

		$fpdf->Cell(30);
		$fpdf->Image('Assets/images/logotipo.jpg', 250, 8, 33, 33);
		$fpdf->Ln(20);

		$fpdf->Cell(114);
		$fpdf->SetFont('Arial', 'B', 14);
		$fpdf->SetTextColor(0, 0, 0);
		$fpdf->Cell(50, 10, utf8_decode('ESTUDIANTES DE LA UNIDAD EDUCATIVA'), 0, 1, 'C');


		$fpdf->Ln(20);

		$fpdf->Image('Assets/images/fondotransparente.png', 90, 56, 125, 125);
		$fpdf->Cell(20);
		$fpdf->SetMargins(10, 0, 0);
		$fpdf->SetTitle('Reporte de Estudiantes');
		$fpdf->SetFont('Arial', 'B', 10);
		$fpdf->SetFillColor(255, 255, 255);
		$fpdf->SetTextColor(40, 40, 40);
		$fpdf->SetDrawColor(88, 88, 88);
		
		$fpdf->Cell(34, 10, 'RUDE', 0, 0, 'C', );
		$fpdf->Cell(22, 10, utf8_decode('Cédula'), 0, 0, 'C', );
		$fpdf->Cell(12, 10, 'Exp.', 0, 0, 'C', );
		$fpdf->Cell(20, 10, 'P. nombre', 0, 0, 'C', );
		$fpdf->Cell(20, 10, 'S. nombre', 0, 0, 'C', );
		$fpdf->Cell(20, 10, 'A. paterno', 0, 0, 'C', );
		$fpdf->Cell(20, 10, 'A. materno', 0, 0, 'C', );
		$fpdf->Cell(30, 10, 'F. de nacimiento.', 0, 0, 'C', );
		$fpdf->Cell(27, 10, utf8_decode('SEXO'), 0, 0, 'C', );
		$fpdf->Cell(29, 10, 'Depto. Nac.', 0, 0, 'C', );
		$fpdf->SetDrawColor(61,174,233);
		$fpdf->SetLineWidth(1);
		$fpdf->Line(30, 73, 264, 73);
		$fpdf->SetTextColor(0, 0, 0);

		$fpdf->SetLineWidth(0.2);

		$fpdf->SetTextColor(40, 40, 40);
		$fpdf->SetDrawColor(255, 255, 255);
		$fpdf->SetFillColor(240,240,240);
		$fpdf->Ln(13);
		$fpdf->SetFont('Arial', '', 10);

		foreach ($data as $columna) {
		
			$fpdf->Cell(20);
			$fpdf->Cell(34, 10, $columna['rude'], 1, 0, 'C',true);
			$fpdf->Cell(22, 10, $columna['ciestudiante'], 1, 0, 'C',true);
			$fpdf->Cell(12, 10, $columna['expedido'], 1, 0, 'C',true);
			$fpdf->Cell(20, 10, $columna['primernombre'], 1, 0, 'C',true);
			$fpdf->Cell(20, 10, $columna['segundonombre'], 1, 0, 'C',true);
			$fpdf->Cell(20, 10, $columna['apellidopaterno'], 1, 0, 'C',true);
			$fpdf->Cell(20, 10, $columna['apellidomaterno'], 1, 0, 'C',true);
			$fpdf->Cell(30, 10, $columna['fechanacimiento'], 1, 0, 'C',true);
			$fpdf->Cell(27, 10, $columna['genero'], 1, 0, 'C',true);
			$fpdf->Cell(29, 10, $columna['deptonacido'], 1, 0, 'C',true);
			$fpdf->Ln();
		}
		$fpdf->SetFont('Arial', 'B', 12);
		$fpdf->SetY(184);
		$fpdf->SetX(150);
		$fpdf->AliasNbPages('tpagina');
		$fpdf->Write(5, $fpdf->PageNo() . '/tpagina');
		$fpdf->Output();
	}
}
