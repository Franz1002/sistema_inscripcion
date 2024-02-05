<?php
class ReporteEstudianteModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getFechaInscripcion(string $fechaDesde, string $fechaHasta)
    {
        $sql = "SELECT `inscripcion`.*, `estudiante`.*, `aula`.*, `periodoacademico`.*, `tutor`.*
        FROM `inscripcion` 
            LEFT JOIN `estudiante` ON `inscripcion`.`estudianteid` = `estudiante`.`rude` 
            LEFT JOIN `aula` ON `inscripcion`.`aulaid` = `aula`.`idaula` 
            LEFT JOIN `periodoacademico` ON `inscripcion`.`periodoid` = `periodoacademico`.`idperiodo`
            LEFT JOIN `tutor` ON `tutor`.`estudianteid` = `estudiante`.`rude` 
           
        WHERE `inscripcion`.`fechainscripcion` BETWEEN '$fechaDesde' AND '$fechaHasta'";
        $data = $this->select_all($sql);
        return $data;
    }
    public function getRudeEstudiante(string $reporteRude)
    {
        $sql = "SELECT `inscripcion`.*, `estudiante`.*, `aula`.*, `periodoacademico`.*, `tutor`.*
        FROM `inscripcion` 
            LEFT JOIN `estudiante` ON `inscripcion`.`estudianteid` = `estudiante`.`rude` 
            LEFT JOIN `aula` ON `inscripcion`.`aulaid` = `aula`.`idaula` 
            LEFT JOIN `periodoacademico` ON `inscripcion`.`periodoid` = `periodoacademico`.`idperiodo`
            LEFT JOIN `tutor` ON `tutor`.`estudianteid` = `estudiante`.`rude` 
           
        WHERE `estudiante`.`rude` LIKE '$reporteRude'";
        $data = $this->select_all($sql);
        return $data;
    }
    public function getAulaEstudiante(string $reporteAula)
    {
        $sql = "SELECT `inscripcion`.*, `estudiante`.*, `aula`.*, `periodoacademico`.*, `tutor`.*
        FROM `inscripcion` 
            LEFT JOIN `estudiante` ON `inscripcion`.`estudianteid` = `estudiante`.`rude` 
            LEFT JOIN `aula` ON `inscripcion`.`aulaid` = `aula`.`idaula` 
            LEFT JOIN `periodoacademico` ON `inscripcion`.`periodoid` = `periodoacademico`.`idperiodo`
            LEFT JOIN `tutor` ON `tutor`.`estudianteid` = `estudiante`.`rude` 
            LEFT JOIN `seccion` ON `aula`.`seccionid` = `seccion`.`idseccion`
        WHERE `aula`.`nombreaula` LIKE '$reporteAula'";
        $data = $this->select_all($sql);
        return $data;
    }
    public function getSeccionEstudiante(string $reporteSeccion)
    {
        $sql = "SELECT `inscripcion`.*, `estudiante`.*, `aula`.*, `periodoacademico`.*, `tutor`.*
        FROM `inscripcion` 
            LEFT JOIN `estudiante` ON `inscripcion`.`estudianteid` = `estudiante`.`rude` 
            LEFT JOIN `aula` ON `inscripcion`.`aulaid` = `aula`.`idaula` 
            LEFT JOIN `periodoacademico` ON `inscripcion`.`periodoid` = `periodoacademico`.`idperiodo`
            LEFT JOIN `tutor` ON `tutor`.`estudianteid` = `estudiante`.`rude` 
            LEFT JOIN `seccion` ON `aula`.`seccionid` = `seccion`.`idseccion`
        WHERE `aula`.`seccionid` LIKE '$reporteSeccion'";
        $data = $this->select_all($sql);
        return $data;
    }
}
