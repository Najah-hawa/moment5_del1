<?php

include('Cource.class.php');
//headeras med inställningar för rest webbtjänsten

header('Access-Control-Allow-Origin: *');

header('Content-Type_ application/json');

header('Access-Controll-Allow-Methods: GET, PUT, POST, DELETE');

header('Access-Controll-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Reguested-With');

$requestMethod = $_SERVER['REQUEST_METHOD'];

//skapa instans av klassen 
$cource = new Cource();

switch($requestMethod) {

        case 'GET': 

    if(isset($_GET['id'])){            //läsa om id har skickats eller inte 
        $cource = $cource-> getCource($_GET);
        echo $cource;
      }else {
   $customerList =  $cource-> getCourceList();
echo $customerList;
     };



break;

case 'POST': 
 
    //konvertera inmatad data till json format
     $inputData = json_decode(file_get_contents("php://input"), true);
   
     if(empty($inputData)){
   
       $createCource = $cource->createCource($_POST);
   
     }else {
       $createCource = $cource->createCource($inputData);
     }
   
   echo $createCource;
   
     
   break;  
   case 'PUT': 
      //konvertera inmatad data till json format
       $inputData = json_decode(file_get_contents("php://input"), true);
       $updateCource = $cource->updateCource($inputData, $_GET);   
       
     echo $updateCource;
    
    break; 

    case 'DELETE': 
  
        $deleteCource = $cource-> deleteCource($_GET);
        echo $deleteCource;
      
      break; 

          

 }





?> 