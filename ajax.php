
<?php
require_once "Config/cnn.php";
if (isset($_GET['q'])) {
    $datos = array();
    $rude = $_GET['q'];
    $estudiante = mysqli_query($conexion, "SELECT * FROM estudiante WHERE rude LIKE '%$rude%'AND estado = 1");
    while ($row = mysqli_fetch_assoc($estudiante)) {
        $data['id'] = $row['rude'];
        $data['label'] = $row['rude'];
        $data['pNombre'] = $row['primernombre'];
        $data['sNombre'] = $row['segundonombre'];
        $data['aPaterno'] = $row['apellidopaterno'];
        $data['aMaterno'] = $row['apellidomaterno'];
        array_push($datos, $data);
    }
    echo json_encode($datos);
    die();

}else if (isset($_GET['est'])) {
    $datos = array();
    $rude = $_GET['est'];
    $estudiante = mysqli_query($conexion, "SELECT * FROM estudiante WHERE rude LIKE '%$rude%'AND estado = 1");
    while ($row = mysqli_fetch_assoc($estudiante)) {
        $data['id'] = $row['rude'];
        $data['label'] = $row['rude'];
        $data['pNombre'] = $row['primernombre'];
        $data['sNombre'] = $row['segundonombre'];
        $data['aPaterno'] = $row['apellidopaterno'];
        $data['aMaterno'] = $row['apellidomaterno'];
        array_push($datos, $data);
    }
    echo json_encode($datos);
    die();
}

