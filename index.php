<?php
    require_once "./clases/listar-directorios.php";
    require_once "./clases/crear-directorio.php";

    $dirArray = [];
    if(isset($_POST['cargar'])){
        if($_POST['ruta'] == null || $_POST['ruta'] == ''){
            $directorios = new ListarDirectorios();
            $dirArray = $directorios->listar_devolver('.');
        }else if($_POST['ruta'] != null || $_POST['ruta'] != ''){
            $directorios = new ListarDirectorios();
            $dirArray = $directorios->listar_devolver($_POST['ruta']);
        }else{
            header('Location: index.php?nullPath=1');
        }
    }

    if(isset($_POST['crear'])){
        $carpeta = $_POST['directorio-padre'].'/'.$_POST['nombre-directorio'];
        $newDir = new CrearDirectorio($carpeta);
        $newDir->crear();
        if(is_dir($carpeta)){
            header('Location: index.php?dirCreated=1');
        }else{
            header('Location: index.php?dirCreated=0');
        }
    }

    if(isset($_POST['subir'])){
        //Obtenemos información del archivo
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        echo $fileTmpPath;
        echo $fileName;
        echo $fileSize;
        echo $fileType;
        echo $fileExtension;

        //Le damos un nombre nuevo al archivo
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        //Subimos el archivo a su carpeta correspondiente
        $uploadFileDir = $_POST['directorio-carpeta'] . '/';
        $dest_path = $uploadFileDir . $newFileName;
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'webp', 'jpeg', 'JPG','GIF','PNG', 'WEBP','JPEG');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            if(move_uploaded_file($fileTmpPath, $dest_path)){
                header('Location: index.php?uploadFile=1');
            }else{
                header('Location: index.php?uploadFile=2');
            }
        }
    }
?>
<html>
    <head>
        <!-- Estilos -->
        <link rel='stylesheet' href='./css/style.css'>
        <!--Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <!-- Fontawesome icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="content">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method='POST' enctype="multipart/form-data">
                <div class="elemento">
                    <label for="ruta">Ruta</label>
                    <input type="text" name='ruta' id='ruta'>
                </div>
                <div class="elemento">
                    <label for="directorios">Directorios</label>
                    <select name="directorio-carpeta" id="directorios">
                        <option value="./">./</option>
                        <?php
                            for($a = 0; $a < COUNT($dirArray) ; $a++){
                                echo "<option value='".$dirArray[$a]."'>".$dirArray[$a]."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="elemento">
                    <label for="imagen" class='h64'>
                        <i class="fa-solid fa-image"></i>
                    </label>
                    <input class='hidde' type="file" name="uploadedFile" id='imagen' />
                </div>
                <div class="elemento mg-top display-flex-row">
                    <button id='nuevo'>Nuevo</button>
                    <button class='mg-left' name='cargar' id='cargar'>Cargar</button>
                    <button class='mg-left' name='subir' type='submit' id='subir'>Subir</button>
                </div>
            </form>
        </div>
        <div class="nueva-carpeta hidde" id='nueva-carpeta'>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method='POST'>
                <div class="elemento">
                    <label for="">Directorio padre</label>
                    <select name="directorio-padre" id="directorio-padre">
                        <option value="./">./</option>
                        <?php
                            for($a = 0; $a < COUNT($dirArray) ; $a++){
                                echo "<option value='".$dirArray[$a]."'>".$dirArray[$a]."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="elemento">
                    <label for="">Nombre</label>
                    <input type="text" name='nombre-directorio'>
                </div>
                <div class="elemento mg-top display-flex-row">
                    <button name='volver'>Volver</button>
                    <button class='mg-left' name='crear' id='crear'>Crear</button>
                </div>
            </form>
        </div>
        <div class="popup hidde" id='popup'>
            <div class="info">
                <span class='icono' id='icono'>

                </span>
                <span class='txt' id='info'></span>
            </div>
        </div>
    </body>
    <script src='./js/javascript.js'></script>
</html>