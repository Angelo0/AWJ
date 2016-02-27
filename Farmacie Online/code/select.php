<!DOCTYPE html>
<html ng-app="blog">
<head>
  <title>Select</title>
  <link rel="stylesheet" media="all" href="css/bootstrap.min.css">
  <link rel="stylesheet" media="all" href="css/custom.css">
</head>
<body>
<div class="container">
<table class = "table table-bordered">
				<!--Interogarea numarul 1 -->
	<tr>
		<center><font size = '6'>1.Afisati medicamentul si efectul sau secundar</font></center>
	</tr>
	<tr>
	<th>Denumire</th>
	<th>Producator</th>
	<th>Administrare</th>
	<th>Stoc</th>
	<th>Pret</th>
	<th>Efect</th>
	</tr>
<?php 
$conn = new mysqli('localhost', 'root', 'andrei123', 'Farmacie');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}

echo "<tr>";
$sql = "SELECT A.Denumire, A.Producator, A.Mod_administrare, A.Stoc, A.Pret , B.Efect 
FROM `Medicament` A INNER JOIN `Efec_secundar` B 
ON (A.id_efect=B.id_efect)";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Denumire']."</td>";
	echo "<td>" . $row['Producator']."</td>";
	echo "<td>" . $row['Mod_administrare']."</td>";
	echo "<td>" . $row['Stoc']."</td>";
	echo "<td>" . $row['Pret']."</td>";
	echo "<td>" . $row['Efect']."</td>";
	echo "</tr>";
}
	echo "</tr>";
	echo "</table>";
	echo "</div>";

?>
<!--Interogarea numarul 2 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<center><font size = '6'>2.Afisati numele,prenumele clientului si plata sa din factura</font></center>
	</tr>
<tr>
	<th>Nume</th>
	<th>Prenume</th>
	<th>Plata</th>

	</tr>
<?php 

echo "<tr>";
$sql = "SELECT A.Nume, A.Prenume, B.Plata 
FROM `Client` A INNER JOIN `Factura` B 
ON (A.id_client = B.id_client)";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Nume']."</td>";
	echo "<td>" . $row['Prenume']."</td>";
	echo "<td>" . $row['Plata']."</td>";
	echo "</tr>";
}
echo "</tr>";

?>
</table>
</div>

<!--Interogarea numarul 3 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<center><font size = '6'>3.Afisati clientii ce au reteta eliberata in 2016 </font></center>
	</tr>
<tr>
	<th>Nume</th>
	<th>Prenume</th>
	<th>Sex</th>
	<th>Varsta</th>
	<th>Greutate</th>
	<th>Data Eliberarii</th>
	
	</tr>
<?php 

echo "<tr>";
$sql = "SELECT A.Nume, A.Prenume,A.Sex,A.varsta, A.Greutate, B.data_eliberarii 
FROM `Client` A INNER JOIN `Reteta` B 
ON (A.id_client = B.id_client) 
WHERE B.data_eliberarii > '2016-1-1'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Nume']."</td>";
	echo "<td>" . $row['Prenume']."</td>";
	echo "<td>" . $row['varsta']."</td>";
	echo "<td>" . $row['Sex']."</td>";
	echo "<td>" . $row['Greutate']."</td>";
	echo "<td>" . $row['data_eliberarii']."</td>";
	echo "</tr>";
}
echo "</tr>";
?>
</table>
</div>

<!--Interogarea numarul 4 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<center><font size = '6'>4.Afisati numele, prenumele clientului si diagnosticul </font></center>
	</tr>
<tr>
	<th>Nume</th>
	<th>Prenume</th>
	<th>Diagnostic</th>

	</tr>
<?php 

echo "<tr>";
$sql = "SELECT A.Nume, A.Prenume, B.diagnostic 
FROM `Client` A INNER JOIN `Reteta` B 
ON (A.id_client = B.id_client);
";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Nume']."</td>";
	echo "<td>" . $row['Prenume']."</td>";
	echo "<td>" . $row['diagnostic']."</td>";
	echo "</tr>";
}
echo "</tr>";

?>
</table>
</div>

<!--Interogarea numarul 5 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<center><font size = '6'>5.Afisati numele medicamentului si numele efectului secundar ce incepe cu 'a' </font></center>
	</tr>
<tr>
	<th>Denumire</th>
	<th>Efect</th>

	</tr>
<?php 

echo "<tr>";
$sql = "SELECT A.Denumire, B.Efect 
FROM `Medicament` A INNER JOIN `Efec_secundar` B 
ON(A.id_efect = B.id_efect) WHERE Efect LIKE 'a%'";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Denumire']."</td>";
	echo "<td>" . $row['Efect']."</td>";
	echo "</tr>";
}
echo "</tr>";

?>
</table>
</div>

<!--Interogarea numarul 6 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<center><font size = '6'>6.Afisati Clientii ce au de plata mai mult de 40 de lei</font></center>
	</tr>
<tr>
	<th>Nume</th>
	<th>Prenume</th>
	<th>Plata</th>

	</tr>
<?php 

echo "<tr>";
$sql = "SELECT A.Nume, A.Prenume, B.Plata 
FROM `Client` A INNER JOIN `Factura` B 
ON (A.id_client = B.id_client) WHERE B.plata > 40";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Nume']."</td>";
	echo "<td>" . $row['Prenume']."</td>";
	echo "<td>" . $row['Plata']."</td>";
	echo "</tr>";
}
echo "</tr>";

?>
</table>
</div>



