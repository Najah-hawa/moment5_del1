<?php
include('../inc/dbcon.php');
/* connection -anslutning */
$conn = mysqli_connect($host, $username, $password, $dbname );

/* SQL-fråga för att skapa tabell */
$sql = "DROP TABLE IF EXISTS  customers;";

/* SQL-fråga för att skapa tabell */

$sql.=  "CREATE TABLE customers(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Kurskod  VARCHAR(64) NOT NULL,
    Kursnamn  text,
    Progression  VARCHAR(10) NOT NULL,
    Kursplan  VARCHAR(64) NOT NULL
);";
/* SQL-fråga för att lägga in data */

$sql .= "INSERT INTO customers (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT057G','webbutveckling 1', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT057G/');";
$sql .= "INSERT INTO customers (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT048G','Introduktion till programmering i JavaScript', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT084G/');";

echo "<pre>$sql</pre>"; // Skriv ut SQL-frågan till skärm

/* Skicka SQL-frågan till onn  */
if($conn ->multi_query($sql)) {
    echo "Tabell installerad.";
} else {
    echo "Fel vid installation av Tabell.";
}

?>