<?php
class CargosModel extends Mysql
{
    public $intIdCargo;
    public $strNombreCargo;
    public $strDescripcion;
    public $intEstado;

    public function __construct()
    {
        parent::__construct();
    }
    public function selectCargos()
    {
        $sql = "SELECT * FROM cargo WHERE estado != 0";
        $data = $this->select_all($sql);
        return $data;
    }

    public function registerCargo(string $nombrecargo, string $descripcion, int $estado)
    {
        $return = "";
        $this->strNombreCargo = $nombrecargo;
        $this->strDescripcion = $descripcion;
        $this->intEstado = $estado;

        $sql = "SELECT * FROM cargo WHERE nombrecargo = '{$this->strNombreCargo}'";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO cargo(nombrecargo,descripcion,estado) VALUES (?,?,?)";
            $arrData = array($this->strNombreCargo, $this->strDescripcion, $this->intEstado);
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }
    public function editCargo(int $idcargo, string $nombrecargo, string $descripcion, int $estado)
    {
        $this->intIdCargo = $idcargo;
        $this->strNombreCargo = $nombrecargo;
        $this->strDescripcion = $descripcion;
        $this->intEstado = $estado;

        $sql = "SELECT * FROM cargo WHERE nombrecargo = '$this->strNombreCargo' AND idcargo != $this->intIdCargo";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query = "UPDATE cargo SET nombrecargo = ?, descripcion = ?, estado = ? WHERE idcargo = ?";
            $arrData = array($this->strNombreCargo, $this->strDescripcion, $this->intEstado, $this->intIdCargo);
            $request = $this->update($query, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }
    public function selectCargo(int $idcargo)
    {
        $this->intIdCargo = $idcargo;
        $sql = "SELECT * FROM cargo WHERE idcargo = $this->intIdCargo";
        $request = $this->select($sql);
        return $request;
    }

    public function deletCargo(int $idcargo)
    {
        $this->intIdCargo = $idcargo;
        $query = "DELETE from cargo WHERE idcargo = $this->intIdCargo ";
        $arrData = array(0);
        $request = $this->delete($query,$arrData);
        return $request;   
    }
}
