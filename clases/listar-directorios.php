<?php

    //Clase ListarDirectorios
    Class ListarDirectorios{
        //Método constructor
        public function __construct(){

        }

        //Función listar_devolver
        function listar_devolver(string $directorios_ls){
            //Separamos los directorios
            $directorios_ok = array();
            $directoriosScan = scandir($directorios_ls);
            if(is_dir($directorios_ls)){
                for($a = 0 ; $a < COUNT($directoriosScan) ; $a++){
                    if($directoriosScan[$a] != '.' && $directoriosScan[$a] != '..'){
                        if(is_dir($directorios_ls.'/'.$directoriosScan[$a])){
                            array_push($directorios_ok, $directorios_ls.'/'.$directoriosScan[$a]);
                            $dirs = new ListarDirectorios();
                            $resultado = $dirs->listar_devolver($directorios_ls.'/'.$directoriosScan[$a]);
                            for($e = 0; $e < COUNT($resultado) ; $e++){
                                array_push($directorios_ok, $resultado[$e]);
                            }
                        }
                    }
                }
            }else{
                header('Location: ../index.php?errorDir=1');
            }
            return $directorios_ok;
        }
    }
?>