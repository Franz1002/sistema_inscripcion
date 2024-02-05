<?php
spl_autoload_register(function($class){
    if (file_exists("Config/". $class.".php")) {
       require_once "Config/". $class.".php";
    }    
})

?>