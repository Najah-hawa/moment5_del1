<?php
//include('../inc/dbcon.php');
class Cource {
    private$conn;
    public $Kurskod;
    public $Kursnamn;
    public $Progression;
    public $Kursplan;
   
   
    //construktor
    function __construct(){
    //connect to stabasen 
      $this -> conn =new mysqli('studentmysql.miun.se', 'naha2204', '6337PJNrZr', 'naha2204');
    //$this -> conn =new mysqli("localhost", "root", "","My_cources");
    //$this -> conn =new mysqli('studentmysql.miun.se', 'naha2204', '6337PJNrZr', 'naha2204');
    
    if($this -> conn->connect_errno > 0){
        die('Fel vid anslutning försök igen [' . $conn->connect_error . ']');
    }
    }


    //läsa alla kurser i databasen
    function getCourceList() {
    
    $query = "SELECT * FROM  Cources ;";
    $query_run = mysqli_query ($this->conn, $query);
    
    
    if($query_run){
    //check if the query exicts
    if(mysqli_num_rows($query_run) > 0){
    $Respons = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
    //$response = array($Respons);
    http_response_code(200);   //pk
    return json_encode($Respons);
    
    }else {
        $response = array('message' =>  'Det finns inga kurser att visa',);
        http_response_code(404);   //Internal Server Error
        return json_encode($response);

    }
    } 
    else
    {
        $response = array('message' =>  'Internal Server Error',);
        http_response_code(500);   //Internal Server Error
        echo json_encode($response);
    }  
    }
    



//skapa en funktion för att lägg till kurs
function createCource($courceInput){

    $Kurskod = mysqli_real_escape_string($this->conn,$courceInput['Kurskod']);
    $Kursnamn = mysqli_real_escape_string($this->conn,$courceInput['Kursnamn']);
    $Progression = mysqli_real_escape_string($this->conn,$courceInput['Progression']);
    $Kursplan = mysqli_real_escape_string($this->conn,$courceInput['Kursplan']);

    if(empty(trim($Kurskod))){

        $response = array('message' =>  'Du måste ange kurskod',);
        http_response_code(422);   //Internal Server Error
        echo json_encode($response);
        exit();
       

    }elseif(empty(trim($Kursnamn))){
    
        $response = array('message' =>  'Du måste ange kursnamn',);
         http_response_code(422);   //Internal Server Error
         echo json_encode($response);
         exit();
        

    }elseif(empty(trim($Progression))){

        $response = array('message' =>  'Du måste ange Progression',);
         http_response_code(422);   //Internal Server Error
         echo json_encode($response);
         exit();
        

    }elseif(empty(trim($Kursplan))){
     
        $response = array('message' =>  'Du måste ange kursplan',);
         http_response_code(422);   //Internal Server Error
         echo json_encode($response);
         exit();
         
    } else {
$query = "INSERT INTO Cources (Kurskod,Kursnamn,Progression, Kursplan ) VALUES ('$Kurskod','$Kursnamn','$Progression', '$Kursplan')";

$result = mysqli_query($this->conn, $query);

if($result){
    $response = array("messsage" => 'created' );
    http_response_code(201);   //internal server error
    echo json_encode($response);

}else{

    $response = array("messsage" => 'internal server error' );
    http_response_code(500);   //internal server error
    echo json_encode($response);
}
 }
}


//läsa en kurs genom att skicka id via url eller genom formulär
function getCource($courceParams) { 
if($courceParams['id'] == null){
    //om ingen id skicades så ange fel meddelande
     $response = array('message' =>  'Du måste ange ett id',);
     http_response_code(422);   //Internal Server Error
     echo json_encode($response);
     exit();
}
$courceId = mysqli_real_escape_string($this->conn, $courceParams['id']);

$query = "SELECT * FROM  Cources WHERE id= '$courceId' LIMIT 1";

$result = mysqli_query($this->conn, $query);

if($result){
if(mysqli_num_rows($result) ==1){
$res= mysqli_fetch_assoc($result);

$response = $res;
http_response_code(200);   //Internal Server Error
echo json_encode($response);


}else {

$response = array( 'message' => 'ingen kurs med denna id hittades');
http_response_code(404);   //Internal Server Error
echo json_encode($response);
}
} else {
    $response = array( 'message' => 'Internal Server Error');
http_response_code(500);   //Internal Server Error
echo json_encode($response);
}


}



//radera en kurs med id 

function deleteCource($courceParams) {
  
    if(!isset($courceParams ['id'])){

        $response = array( 'message' => 'Kurs id hittades inte i URL');
        http_response_code(422);   //Internal Server Error
        echo json_encode($response);
        exit();
      }elseif($courceParams['id'] ==null){
      // om ingen id har skciats i url
        $response = array( 'message' => 'skrev kurs id som du vill uppdatera');
        http_response_code(422);   //Internal Server Error
        echo json_encode($response);
        exit();
      } 
    
        $courceId = mysqli_real_escape_string($this->conn, $courceParams['id']);

        $query = "DELETE FROM Cources WHERE id='$courceId' LIMIT 1";

        $result = mysqli_query($this->conn, $query);

        if($result){
            $response = array( 'message' => 'Kurs raderades');
            http_response_code(201);   //ok
            echo json_encode($response);
        }else {
           
            $response = array( 'message' => 'Not Found');
            http_response_code(404); 
            echo json_encode($response);
        }
    }




//uppdatera en kurs

function updateCource($courceInput,$courceParams){
// kontrollera om id skicades 
  if(!isset($courceParams['id'])){

    $response = array( 'message' => 'Kurs id hittades inte i URL');
    http_response_code(422); //Internal Server Error
    echo json_encode($response);
    exit();  


  }elseif($courceParams['id'] ==null){
  // om ingen id har skciats i url
    $response = array( 'message' => 'skrev kurs id som du vill uppdatera');
    http_response_code(422); //Internal Server Error
    echo json_encode($response);
    exit();  
  } 

    $courceId = mysqli_real_escape_string($this->conn,$courceParams['id']);
    $Kurskod = mysqli_real_escape_string($this->conn,$courceInput['Kurskod']);
    $Kursnamn = mysqli_real_escape_string($this->conn,$courceInput['Kursnamn']);
    $Progression = mysqli_real_escape_string($this->conn,$courceInput['Progression']);
    $Kursplan = mysqli_real_escape_string($this->conn,$courceInput['Kursplan']);

    if(empty(trim($Kurskod))){

    $response = array( 'message' => 'Du måste ange kurskod');
    http_response_code(422); //Internal Server Error
    echo json_encode($response);
    exit();  

         
    }elseif(empty(trim($Kursnamn))){
      
         $response = array( 'message' => 'Du måste ange kursnamn');
         http_response_code(422); //Internal Server Error
         echo json_encode($response);
         exit();  

    }elseif(empty(trim($Progression))){

         $response = array( 'message' => 'Du måste ange Progression');
         http_response_code(422); //Internal Server Error
         echo json_encode($response);
         exit(); 

    }elseif(empty(trim($Kursplan))){
    
         $response = array( 'message' => 'Du måste ange kursplan');
         http_response_code(422); //Internal Server Error
         echo json_encode($response);
         exit(); 
    } else {
$query = "UPDATE Cources SET Kurskod = '$Kurskod', Kursnamn = '$Kursnamn', Progression ='$Progression', Kursplan ='$Kursplan' WHERE id = '$courceId' LIMIT 1";

$result = mysqli_query($this->conn, $query);

if($result){
    
    $response = array( 'message' => 'Kurs uppdaterad');
         http_response_code(201); //kurs uppdaterades 
         echo json_encode($response);

}else{
    $response = array( 'message' => 'internal server error');
         http_response_code(500); //kurs uppdaterades 
         echo json_encode($response);
    
}
 }
}
}