<!--Interogarea numarul 7 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<div>
		<form name="ins" method="POST" action="select.php">
		<center>
		<p><b> 7.Afisati medicamentele pentru fiecare reteta si diagnosticul acesteia pentru medicamente care incep cu litera: </b></p>
		<input type="text" name="afis8" >
		<input name="afisare7" type="submit" value="Afisati"></center>
		</form>
	</tr>
<tr>
	<th>Diagnostic</th>
	<th>Denumire</th>
	</tr>
<?php
if (isset($_POST['afisare7'])) {
	$n = $_POST['afis8'];
echo "<tr>";
$sql = "SELECT A.diagnostic, C.Denumire  
FROM `Reteta` A INNER JOIN `Medicament/Reteta` B 
ON(A.id_reteta = B.id_reteta) INNER JOIN `Medicament` C 
ON (B.id_med = C.id_med) WHERE C.Denumire =(
	SELECT Denumire FROM `Medicament` 
	WHERE id_med = C.id_med AND Denumire LIKE '$n%')
";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['diagnostic']."</td>";
	echo "<td>" . $row['Denumire']."</td>";
	echo "</tr>";
}}
echo "</tr>";
?>

</table>
</div>

<!--Interogarea numarul 8 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<div>
		<form name="ins" method="POST" action="select.php">
		<center>
		<p><b> 8. Afisati numele, prenumele clientilor, data de eliberare a retetei si data facturarii unde data facturarii este dupa: </b></p>
		<input type="text" name="afis8" >
		<input name="afisare8" type="submit" value="Afisati"></center>
		</form>
	</tr>
<tr>
	<th>Nume</th>
	<th>Prenume</th>
	<th>Data eliberarii retetei</th>
	<th>Data facturarii</th>
	</tr>
<?php
if (isset($_POST['afisare8'])) {
	$n = $_POST['afis8'];
echo "<tr>";
$sql = "SELECT A.Nume, A.Prenume, B.data_eliberarii, C.data 
FROM `Client` A INNER JOIN `Reteta` B 
ON (A.id_client = B.id_client) INNER JOIN `Factura` C 
ON (B.id_client = C.id_client) WHERE C.data = (
	SELECT data FROM `Factura` 
	WHERE id_client = C.id_client AND data > '$n') 
";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Nume']."</td>";
	echo "<td>" . $row['Prenume']."</td>";
	echo "<td>" . $row['data_eliberarii']."</td>";
	echo "<td>" . $row['data']."</td>";
	echo "</tr>";
}}
echo "</tr>";
?>

</table>
</div>

<!--Interogarea numarul 9 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<div>
		<form name="ins" method="POST" action="select.php">
		<center>
		<p><b> 9.Sa se afiseze numele clientului si efectul secundar al medicamentelor din reteta acestuia, numele efectului incepand cu litera:   </b></p>
		<input type="text" name="afis9" >
		<input name="afisare9" type="submit" value="Afisati"></center>
		</form>
	</tr>
<tr>
	<th>Nume</th>
	<th>Prenume</th>
	<th>Efect secundar</th>
	
	</tr>
<?php
if (isset($_POST['afisare9'])) {
	$n = $_POST['afis9'];
echo "<tr>";
$sql = "SELECT A.Nume, A.Prenume, E.Efect 
FROM `Client` A INNER JOIN `Reteta` B 
ON (A.id_client = B.id_client) INNER JOIN `Medicament/Reteta` C 
ON ( B.id_reteta = C.id_reteta) INNER JOIN `Medicament` D 
ON (C.id_med = D.id_med) INNER JOIN `Efec_secundar` E 
ON (D.id_efect = E.id_efect) 
WHERE E.Efect = ( 
	SELECT Efect FROM `Efec_secundar` 
	WHERE id_efect = E.id_efect AND Efect LIKE '$n%')
";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['Nume']."</td>";
	echo "<td>" . $row['Prenume']."</td>";
	echo "<td>" . $row['Efect']."</td>";
	echo "</tr>";
}}
echo "</tr>";
?>

</table>
</div>

<!--Interogarea numarul 10 -->
<div class="container">
<table class = "table table-bordered">
<tr>
		<td>
		<div>
		<form name="ins" method="POST" action="select.php">
		<center>
		<p><b> 10.Afiseaza retetele cu medicamentele ce au pretul intre  </b></p>
		<input type="text" name="afis10" >
		</form>
		<text> SI <text>
		<input type="text" name="afis11" >
		<input name="afisare10" type="submit" value="Afisati">
		</form></td></div>
	</tr>
<tr>
	<th>ID reteta</th>
	<th>Denumire medicament</th>
	<th>Pret</th>
	
	</tr>
<?php
if (isset($_POST['afisare10'])) {
	$s = $_POST['afis10'];
	$d = $_POST['afis11'];
echo "<tr>";
$sql = "SELECT A.id_reteta , M.Denumire, M.Pret 
FROM `Reteta` A INNER JOIN(
	SELECT B.id_reteta, C.Denumire, C.Pret 
	FROM `Medicament/Reteta` B INNER JOIN `Medicament` C 
	ON (B.id_med = C.id_med) 
	WHERE C.Pret BETWEEN '$s' AND '$d') AS M 
ON A.id_reteta = M.id_reteta
ORDER BY A.id_reteta
";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['id_reteta']."</td>";
	echo "<td>" . $row['Denumire']."</td>";
	echo "<td>" . $row['Pret']."</td>";
	echo "</tr>";
}}
echo "</tr>";
?>

</table>
</div>




</body>
</html>
