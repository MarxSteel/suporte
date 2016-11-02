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


//DEFININDO BANCO 2

$Host2 = "192.168.1.1:3306";
$User2 = "marquistei";
$Senha2 = "qaz654wsx";
$Banco2 = "erp_henry";
define('DB_HOST2', $Host2);
define('DB_USER2', $User2);
define('DB_PASS2', $Senha2);
define('DB_NAME2', $Banco2);

date_default_timezone_set('America/Sao_Paulo'); //DEFININDO O TIMEZONE PARA TODAS AS PÁGINAS


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
