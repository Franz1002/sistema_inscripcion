<?php 

	class Inicio extends Controllers{
		public function __construct()
		{    
			session_start();
			if(empty($_SESSION['login']))
			{
				header('location: '.SERVER_URL);
			}  
			parent::__construct();
		
		}

		public function inicio()
		{
			$data['page_id'] = 1;
			$data['page_tab'] = "Inicio - U.E. Pitufi aldea";
			$data['page_title'] = "UNIDAD EDUCATIVA 'PITUFI ALDEA'";
			$data['page_welcome'] = "Bienvenido al inicio";
			$data['page_name'] = "inicio";
			$data['usuarios'] = $this->model->getUsuariosTotal();
			$data['cargos'] = $this->model->getCargosTotal();
			$data['aulas'] = $this->model->getAulasTotal();
			$data['estudiantes'] = $this->model->getEstudiantesTotal();
			$data['tutores'] = $this->model->getTutoresTotal();
			$data['prekinder'] = $this->model->getPrekinderTotal();
			$data['kinder'] = $this->model->getKinderTotal();
			$data['gestiones'] = $this->model->getGestionesTotal();
			$this->views->getView($this,"inicio",$data);
		}



	}
