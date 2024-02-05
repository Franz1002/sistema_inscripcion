<?php 
	$controller = ucwords($controller);
	$controllerFile = "Controllers/".$controller.".php";
	if(file_exists($controllerFile))
	{
		require_once($controllerFile);
		$controller = new $controller();
		if(method_exists($controller, $method))
		{
			$controller->{$method}($params);
		}else{
			echo "<h1>Error, no se encuentra la función</h1>";
		}
	}else{
			echo "<h1>Error, no se encuentra el controlador</h1>";
	}

 ?>