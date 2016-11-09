
<?php
	//include connection file 


$host2 = "localhost";
$user2 = "marquistei";
$pass2 = "qaz654wsx";
$banco2 = "erp_henry";
$versao = "3.3.5";
// DECLARANDO CONEXÃO MYSQLI
$connecta = mysqli_connect($host2, $user2, $pass2, $banco2) or die("Connection failed: " . mysqli_connect_error());

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}




	// initilize all variable
	$params =  $totalRecords = $data = array();

	$sqlTot = $sqlRec = $where = "";
	
	
	$params = $_REQUEST;
	$limit = $params["rowCount"];

	if (isset($params["current"])) { $page  = $params["current"]; } else { $page=1; };  
    $start_from = ($page-1) * $limit;
	// check search value exist
	if( !empty($params['searchPhrase']) ) {   
		$where .=" WHERE ";
		$where .=" ( EMPRESA_ID LIKE '".$params['searchPhrase']."%' ";    
		$where .=" OR RAZAO_SOCIAL LIKE '".$params['searchPhrase']."%' )";
	}
	
	// getting total number records without any search
	$sql = "SELECT * FROM `cad_empresa` ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;

	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}
	if ($limit!=-1)
	$sqlRec .= "LIMIT $start_from, $limit";
		
	$queryTot = mysqli_query($connecta, $sqlTot) or die("database error:". mysqli_error($connecta));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($connecta, $sqlRec) or die("error to fetch employees data");

	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_assoc($queryRecords) ) { 
		$data[] = $row;
		//echo "<pre>";print_R($data);die;
	}	

	$json_data = array(
			"current"            => intval( $params['current'] ), 
			"rowCount"            => 10, 			
			"total"    => intval( $totalRecords ),
			"rows"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>
	