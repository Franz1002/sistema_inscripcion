<?php

class Login extends Controllers
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header('location: ' . SERVER_URL . '/inicio');
        }
        parent::__construct();
    }

    public function login()
    {
        $this->views->getView($this, "login");
    }

    public function log()
    {

        if ($_POST) {
            if (empty($_POST['user']) || empty($_POST['password'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos');
            } else {
                $strUser = strtolower($_POST['user']);
                $strPassword = $_POST['password'];
                $requestUser = $this->model->getUsuario($strUser, $strPassword);
                if (empty($requestUser)) {
                    $arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
                    //incorrecto
                } else {
                    $arrData = $requestUser;
                    if ($arrData['estado'] == 1) {

                        $_SESSION['idUsuario'] = $arrData['idusuario'];
                        $_SESSION['login'] = true;
                        $_SESSION['timeout'] = true;
                        $_SESSION['inicio'] = time();

                        $arrData = $this->model->sessionLogin($_SESSION['idUsuario']);

                        $_SESSION['idUsuario'] = $arrData;

                        $arrResponse = 1; //ok entro
                     
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }

        die();
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location: " . SERVER_URL);
    }
}
