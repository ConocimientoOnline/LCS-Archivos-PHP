//Función para obtener parámetros GET de la URL

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

//Variables GET

var dirCreated = getParameterByName('dirCreated');
var dirExist = getParameterByName('dirExist');
var errorDirExist = getParameterByName('errorDirExist');
var errorDir = getParameterByName('errorDir');
var uploadFile = getParameterByName('uploadFile');

if(dirCreated == 1){
    document.getElementById('popup').classList.remove('hidde');
    document.getElementById('info').innerHTML = "Carpeta generada correctamente";
    document.getElementById('icono').innerHTML = '<i class="fa-solid fa-folder"></i>';
    setTimeout(function(){
        document.getElementById('popup').classList.add('hidde');
        document.getElementById('info').innerHTML = "";
    },3000);
}
if(dirExist == 1){
    document.getElementById('popup').classList.remove('hidde');
    document.getElementById('info').innerHTML = "la carpeta existe";
    document.getElementById('icono').innerHTML = '<i class="fa-solid fa-folder"></i>';
    setTimeout(function(){
        document.getElementById('popup').classList.add('hidde');
        document.getElementById('info').innerHTML = "";
    },3000);
}else if(dirExist == 2){
    document.getElementById('popup').classList.remove('hidde');
    document.getElementById('info').innerHTML = "La carpeta no existe";
    document.getElementById('icono').innerHTML = '<i class="fa-solid fa-folder"></i>';
    setTimeout(function(){
        document.getElementById('popup').classList.add('hidde');
        document.getElementById('info').innerHTML = "";
    },3000);
}
if(errorDirExist == 1){
    document.getElementById('popup').classList.remove('hidde');
    document.getElementById('info').innerHTML = "La carpeta no existe";
    document.getElementById('icono').innerHTML = '<i class="fa-solid fa-folder"></i>';
    setTimeout(function(){
        document.getElementById('popup').classList.add('hidde');
        document.getElementById('info').innerHTML = "";
    },3000);
}
if(errorDir == 1){
    document.getElementById('popup').classList.remove('hidde');
    document.getElementById('info').innerHTML = "Error al listar directorio";
    document.getElementById('icono').innerHTML = '<i class="fa-solid fa-folder"></i>';
    setTimeout(function(){
        document.getElementById('popup').classList.add('hidde');
        document.getElementById('info').innerHTML = "";
    },3000);
}
if(uploadFile == 1){
    document.getElementById('popup').classList.remove('hidde');
    document.getElementById('info').innerHTML = "Archivo subido correctamente";
    document.getElementById('icono').innerHTML = '<i class="fa-solid fa-file"></i>';
    setTimeout(function(){
        document.getElementById('popup').classList.add('hidde');
        document.getElementById('info').innerHTML = "";
    },3000);
}else if(uploadFile == 2){
    document.getElementById('popup').classList.remove('hidde');
    document.getElementById('info').innerHTML = "Archivo no subido";
    document.getElementById('icono').innerHTML = '<i class="fa-solid fa-file"></i>';
    setTimeout(function(){
        document.getElementById('popup').classList.add('hidde');
        document.getElementById('info').innerHTML = "";
    },3000);
}

//Mostramos la pantalla Crear directorio

document.getElementById('nuevo').addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('nueva-carpeta').classList.remove('hidde');
});

//Ocultar pantalla Crear directorio

document.getElementById('volver').addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('nueva-carpeta').classList.add('hidde');
});

//Crear carpeta

document.getElementById('crear').addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('nueva-carpeta').classList.add('hidde');
});