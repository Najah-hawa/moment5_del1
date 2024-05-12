<?php

include('Cource.class.php');
//headeras med inställningar för rest webbtjänsten

header('Access-Control-Allow-Origin: *');

header('Content-Type_ application/json');

header('Access-Controll-Allow-Methods: GET, PUT, POST, DELETE');

header('Access-Controll-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Reguested-With');

$requestMethod = $_SERVER['REQUEST_METHOD'];


$cource = new Cource();

 
if($requestMethod == "GET") {
 
$customerList =  $cource-> getCustomerList();
echo $customerList;

}else{
$data = [
    'status' => 405, // method not allowed
    'message' => $requestMethod. 'method not allowed',

];
header("HTTP/1.0 405 Method Not Allowed");
echo jaon_encode($data);
}


?> 