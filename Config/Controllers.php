<?php 
	
	class Controllers
	{
		public function __construct()
		{
			$this->views = new Views();
			$this->loadModel();
		}

		public function loadModel()
		{			
			$model = get_class($this)."Model";
			$classPath = "Models/".$model.".php";
			if(file_exists($classPath)){
				require_once($classPath);
				$this->model = new $model();
			}
		}
	}

 ?>