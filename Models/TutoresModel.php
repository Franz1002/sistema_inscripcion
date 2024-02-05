<?php
class TutoresModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectTutores()
    {
        $sql = "SELECT *
                FROM tutor";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectExpedido()
    {
        $sql = "SELECT expedido FROM tutor WHERE idtutor != 0";
        $data = $this->select_all($sql);
        return $data;
    }


    public function registerTutor(string $citutor, string $expedido, string $nombres, string $apellidos, string $parentesco, int $telefono)
    {
        $return = "";
        $this->intCiTutor = $citutor;
        $this->strExpedido = $expedido;
        $this->strParentesco = $nombres;
        $this->strNombreTutor = $apellidos;
        $this->strApellidoTutor = $parentesco;
        $this->intTelefonoTutor = $telefono;

        $sql = "SELECT * FROM tutor WHERE citutor = '{$this->intCiTutor}'";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO tutor(citutor,expedido,parentesco,nombres,apellidos,telefono) VALUES (?,?,?,?,?,?)";
            $arrData = array($this->intCiTutor, $this->strExpedido, $this->strParentesco, $this->strNombreTutor, $this->strApellidoTutor, $this->intTelefonoTutor);
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }


    public function selectViewTutor(int $idtutor){
        $this->intIdTutor = $idtutor;
        $sql = "SELECT e.rude, e.fotoestudiante, e.ciestudiante, e.expedido, e.primernombre, e.segundonombre, e.apellidopaterno,
        e.apellidomaterno, DATE_FORMAT(e.fechanacimiento, '%d-%m-%Y') as fechaNacimiento, e.genero, e.deptonacido, e.domicilio, e.estado, t.citutor, t.expedido,
        t.nombres, t.apellidos, t.parentesco, t.telefono
            FROM estudiante e
            INNER JOIN tutor t
            On e.rude = t.estudianteid
            WHERE t.idtutor = $this->intIdTutor";
        $request = $this->select($sql);
        return $request;
    }

    public function selectEditTutor(int $idtutor)
    {
        $this->intIdTutor = $idtutor;
        $sql = "SELECT * FROM tutor WHERE idtutor = $this->intIdTutor";
        $request = $this->select($sql);
        return $request;
    }

    public function selectDeletTutor(int $idtutor)
    {
        $this->intIdTutor = $idtutor;
        $query = "DELETE from tutor WHERE idtutor = $this->intIdTutor ";
        $arrData = array(0);
        $request = $this->delete($query,$arrData);
        return $request;   
    }
}
