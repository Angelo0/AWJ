<?php
//retinem in variabile datele pentru update

$denumire = $_POST['denumire'];
$producator = $_POST['producator'];
$administrare = $_POST['administrare'];
$stoc = $_POST['stoc'];
$pret = $_POST['pret'];


 
 // conecteaza la baza de date "Farmacie" 
$conn = new mysqli('localhost', 'root', 'andrei123', 'Farmacie');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}

// interogare sql Insert
$sql = "INSERT INTO `Medicament`(`Denumire`, `Producator`, `Mod_administrare`, `Stoc`, `Pret`) VALUES ('$denumire','$producator','$administrare','$stoc','$pret')";

// executa interogarea si verifica pentru erori
if (!$conn->query($sql)) {
  echo 'Error: '. $conn->error;
}
 echo include 'home.php';

$conn->close();


?>