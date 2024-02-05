<?php
class PreKinderModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }
    public function selectEstPreKinders()
    {
        $sql = "SELECT i.idinscripcion,i.estudianteid,e.rude,e.primernombre,e.apellidopaterno,e.apellidomaterno,a.idaula,a.nombreaula,a.seccionid,i.fechainscripcion
                        FROM inscripcion i
                        INNER JOIN estudiante e
                        ON i.estudianteid = e.rude
                        INNER JOIN aula a
                        ON i.aulaid = a.idaula
                        
                        WHERE i.idinscripcion != 0 and a.seccionid = 1";
        $request = $this->select_all($sql);
        return $request;
    }

    public function registerInsPrekinder(int $estudianteid, int $aulaid, string $periodoid, string $fechainscripcion)
    {
        $return = "";
        $this->intMatricula = $estudianteid;
        $this->strAula = $aulaid;
        $this->intPeriodo = $periodoid;
        $this->strFechainscripcion = $fechainscripcion;

        $sql = "SELECT i.idinscripcion, i.estudianteid, i.aulaid, i.periodoid, e.rude, e.estado, p.idperiodo, p.anio 
        from inscripcion i
        INNER JOIN estudiante e ON i.estudianteid = e.rude
        INNER JOIN periodoacademico p ON i.periodoid = p.idperiodo
        WHERE i.estudianteid = '{$this->intMatricula}'
                     and i.periodoid ='{$this->intPeriodo}'
                     and e.estado = 1";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO inscripcion(estudianteid,aulaid,periodoid,fechainscripcion) VALUES (?,?,?,?)";
            $arrData = array($this->intMatricula, $this->strAula, $this->intPeriodo, $this->strFechainscripcion);
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }
}
