<?php
    class AulasModel extends Mysql{
        public $intIdAula;
        public $intCapacidad; 
        public $intSeccionid;

        public function __construct()
        {
            parent::__construct();
            
        }
        public function selectAulas()
        {
            $sql = "SELECT a.idaula,a.nombreaula,a.capacidad,a.seccionid,s.idseccion,s.numeroseccion
                FROM aula a
                INNER JOIN seccion s
                ON a.seccionid = s.idseccion
                WHERE a.seccionid != 0 ";
                $request = $this->select_all($sql);
                return $request;
        }

        public function selectAulasPrekinder()
        {
            $sql = "SELECT a.idaula,a.nombreaula,a.capacidad,a.seccionid,s.idseccion,s.numeroseccion
                FROM aula a
                INNER JOIN seccion s
                ON a.seccionid = s.idseccion
                WHERE a.seccionid = 1 ";
                $request = $this->select_all($sql);
                return $request;
        }
        public function selectAulasKinder()
        {
            $sql = "SELECT a.idaula,a.nombreaula,a.capacidad,a.seccionid,s.idseccion,s.numeroseccion
                FROM aula a
                INNER JOIN seccion s
                ON a.seccionid = s.idseccion
                WHERE a.seccionid = 2 ";
                $request = $this->select_all($sql);
                return $request;
        }

        public function selectSecciones()
        {
            $sql = "SELECT * FROM seccion WHERE numeroseccion != 0";
            $data = $this->select_all($sql);
            return $data;
        }
        public function registerAula(string $nombreaula, string $capacidad, int $seccionid)
        {
            $return = "";
            $this->strNombreAula = $nombreaula;
            $this->intCapacidadAula = $capacidad;
            $this->intSeccionid = $seccionid;
    
            $sql = "SELECT * FROM aula WHERE nombreaula = '{$this->strNombreAula}'";
            $existe = $this->select_all($sql);
    
            if (empty($existe)) {
                $query = "INSERT INTO aula(nombreaula,capacidad,seccionid) VALUES (?,?,?)";
                $arrData = array($this->strNombreAula, $this->intCapacidadAula, $this->intSeccionid);
                $request = $this->insert($query, $arrData);
                $return = $request;
            } else {
                $return = 0;
            }
            return $return;
        }
        public function editAula(int $idaula, string $nombreaula, int $capacidad, int $seccionid)
        {
    
            $this->intIdAula = $idaula;
            $this->strNombreAula = $nombreaula;
            $this->intCapacidadAula = $capacidad;
            $this->intSeccionid = $seccionid;
               
    
            $sql = "SELECT * FROM aula WHERE (nombreaula = '{$this->strNombreAula}' AND idaula != $this->intIdAula)";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $query = "UPDATE aula SET nombreaula = ?, capacidad = ?, seccionid = ? WHERE idaula = $this->intIdAula ";
                $arrData = array(
                    $this->strNombreAula,
                    $this->intCapacidadAula,
                    $this->intSeccionid                  
                );
                $request = $this->update($query, $arrData);
            } else {
                $request = 0;
            }
            return $request;
        }

        public function selectViewAula(int $idaula){
            $this->intIdAula = $idaula;
            $sql = "SELECT a.idaula, a.nombreaula, a.capacidad, s.idseccion, s.numeroseccion
                FROM aula a
                INNER JOIN seccion s
                On a.seccionid = s.idseccion
                WHERE a.idaula = $this->intIdAula";
            $request = $this->select($sql);
            return $request;
        }

        public function selectEditAula(int $idaula)
        {
            $this->intIdAula = $idaula;
            $sql = "SELECT * FROM aula WHERE idaula = $this->intIdAula";
            $request = $this->select($sql);
            return $request;
        }

        public function selectDeletAula(int $idaula)
        {
            $this->intIdAula = $idaula;
            $query = "DELETE from aula WHERE idaula = $this->intIdAula ";
            $arrData = array(0);
            $request = $this->delete($query,$arrData);
            return $request;   
        }
    

    }
?>