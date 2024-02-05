<?php
class EstudiantesModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }
    public function selectEstudiantes()
    {
        $sql = "SELECT *
                FROM estudiante                
                WHERE estado != 0";
        $request = $this->select_all($sql);
        return $request;
    }
    public function registerEstudiante(
        string $fotoestudiante,
        string $ciestudiante,
        string $expedido,
        string $primernombre,
        string $segundonombre,
        string $apellidopaterno,
        string $apellidomaterno,
        string $fechanacimiento,
        string $genero,
        string $deptonacido,
        string $domicilio,
        string $rude,    
        int $estado
    ) {
        $return = "";
        $this->imgEstudiante = $fotoestudiante;
        $this->strCiEstudiante = $ciestudiante;
        $this->strExpedidoEstudiante = $expedido;
        $this->strPrimerNombre = $primernombre;
        $this->strSegundoNombre = $segundonombre;
        $this->strApellidoPaterno = $apellidopaterno;
        $this->strApellidomaterno = $apellidomaterno;
        $this->strFechaNacimiento = $fechanacimiento;
        $this->strGeneroEstudiante = $genero;
        $this->strDeptoNacido = $deptonacido;
        $this->strDomicilioEstudiante = $domicilio;
        $this->intMatriculaid = $rude;   
        $this->intEstado = $estado;


        $sql = "SELECT * FROM estudiante WHERE ciestudiante = '{$this->strCiEstudiante}' or rude = '{$this->intMatriculaid}'";
        $existe = $this->select_all($sql);


        if (empty($existe)) {
            $query = "INSERT INTO estudiante(fotoestudiante,ciestudiante,expedido,primernombre,
            segundonombre,apellidopaterno,apellidomaterno,fechanacimiento,genero,
            deptonacido,domicilio,rude,estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->imgEstudiante,
                $this->strCiEstudiante,
                $this->strExpedidoEstudiante,
                $this->strPrimerNombre,
                $this->strSegundoNombre,
                $this->strApellidoPaterno,
                $this->strApellidomaterno,
                $this->strFechaNacimiento,
                $this->strGeneroEstudiante,
                $this->strDeptoNacido,
                $this->strDomicilioEstudiante,
                $this->intMatriculaid,         
                $this->intEstado
            );
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }

    public function registerTutore(string $citutor, string $expedido, string $nombres, string $apellidos, string $parentesco, int $telefono, int $estudianteid)
    {
        $return = "";
        $this->intCiTutor = $citutor;
        $this->strExpedido = $expedido;
        $this->strParentesco = $nombres;
        $this->strNombreTutor = $apellidos;
        $this->strApellidoTutor = $parentesco;
        $this->intTelefonoTutor = $telefono;
        $this->intEstudiante = $estudianteid;

        $sql = "SELECT * FROM tutor WHERE estudianteid = '{$this->intEstudiante}'";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO tutor(citutor,expedido,parentesco,nombres,apellidos,telefono,estudianteid) VALUES (?,?,?,?,?,?,?)";
            $arrData = array($this->intCiTutor, $this->strExpedido, $this->strParentesco, $this->strNombreTutor, $this->strApellidoTutor, $this->intTelefonoTutor, $this->intEstudiante);
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }
    public function editTutore(int $idtutor, string $citutor, string $expedido, string $nombres, string $apellidos, string $parentesco, int $telefono, int $estudianteid)
    {
        $this->intIdTutor = $idtutor;
        $this->intCiTutor = $citutor;
        $this->strExpedido = $expedido;
        $this->strParentesco = $nombres;
        $this->strNombreTutor = $apellidos;
        $this->strApellidoTutor = $parentesco;
        $this->intTelefonoTutor = $telefono;
        $this->intEstudiante = $estudianteid;


        $sql = "SELECT * FROM tutor WHERE(citutor = '{$this->intCiTutor}' AND idtutor != $this->intIdTutor)
        OR (estudianteid = '{$this->intEstudiante}' AND idtutor != $this->intIdTutor)";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query = "UPDATE tutor SET citutor = ?, expedido = ?, nombres = ?, apellidos = ?, parentesco = ?, telefono = ?, estudianteid = ? WHERE idtutor = $this->intIdTutor ";
            $arrData = array(
                $this->intCiTutor,
                $this->strExpedido,
                $this->strNombreTutor,
                $this->strApellidoTutor,
                $this->strParentesco,
                $this->intTelefonoTutor,
                $this->intEstudiante
            );
            $request = $this->update($query, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }


    public function selectMatriculas()
    {
        $sql = "SELECT *
                FROM estudiante";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectCedulas()
    {
        $sql = "SELECT *
                FROM estudiante";
        $request = $this->select_all($sql);
        return $request;
    }
    public function editEstudiante(
        int $idestudiante,
        string $fotoestudiante,
        string $ciestudiante,
        string $expedido,
        string $primernombre,
        string $segundonombre,
        string $apellidopaterno,
        string $apellidomaterno,
        string $fechanacimiento,
        string $genero,
        string $deptonacido,
        string $domicilio,
        int $rude,
        int $estado
    ) {
        $this->intIdEstudiante = $idestudiante;
        $this->imgEstudiante = $fotoestudiante;
        $this->strCiEstudiante = $ciestudiante;
        $this->strExpedidoEstudiante = $expedido;
        $this->strPrimerNombre = $primernombre;
        $this->strSegundoNombre = $segundonombre;
        $this->strApellidoPaterno = $apellidopaterno;
        $this->strApellidomaterno = $apellidomaterno;
        $this->strFechaNacimiento = $fechanacimiento;
        $this->strGeneroEstudiante = $genero;
        $this->strDeptoNacido = $deptonacido;
        $this->strDomicilioEstudiante = $domicilio;
        $this->intMatriculaid = $rude;
        $this->intEstado = $estado;

        $sql = "SELECT * FROM estudiante WHERE (ciestudiante = '{$this->strCiEstudiante}' AND idestudiante != $this->intIdEstudiante)
        OR (rude = '{$this->intMatriculaid}' AND idestudiante != $this->intIdEstudiante) ";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query = "UPDATE estudiante SET rude = ?, fotoestudiante = ?, ciestudiante = ?, expedido = ?, primernombre = ?, segundonombre = ?, apellidopaterno = ?, apellidomaterno = ?, fechanacimiento = ?, genero = ?, deptonacido = ?, domicilio = ?, estado = ? WHERE idestudiante = $this->intIdEstudiante ";
            $arrData = array(
                $this->intMatriculaid, 
                $this->imgEstudiante,
                $this->strCiEstudiante,
                $this->strExpedidoEstudiante,
                $this->strPrimerNombre,
                $this->strSegundoNombre,
                $this->strApellidoPaterno,
                $this->strApellidomaterno,
                $this->strFechaNacimiento,
                $this->strGeneroEstudiante,
                $this->strDeptoNacido,
                $this->strDomicilioEstudiante,      
                $this->intEstado
            );
            $request = $this->update($query, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }

    public function selectViewEstudiante(int $rude)
    {
        $this->intIdEstudiante = $rude;
        $sql = "SELECT e.rude, e.fotoestudiante, e.ciestudiante, e.expedido, e.primernombre, e.segundonombre, e.apellidopaterno,
        e.apellidomaterno, DATE_FORMAT(e.fechanacimiento, '%d-%m-%Y') as fechaNacimiento, e.genero, e.deptonacido, e.domicilio, e.estado, t.citutor, t.expedido,
        t.nombres, t.apellidos, t.parentesco, t.telefono
            FROM estudiante e
            INNER JOIN tutor t
            On e.rude = t.estudianteid
            WHERE e.rude = $this->intIdEstudiante";
        $request = $this->select($sql);
        return $request;
    }

    public function selectEditEstudiante(int $idestudiante)
    {
        $this->intIdEstudiante = $idestudiante;
        $sql = "SELECT * FROM estudiante WHERE idestudiante = $this->intIdEstudiante";
        $request = $this->select($sql);
        return $request;
    }

    public function selectDeletEstudiante(int $rude)
    {
        $this->intIdEstudiante = $rude;
        $query = "DELETE from estudiante WHERE rude = $this->intIdEstudiante ";
        $arrData = array(0);
        $request = $this->delete($query, $arrData);
        return $request;
    }
}
