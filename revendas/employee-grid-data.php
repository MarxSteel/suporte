<?php
/* Database connection start */
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "henrySuporte";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'EMPRESA_ID', 
	1 => 'RAZAO_SOCIAL',
	2=> 'CIDADE',
	3=> 'DDD1',
	4=> 'TELEFONE1',
	5=> 'EMAIL'
);

// getting total number records without any search
$sql = "SELECT EMPRESA_ID, RAZAO_SOCIAL, CIDADE, DDD1, TELEFONE1, EMAIL";
$sql.=" FROM cad_empresa";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT EMPRESA_ID, RAZAO_SOCIAL, CIDADE, DDD1, TELEFONE1, EMAIL ";
$sql.=" FROM cad_empresa WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( EMPRESA_ID LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR RAZAO_SOCIAL LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR CIDADE LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["EMPRESA_ID"];
	$nestedData[] = $row["RAZAO_SOCIAL"];
	$nestedData[] = $row["CIDADE"];
	$nestedData[] = $row["DDD1"] . " - " . $row["TELEFONE1"];
	$nestedData[] = $row["EMAIL"];





	$data[] = $nestedData;
}


$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>