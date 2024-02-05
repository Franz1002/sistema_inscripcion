<?php
class Connection
{

	private $conect;

	public function __construct()
	{

		$sgbd = "mysql:host=" . HOST . ";dbname=" . DATA_BASE . ";charset.";
		try {
			$this->conect = new PDO($sgbd, USER, PASSWORD);
			$this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$this->conect = 'Error en la conexión';
			echo "ERROR: " . $e->getMessage();
		}
	}

	public function conect()
	{
		return $this->conect;
	}
}
