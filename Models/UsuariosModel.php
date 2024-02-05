<?php
class UsuariosModel extends Mysql
{
    public $intIdUsuario;
    public $strCiUsuario;
    public $strNombreUsuario;
    public $strApellidoUsuario;
    public $strUserUsuario;
    public $strPassword;
    public $intTelefono;
    public $intCargoid;
    public $intEstado;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectUsuarios()
    {
        $sql = "SELECT u.idusuario,u.ci,u.nombres,u.apellidos,u.user,u.password,u.telefono,u.estado,c.idcargo,c.nombrecargo
                FROM usuario u
                INNER JOIN cargo c
                ON u.cargoid = c.idcargo
                WHERE u.estado != 0 ";
        $request = $this->select_all($sql);
        return $request;
    }


    public function registerUsuario(string $ci, string $nombres, string $apellidos, string $user, string $password, int $telefono, int $cargoid, int $estado)
    {
        $return = "";
        $this->strCiUsuario = $ci;
        $this->strNombreUsuario = $nombres;
        $this->strApellidoUsuario = $apellidos;
        $this->strUserUsuario = $user;
        $this->strPassword = $password;
        $this->intTelefono = $telefono;
        $this->intCargoid = $cargoid;
        $this->intEstado = $estado;

        $sql = "SELECT u.ci, u.nombres, u.apellidos, u.user, u.password, u.telefono, u.cargoid, 
                            c.idcargo, u.estado FROM usuario u 
                            INNER JOIN cargo c
                            ON u.cargoid = c.idcargo
                            WHERE u.ci = '{$this->strCiUsuario}' or u.user = '{$this->strUserUsuario}'";
        $existe = $this->select_all($sql);

        if (empty($existe)) {
            $query = "INSERT INTO usuario(ci,nombres,apellidos,user,password,telefono,cargoid,estado) VALUES (?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strCiUsuario, $this->strNombreUsuario, $this->strApellidoUsuario, $this->strUserUsuario,
                $this->strPassword, $this->intTelefono, $this->intCargoid, $this->intEstado
            );
            $request = $this->insert($query, $arrData);
            $return = $request;
        } else {
            $return = 0;
        }
        return $return;
    }
    public function editUsuario(int $idusuario, string $ci, string $nombres, string $apellidos, string $user, string $password, int $telefono, int $cargoid, int $estado)
    {

        $this->intIdUsuario = $idusuario;
        $this->strCiUsuario = $ci;
        $this->strNombreUsuario = $nombres;
        $this->strApellidoUsuario = $apellidos;
        $this->strUserUsuario = $user;
        $this->strPassword = $password;
        $this->intTelefono = $telefono;
        $this->intCargoid = $cargoid;
        $this->intEstado = $estado;

        $sql = "SELECT * FROM usuario WHERE (user = '{$this->strUserUsuario}' AND idusuario != $this->intIdUsuario)
                                        OR (ci = '{$this->strCiUsuario}' AND idusuario != $this->intIdUsuario) ";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query = "UPDATE usuario SET ci = ?, nombres = ?, apellidos = ?, user = ?, password = ?, telefono = ?, cargoid = ?, estado = ?  WHERE idusuario = $this->intIdUsuario ";
            $arrData = array(
                $this->strCiUsuario,
                $this->strNombreUsuario,
                $this->strApellidoUsuario,
                $this->strUserUsuario,
                $this->strPassword,
                $this->intTelefono,
                $this->intCargoid,
                $this->intEstado
            );
            $request = $this->update($query, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }


    public function selectUsuario(int $idusuario)
    {
        $this->intIdUsuario = $idusuario;
        $sql = "SELECT u.idusuario, u.ci, u.nombres, u.apellidos, u.user, u.telefono, u.password,
         u.cargoid, c.idcargo, c.nombrecargo, u.estado, u.fecharegistro        
            FROM usuario u
            INNER JOIN cargo c
            On u.cargoid = c.idcargo WHERE idusuario = $this->intIdUsuario";
        $request = $this->select($sql);
        return $request;
    }

    public function selectViewUsuario(int $idusuario){
        $this->intIdUsuario = $idusuario;
        $sql = "SELECT u.idusuario, u.ci, u.nombres, u.apellidos, u.user, u.telefono, c.idcargo, c.nombrecargo, u.estado,
        DATE_FORMAT(u.fecharegistro, '%d-%m-%Y') as fechaRegistro
            FROM usuario u
            INNER JOIN cargo c
            On u.cargoid = c.idcargo
            WHERE u.idusuario = $this->intIdUsuario";
        $request = $this->select($sql);
        return $request;
    }


    public function deletUsuario(int $idusuario)
    {
        $this->intIdUsuario = $idusuario;
        $query = "DELETE from usuario WHERE idusuario = $this->intIdUsuario ";
        $arrData = array(0);
        $request = $this->delete($query,$arrData);
        return $request;   
    }
}
