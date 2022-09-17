<?php

    //Clase Crear Directorio
    Class CrearDirectorio{
        //Variables
        protected $directorio = '';

        //Método constructor
        public function __construct(string $directorio){
            $this->directorio = $directorio;
        }

        //Función crear
        function crear(){
            //Comprobamos que el directorio no exista
            if(!is_dir($this->directorio)){
                mkdir($this->directorio, 0744);
                if($this->directorio){
                    header('Location: ../index.php?dirExist=1');
                }else{
                    header('Location: ../index.php?dirExist=2');
                }
            }else{
                header('Location: ../index.php?errorDirExist=1');
            }
        }
    }
?>