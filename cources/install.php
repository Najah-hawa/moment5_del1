<?php

/* DB-anslutning */
$conn = mysqli_connect("localhost", "root", "","My_cources") or die('Fel vid anslutning');
//$conn = mysqli_connect('studentmysql.miun.se', 'naha2204', '6337PJNrZr', 'naha2204') or die('Fel vid anslutning');
/* SQL-fråga för att skapa tabell */
$sql = "DROP TABLE IF EXISTS  Cources;";

/* SQL-fråga för att skapa tabell */

$sql.=  "CREATE TABLE Cources(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Kurskod  VARCHAR(64) NOT NULL,
    Kursnamn  text,
    Progression  VARCHAR(10) NOT NULL,
    Kursplan  VARCHAR(64) NOT NULL
);";
/* SQL-fråga för att lägga in data */

$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT057G','webbutveckling 1', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT057G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT048G','Introduktion till programmering i JavaScript', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT084G/');";

echo "<pre>$sql</pre>"; // Skriv ut SQL-frågan till skärm

/* Skicka SQL-frågan till onn  */
if($conn ->multi_query($sql)) {
    echo "Tabell installerad.";
} else {
    echo "Fel vid installation av Tabell.";
}

?>