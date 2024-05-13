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
    $this -> conn =new mysqli("localhost", "root", "","My_cources");
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
    $respons = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
    
    $data = [
        'status' => 200, // ok
        'message' => 'ok',
        'data' => $respons 
    
    ];
    header("HTTP/1.0 200 OK");
    return json_encode($data);  
    
    }else {
        $data = [
            'status' => 404, // Internal Server Error
            'message' =>  'Det finns inga kurser att visa',
        ];
        header("HTTP/1.0 405 No Cource Found");
        return json_encode($data);  
    }
    } 
    else
    {
        $data = [
            'status' => 500, // Internal Server Error
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 405 Internal Server Error");
        echo json_encode($data);
    }  
    }
    



//skapa en funktion för att lägg till kurs
function createCource($courceInput){

    $Kurskod = mysqli_real_escape_string($this->conn,$courceInput['Kurskod']);
    $Kursnamn = mysqli_real_escape_string($this->conn,$courceInput['Kursnamn']);
    $Progression = mysqli_real_escape_string($this->conn,$courceInput['Progression']);
    $Kursplan = mysqli_real_escape_string($this->conn,$courceInput['Kursplan']);

    if(empty(trim($Kurskod))){

        echo $data = [
            'status' => 422, 
            'message' => 'Du måste kurskod',
        ];
        header("HTTP/1.0 200 Ok");
        echo json_encode($data); 
         exit();

    }elseif(empty(trim($Kursnamn))){
        echo $data = [
            'status' => 422, 
            'message' => 'Du måste ange kursnamn',
        ];
        echo json_encode($data); 
         exit();

    }elseif(empty(trim($Progression))){

        echo $data = [
            'status' => 422, 
            'message' => 'Du måste ange Progression',
        ];
        echo json_encode($data); 
         exit();

    }elseif(empty(trim($Kursplan))){
         echo $data = [
            'status' => 422, 
            'message' => 'Du måste ange kursplan',
        ];
        echo json_encode($data); 
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
    $data = [
        'status' => 422, 
        'message' => 'Du måste ange ett id',
    ];
    header("HTTP/1.0 200 Ok");
    echo json_encode($data); 
     exit();
}
$courceId = mysqli_real_escape_string($this->conn, $courceParams['id']);

$query = "SELECT * FROM  Cources WHERE id= '$courceId' LIMIT 1";

$result = mysqli_query($this->conn, $query);

if($result){
if(mysqli_num_rows($result) ==1){
$res= mysqli_fetch_assoc($result);

$data = [
    'status' => 200, // return kurs för id som skickades
    'message' => 'Custumer Fetched Successfully',
    'data' => $res
];
header("HTTP/1.0 200 Ok");
echo json_encode($data); 

}else {
    $data = [
        'status' => 404, // om id finns inte i databasen
        'message' => 'ingen kurs med denna id hittades',
    ];
    header("HTTP/1.0 404 Not Found");
    echo json_encode($data); 
}
} else {

    $data = [
        'status' => 500, // Internal Server Error
        'message' => 'Internal Server Error',
    ];
    header("HTTP/1.0 500 Internal Server Error");
    echo json_encode($data); 
}


}



//radera en kurs med id 

function deleteCource($courceParams) {
  
    if(!isset($courceParams ['id'])){

        $data = [
            'status' => 422, // Internal Server Error
            'message' => 'Kurs id hittades inte i URL',
        ];
        header("HTTP/1.0 422");
        echo json_encode($data); 
        exit();

      }elseif($courceParams['id'] ==null){
      // om ingen id har skciats i url
        $data = [
            'status' => 422, // Internal Server Error
            'message' => 'skrev kurs id som du vill uppdatera',
        ];
        header("HTTP/1.0 422");
        echo json_encode($data); 
        exit();
      } 
    
        $courceId = mysqli_real_escape_string($this->conn, $courceParams['id']);

        $query = "DELETE FROM Cources WHERE id='$courceId' LIMIT 1";

        $result = mysqli_query($this->conn, $query);

        if($result){
            $data = [
                'status' => 201, // 
                'message' => 'Kurs raderades',
            ];
            header("HTTP/1.0 201 Success");
            echo json_encode($data); 
        
        }else {
            $data = [
                'status' => 404, // 
                'message' => 'Not Found',
            ];
            header("HTTP/1.0 404 Not Found");
            echo json_encode($data); 
        
        }
    }




//uppdatera en kurs

function updateCource($courceInput,$courceParams){
// kontrollera om id skicades 
  if(!isset($courceParams['id'])){

    $data = [
        'status' => 422, // Internal Server Error
        'message' => 'Kurs id hittades inte i URL',
    ];
    header("HTTP/1.0 422");
    echo json_encode($data); 
    exit();

  }elseif($courceParams['id'] ==null){
  // om ingen id har skciats i url
    $data = [
        'status' => 422, // Internal Server Error
        'message' => 'skrev kurs id som du vill uppdatera',
    ];
    header("HTTP/1.0 422");
    echo json_encode($data); 
    exit();
  } 

    $courceId = mysqli_real_escape_string($this->conn,$courceParams['id']);
    $Kurskod = mysqli_real_escape_string($this->conn,$courceInput['Kurskod']);
    $Kursnamn = mysqli_real_escape_string($this->conn,$courceInput['Kursnamn']);
    $Progression = mysqli_real_escape_string($this->conn,$courceInput['Progression']);
    $Kursplan = mysqli_real_escape_string($this->conn,$courceInput['Kursplan']);

    if(empty(trim($Kurskod))){

        echo $data = [
            'status' => 422, 
            'message' => 'Du måste ange kurskod',
        ];
        header("HTTP/1.0 422");
        echo json_encode($data); 
         exit();

    }elseif(empty(trim($Kursnamn))){
        echo $data = [
            'status' => 422, 
            'message' => 'Du måste ange kursnamn',
        ];
        header("HTTP/1.0 422");
        echo json_encode($data); 
         exit();

    }elseif(empty(trim($Progression))){

        echo $data = [
            'status' => 422, 
            'message' => 'Du måste ange Progression',
        ];
        header("HTTP/1.0 422");
        echo json_encode($data); 
         exit();

    }elseif(empty(trim($Kursplan))){
         echo $data = [
            'status' => 422, 
            'message' => 'Du måste ange kursplan',
        ];
        header("HTTP/1.0 422");
        echo json_encode($data); 
         exit();
    } else {
$query = "UPDATE Cources SET Kurskod = '$Kurskod', Kursnamn = '$Kursnamn', Progression ='$Progression', Kursplan ='$Kursplan' WHERE id = '$courceId' LIMIT 1";

$result = mysqli_query($this->conn, $query);

if($result){
    
    $data = [
        'status' => 201, // kurs uppdaterades
        'message' => 'Kurs uppdaterad',
    ];
    header("HTTP/1.0 201 Success");
    echo json_encode($data); 

}else{

    $data = [
        'status' => 500, // 
        'message' => 'internal server error',
    ];
    header("HTTP/1.0 500 internal server error");
    echo json_encode($data); 
    
}
 }
}
}