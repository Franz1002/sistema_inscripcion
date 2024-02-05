<?php
    class InicioModel extends Mysql{
        public function __construct()
        {
            parent::__construct();
            
        }
        public function getUsuariosTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM usuario";
            $data = $this->select($sql);
            return $data;
        }
        public function getCargosTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM cargo";
            $data = $this->select($sql);
            return $data;
        }
        public function getAulasTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM aula";
            $data = $this->select($sql);
            return $data;
        }
        public function getEstudiantesTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM estudiante";
            $data = $this->select($sql);
            return $data;
        }
        public function getTutoresTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM tutor";
            $data = $this->select($sql);
            return $data;
        }
        public function getPrekinderTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM inscripcion where aulaid < 4 ";
            $data = $this->select($sql);
            return $data;
        }
        public function getKinderTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM inscripcion where aulaid > 3 ";
            $data = $this->select($sql);
            return $data;
        }
        public function getGestionesTotal()
        {
            $sql = "SELECT COUNT(*) AS total FROM periodoacademico";
            $data = $this->select($sql);
            return $data;
        }
    }
?>