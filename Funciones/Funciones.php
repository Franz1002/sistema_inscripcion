<?php function sessionUser(int $idusuario)
{
    require_once("Models/UsuariosModel.php");
    $objLogin = new UsuariosModel();
    $request = $objLogin->sessionLogin($idusuario);
    return $request;
}
function deleteFile(string $name)
{
    unlink('Assets/images/upload/'.$name);
}