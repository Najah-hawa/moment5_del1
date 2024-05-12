<?php
//include('../inc/dbcon.php');

class Cource {
    private $conn;
    public $Kurskod;
    public $Kursnamn;
    public $Progression;
    public $Kursplan;
    
    
    //construktor
    function __construct(){
    //connect to db 
    $this -> conn =new mysqli("localhost", "root", "","phptutorial");
    
    if($this -> conn->connect_errno > 0){
        die('Fel vid anslutning försök igen [' . $conn->connect_error . ']');
    }
    }

  
function getCustomerList() {
    //för att använda connection i funktionen 
//global $conn;

$query = "SELECT * FROM  customers ;";
$query_run = mysqli_query ($this->conn, $query);

//$query ="SELECT * FROM customers";
//$query_run = mysqli_query($conn, $query);

if($query_run){
//check if the query exicts
if(mysqli_num_rows($query_run) > 0){
$respons = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

$data = [
    'status' => 200, // Internal Server Error
    'message' => 'Kursen tillagd',
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






}

?>