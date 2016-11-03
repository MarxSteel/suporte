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



// DECLARANDO CONEXÃO MYSQLI
	$conn = new mysqli($host, $user, $pass, $banco);
	//Checando a Conexão
	if ($conn->connect_error) 
	{
    	die("Erro de Conexão: " . $conn->connect_error);
	} 



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
