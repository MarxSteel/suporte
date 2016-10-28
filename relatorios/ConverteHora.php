<?php

$Data = $_GET['dtInicio'];




$DFm = explode("/",$Data);
echo $DFm[2].'-'.$DFm[1].'-'.$DFm[0];


?>