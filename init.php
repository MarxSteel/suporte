<?php

// constantes com as credenciais de acesso ao banco MySQL
$host = "localhost:8889";
$user = "root";
$pass = "root";
$banco = "henrySuporte";
$versao = "3.3.5";
define('DB_HOST', $host);
define('DB_USER', $user);
define('DB_PASS', $pass);
define('DB_NAME', $banco);





date_default_timezone_set('America/Sao_Paulo'); //DEFININDO O TIMEZONE PARA TODAS AS PÁGINAS


$conn = mysqli_connect($host, $user, $pass, $banco) or die("Connection failed: " . mysqli_connect_error());

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}



//FUNÇÃO PORCENTAGEM_NNX
function porcentagem_nnx ($parcial, $porcentagem ) {
 return ($parcial / $porcentagem) * 100;
}


// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);



$cor = "skin-blue";
$Titulo = "Henry Controle de Estoque";


require_once 'functions.php';

function TiraCaractere($string) {

    // matriz de entrada
    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

    // matriz de saída
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

    // devolver a string
    return str_replace($what, $by, $string);
}
