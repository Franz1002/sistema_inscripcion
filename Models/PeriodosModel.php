<?php
class PeriodosModel extends Mysql
{
    public $intIdPeriodo;
    public $intPeriodoAcademico;
    public $dateFechaInicio;
    public $dateFechaFinal;

    public function __construct()
    {
        parent::__construct();
    }
    public function selectPeriodos()
    {
        $sql = "SELECT idperiodo, anio, DATE_FORMAT(fechainicio, '%d-%m-%Y') as fechaInicio, DATE_FORMAT(fechafinal, '%d-%m-%Y') as fechaFinal, estado FROM periodoacademico";
        $data = $this->select_all($sql);
        return $data;
    }
    public function selectPeriodoEstudiante()
    {
        $sql = "SELECT * FROM periodoacademico WHERE estado = 1";
        $data = $this->select_all($sql);
        return $data;
    }

    public function registerPeriodo(int $anio, string $fechainicio, string $fechaFinal, int $periodo)
    {
        $return = "";
        $this->intPeriodoacademico = $anio;
        $this->dateFechaInicio = $fechainicio;
        $this->dateFechaFinal = $fechaFinal;
        $this->estadoPeriodo = $periodo;

        $sql = "SELECT * FROM periodoacademico WHERE anio = '{$this->intPeriodoacademico}'";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO periodoacademico(anio,fechainicio,fechaFinal,estado) VALUES (?,?,?,?)";
            $arrData = array(
                $this->intPeriodoacademico,
                $this->dateFechaInicio,
                $this->dateFechaFinal,
                $this->estadoPeriodo
            );
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }

    public function editPeriodo(int $idperiodo, int $anio, string $fechainicio, string $fechafinal, int $estado)
    {

        $this->intIdPeriodo = $idperiodo;
        $this->intPeriodoacademico = $anio;
        $this->dateFechaInicio = $fechainicio;
        $this->dateFechaFinal = $fechafinal;
        $this->estadoPeriodo = $estado;  

        $sql = "SELECT * FROM periodoacademico WHERE (anio = '{$this->intPeriodoacademico}' AND idperiodo != $this->intIdPeriodo)";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query = "UPDATE periodoacademico SET anio = ?, fechainicio = ?, fechafinal = ?, estado = ? WHERE idperiodo = $this->intIdPeriodo ";
            $arrData = array(
                $this->intPeriodoacademico,
                $this->dateFechaInicio,
                $this->dateFechaFinal,
                $this->estadoPeriodo,             
            );
            $request = $this->update($query, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }

    public function selectViewPeriodo(int $idperiodo){
        $this->intIdPeriodo = $idperiodo;
        $sql = "SELECT idperiodo, anio, estado, DATE_FORMAT(fechainicio, '%d-%m-%Y') as fechaInicio, DATE_FORMAT(fechafinal, '%d-%m-%Y') as fechaFinal
            FROM periodoacademico
            WHERE idperiodo = $this->intIdPeriodo";
        $request = $this->select($sql);
        return $request;
    }

    public function selectEditPeriodo(int $idperiodo)
    {
        $this->intIdPeriodo = $idperiodo;
        $sql = "SELECT * FROM periodoacademico WHERE idperiodo = $this->intIdPeriodo";
        $request = $this->select($sql);
        return $request;
    }

    public function selectDeletPeriodo(int $idperiodo)
    {
        $this->intIdPeriodo = $idperiodo;
        $query = "DELETE from periodoacademico WHERE idperiodo = $this->intIdPeriodo ";
        $arrData = array(0);
        $request = $this->delete($query,$arrData);
        return $request;   
    }
}
