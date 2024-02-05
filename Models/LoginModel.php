
    <?php
    class LoginModel extends Mysql
    {

        public function __construct()
        {
            parent::__construct();
        }
        public function getUsuario(string $user, string $password)
        {
            $this->strUser = $user;
            $this->strPassword = $password;
            $sql = "SELECT idusuario, cargoid, estado FROM usuario WHERE user = '$this->strUser'
         AND password = '$this->strPassword' AND estado !=0 ";
            $data = $this->select($sql);

            return $data;
        }
        public function sessionLogin(int $idusuario)
        {
            $this->intIdUsuario = $idusuario;

            $sql = "SELECT *
                   FROM usuario u
                   INNER JOIN cargo c
                   ON u.cargoid = c.idcargo
                   WHERE u.idusuario = $this->intIdUsuario";
            $request = $this->select($sql);
            //$_SESSION['userData'] = $request;
            return $request;
        }
    }
