<?php

class ReporteEstudiante extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('location: ' . SERVER_URL);
        }
        parent::__construct();
    }

    public function reporteestudiante()
    {
        $data['page_id'] = 3;
        $data['page_tab'] = "Reportes - U.E. Pitufi aldea";
        $data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
        $data['page_title2'] = "Reportes de estudiantes";
        $data['page_welcome'] = "Bienvenido a reportes estudiantes";
        $data['page_name'] = "reportes";
        $this->views->getView($this, "reporteestudiante", $data);
    }

    public function reporteRude()
    {
        $reporteRude = $_POST['reporteRude'];
        $data = $this->model->getRudeEstudiante($reporteRude);

        require "Fpdf/fpdf.php";

        $fpdf = new FPDF('landscape');
        $fpdf->AddPage();
        $fpdf->Image('Assets/images/escudo.jpg', 10, 8, 33, 33);


        $fpdf->Cell(90);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->SetTextColor(56, 54, 129);
        $fpdf->Cell(50, 10, 'UNIDAD EDUCATIVA PRIVADA "PITUFI-ALDEA"');
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(2);
        $fpdf->Line(98, 50, 202, 50);
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
        $fpdf->Cell(50, 10, 'REPORTE POR RUDE DEL ESTUDIANTE', 0, 1, 'C');


        $fpdf->Ln(20);

        $fpdf->Image('Assets/images/fondotransparente.png', 98, 66, 112, 112);

        $fpdf->SetMargins(10, 0, 0);
        $fpdf->SetTitle('Reporte de Estudiantes');
        $fpdf->SetFont('Arial', 'B', 8);
        $fpdf->SetFillColor(255, 255, 255);
        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(88, 88, 88);
        $fpdf->Cell(12);
        $fpdf->Cell(8, 10, '#', 0, 0, 'C',);
        $fpdf->Cell(25, 10, 'RUDE', 0, 0, 'C',);
        $fpdf->Cell(15, 10, 'Carnet', 0, 0, 'C',);
        $fpdf->Cell(17, 10, 'P. nombre', 0, 0, 'C',);
        $fpdf->Cell(17, 10, 'S. nombre', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. paterno', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. materno', 0, 0, 'C',);
        $fpdf->Cell(19, 10, 'F. nacimiento', 0, 0, 'C',);
        $fpdf->Cell(17, 10, utf8_decode('Género'), 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Depto. nac.', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Nomb. Tutor', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. Tutor', 0, 0, 'C',);
        $fpdf->Cell(16, 10, 'Parentesco', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Aula', 0, 0, 'C',);
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(1);
        $fpdf->Line(23, 73, 273, 73);
        $fpdf->SetTextColor(0, 0, 0);

        $fpdf->SetLineWidth(0.2);

        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(255, 255, 255);
        $fpdf->SetFillColor(240, 240, 240);
        $fpdf->Ln(13);
        $fpdf->SetFont('Arial', '', 7);
        foreach ($data as $columna) {
            $fpdf->Cell(12);
            $fpdf->Cell(8, 15, $columna['idinscripcion'], 1, 0, 'C', true);
            $fpdf->Cell(25, 15, $columna['rude'], 1, 0, 'C', true);
            $fpdf->Cell(15, 15, $columna['ciestudiante'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['primernombre'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['segundonombre'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidopaterno'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidomaterno'], 1, 0, 'C', true);
            $fpdf->Cell(19, 15, $columna['fechanacimiento'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['genero'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['deptonacido'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombres'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidos'], 1, 0, 'C', true);
            $fpdf->Cell(16, 15, $columna['parentesco'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombreaula'], 1, 0, 'C', true);
            $fpdf->Ln();
        }
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->SetY(184);
        $fpdf->SetX(150);
        $fpdf->AliasNbPages('tpagina');
        $fpdf->Write(5, $fpdf->PageNo() . '/tpagina');
        $fpdf->Output();
    }

    public function reporteAula()
    {
        $reporteAula = $_POST['reporteAula'];
        $data = $this->model->getAulaEstudiante($reporteAula);


        require "Fpdf/fpdf.php";

        $fpdf = new FPDF('landscape');
        $fpdf->AddPage();
        $fpdf->Image('Assets/images/escudo.jpg', 10, 8, 33, 33);


        $fpdf->Cell(90);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->SetTextColor(56, 54, 129);
        $fpdf->Cell(50, 10, 'UNIDAD EDUCATIVA PRIVADA "PITUFI-ALDEA"');
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(2);
        $fpdf->Line(83, 50, 216, 50);
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
        $fpdf->Cell(50, 10, 'REPORTE DE ESTUDIANTES INSCRITOS POR AULA', 0, 1, 'C');


        $fpdf->Ln(20);

        $fpdf->Image('Assets/images/fondotransparente.png', 98, 66, 112, 112);

        $fpdf->SetMargins(10, 0, 0);
        $fpdf->SetTitle('Reporte de Estudiantes');
        $fpdf->SetFont('Arial', 'B', 8);
        $fpdf->SetFillColor(255, 255, 255);
        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(88, 88, 88);
        $fpdf->Cell(12);
        $fpdf->Cell(8, 10, '#', 0, 0, 'C',);
        $fpdf->Cell(25, 10, 'RUDE', 0, 0, 'C',);
        $fpdf->Cell(15, 10, 'Carnet', 0, 0, 'C',);
        $fpdf->Cell(17, 10, 'P. nombre', 0, 0, 'C',);
        $fpdf->Cell(17, 10, 'S. nombre', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. paterno', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. materno', 0, 0, 'C',);
        $fpdf->Cell(19, 10, 'F. nacimiento', 0, 0, 'C',);
        $fpdf->Cell(17, 10, utf8_decode('Género'), 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Depto. nac.', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Nomb. Tutor', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. Tutor', 0, 0, 'C',);
        $fpdf->Cell(16, 10, 'Parentesco', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Aula', 0, 0, 'C',);
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(1);
        $fpdf->Line(23, 73, 273, 73);
        $fpdf->SetTextColor(0, 0, 0);

        $fpdf->SetLineWidth(0.2);

        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(255, 255, 255);
        $fpdf->SetFillColor(240, 240, 240);
        $fpdf->Ln(13);
        $fpdf->SetFont('Arial', '', 7);
        foreach ($data as $columna) {
            $fpdf->Cell(12);
            $fpdf->Cell(8, 15, $columna['idinscripcion'], 1, 0, 'C', true);
            $fpdf->Cell(25, 15, $columna['rude'], 1, 0, 'C', true);
            $fpdf->Cell(15, 15, $columna['ciestudiante'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['primernombre'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['segundonombre'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidopaterno'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidomaterno'], 1, 0, 'C', true);
            $fpdf->Cell(19, 15, $columna['fechanacimiento'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['genero'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['deptonacido'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombres'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidos'], 1, 0, 'C', true);
            $fpdf->Cell(16, 15, $columna['parentesco'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombreaula'], 1, 0, 'C', true);
            $fpdf->Ln();
        }
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->SetY(184);
        $fpdf->SetX(150);
        $fpdf->AliasNbPages('tpagina');
        $fpdf->Write(5, $fpdf->PageNo() . '/tpagina');
        $fpdf->Output();
    }

    public function reporteSeccion()
    {
        $reporteSeccion = $_POST['reporteSeccion'];
        $data = $this->model->getSeccionEstudiante($reporteSeccion);


        require "Fpdf/fpdf.php";

        $fpdf = new FPDF('landscape');
        $fpdf->AddPage();
        $fpdf->Image('Assets/images/escudo.jpg', 10, 8, 33, 33);


        $fpdf->Cell(90);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->SetTextColor(56, 54, 129);
        $fpdf->Cell(50, 10, 'UNIDAD EDUCATIVA PRIVADA "PITUFI-ALDEA"');
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(2);
        $fpdf->Line(83, 50, 216, 50);
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
        $fpdf->Cell(50, 10, utf8_decode('REPORTE DE ESTUDIANTES INSCRITOS POR SECCIÓN'), 0, 1, 'C');


        $fpdf->Ln(20);

        $fpdf->Image('Assets/images/fondotransparente.png', 98, 66, 112, 112);

        $fpdf->SetMargins(10, 0, 0);
        $fpdf->SetTitle('Reporte de Estudiantes');
        $fpdf->SetFont('Arial', 'B', 8);
        $fpdf->SetFillColor(255, 255, 255);
        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(88, 88, 88);
        $fpdf->Cell(12);
        $fpdf->Cell(8, 10, '#', 0, 0, 'C',);
        $fpdf->Cell(25, 10, 'RUDE', 0, 0, 'C',);
        $fpdf->Cell(15, 10, 'Carnet', 0, 0, 'C',);
        $fpdf->Cell(17, 10, 'P. nombre', 0, 0, 'C',);
        $fpdf->Cell(17, 10, 'S. nombre', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. paterno', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. materno', 0, 0, 'C',);
        $fpdf->Cell(19, 10, 'F. nacimiento', 0, 0, 'C',);
        $fpdf->Cell(17, 10, utf8_decode('Género'), 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Depto. nac.', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Nomb. Tutor', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Ap. Tutor', 0, 0, 'C',);
        $fpdf->Cell(16, 10, 'Parentesco', 0, 0, 'C',);
        $fpdf->Cell(20, 10, 'Aula', 0, 0, 'C',);
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(1);
        $fpdf->Line(23, 73, 273, 73);
        $fpdf->SetTextColor(0, 0, 0);

        $fpdf->SetLineWidth(0.2);

        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(255, 255, 255);
        $fpdf->SetFillColor(240, 240, 240);
        $fpdf->Ln(13);
        $fpdf->SetFont('Arial', '', 7);
        foreach ($data as $columna) {
            $fpdf->Cell(12);
            $fpdf->Cell(8, 15, $columna['idinscripcion'], 1, 0, 'C', true);
            $fpdf->Cell(25, 15, $columna['rude'], 1, 0, 'C', true);
            $fpdf->Cell(15, 15, $columna['ciestudiante'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['primernombre'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['segundonombre'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidopaterno'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidomaterno'], 1, 0, 'C', true);
            $fpdf->Cell(19, 15, $columna['fechanacimiento'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['genero'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['deptonacido'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombres'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidos'], 1, 0, 'C', true);
            $fpdf->Cell(16, 15, $columna['parentesco'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombreaula'], 1, 0, 'C', true);
            $fpdf->Ln();
        }
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->SetY(184);
        $fpdf->SetX(150);
        $fpdf->AliasNbPages('tpagina');
        $fpdf->Write(5, $fpdf->PageNo() . '/tpagina');
        $fpdf->Output();
    }
    public function reporteFecha()
    {
        $fechaDesde = $_POST['fechainscripciond'];
        $fechaHasta = $_POST['fechainscripcionh'];
        $data = $this->model->getFechaInscripcion($fechaDesde, $fechaHasta);

        require "Fpdf/fpdf.php";

        $fpdf = new FPDF('landscape');
        $fpdf->AddPage();
        $fpdf->Image('Assets/images/escudo.jpg', 10, 8, 33, 33);


        $fpdf->Cell(90);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->SetTextColor(56, 54, 129);
        $fpdf->Cell(50, 10, 'UNIDAD EDUCATIVA PRIVADA "PITUFI-ALDEA"');
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(2);
        $fpdf->Line(100, 50, 200, 50);
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
        $fpdf->Cell(50, 10, utf8_decode('REPORTE POR FECHA DE INSCRIPCIÓN'), 0, 1, 'C');


        $fpdf->Ln(20);

        $fpdf->Image('Assets/images/fondotransparente.png', 98, 66, 112, 112);

        $fpdf->SetMargins(10, 0, 0);
        $fpdf->SetTitle('Reporte de Estudiantes');
        $fpdf->SetFont('Arial', 'B', 8);
        $fpdf->SetFillColor(255, 255, 255);
        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(88, 88, 88);
        $fpdf->Cell(12);
        $fpdf->Cell(8, 10, '#', 0, 0, 'C', true);
        $fpdf->Cell(25, 10, 'RUDE', 0, 0, 'C', true);
        $fpdf->Cell(15, 10, 'Carnet', 0, 0, 'C', true);
        $fpdf->Cell(17, 10, 'P. nombre', 0, 0, 'C', true);
        $fpdf->Cell(17, 10, 'S. nombre', 0, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Ap. paterno', 0, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Ap. materno', 0, 0, 'C', true);
        $fpdf->Cell(19, 10, 'F. nacimiento', 0, 0, 'C', true);
        $fpdf->Cell(17, 10, utf8_decode('Género'), 0, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Depto. nac.', 0, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Nomb. Tutor', 0, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Ap. Tutor', 0, 0, 'C', true);
        $fpdf->Cell(16, 10, 'Parentesco', 0, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Aula', 0, 0, 'C', true);
        $fpdf->SetDrawColor(61, 174, 233);
        $fpdf->SetLineWidth(1);
        $fpdf->Line(23, 73, 273, 73);
        $fpdf->SetTextColor(0, 0, 0);

        $fpdf->SetLineWidth(0.2);

        $fpdf->SetTextColor(40, 40, 40);
        $fpdf->SetDrawColor(255, 255, 255);
        $fpdf->SetFillColor(240, 240, 240);
        $fpdf->Ln(13);
        $fpdf->SetFont('Arial', '', 7);
        foreach ($data as $columna) {
            $fpdf->Cell(12);
            $fpdf->Cell(8, 15, $columna['idinscripcion'], 1, 0, 'C', true);
            $fpdf->Cell(25, 15, $columna['rude'], 1, 0, 'C', true);
            $fpdf->Cell(15, 15, $columna['ciestudiante'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['primernombre'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['segundonombre'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidopaterno'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidomaterno'], 1, 0, 'C', true);
            $fpdf->Cell(19, 15, $columna['fechanacimiento'], 1, 0, 'C', true);
            $fpdf->Cell(17, 15, $columna['genero'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['deptonacido'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombres'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['apellidos'], 1, 0, 'C', true);
            $fpdf->Cell(16, 15, $columna['parentesco'], 1, 0, 'C', true);
            $fpdf->Cell(20, 15, $columna['nombreaula'], 1, 0, 'C', true);
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
