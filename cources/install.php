<?php

/* DB-anslutning */
//$conn = mysqli_connect("localhost","root","","My_cources") or die('Fel vid anslutning');
$conn = mysqli_connect('studentmysql.miun.se', 'naha2204', '6337PJNrZr', 'naha2204') or die('Fel vid anslutning');
/* SQL-fråga för att skapa tabell */
$sql = "DROP TABLE IF EXISTS  Cources;";

/* SQL-fråga för att skapa tabell */

$sql.=  "CREATE TABLE Cources(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Kurskod  VARCHAR(64) NOT NULL,
    Kursnamn  text,
    Progression  VARCHAR(10) NOT NULL,
    Kursplan  VARCHAR(200) NOT NULL
);";
/* SQL-fråga för att lägga in data */

$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT057G','webbutveckling 1', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT057G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT048G','Introduktion till programmering i JavaScript', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT084G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT200G','Grafisk teknik för webb', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT200G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT093G','Webbutveckling II', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT093G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT173G','Webbutveckling III', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT173G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('IK060G','Projektledning', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/IK060G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT162G','Javascriptbaserad webbutveckling', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT162G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT071G','Programmering i C#.NET', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT071G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT068G','Webbanvändbarhet', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT068G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('IG021G','Affärsplaner och kommersialisering', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/IG021G/');";
$sql .= "INSERT INTO Cources (Kurskod, Kursnamn, Progression, Kursplan) VALUES
('DT003G','Databaser', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/DT003G/');";
/* Skicka SQL-frågan till onn  */
if($conn ->multi_query($sql)) {
    echo "Tabell installerad.";
} else {
    echo "Fel vid installation av Tabell.";
}

?>