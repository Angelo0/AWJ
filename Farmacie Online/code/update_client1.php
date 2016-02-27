<?php 
$conn = new mysqli('localhost', 'root', 'andrei123', 'Farmacie');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
$result = $conn->query($sql);

 $id = $_POST['id'];
  $sql = "SELECT * FROM `Client` WHERE id_client='$id'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>
<body>
<div class="container">
<table class = "table table-bordered">
<tr>
<form class="form-inline" action ="update_client2.php" method="POST">
<input type="hidden"  name="id" 
     value="<?php echo $_POST['id'];?>" > 
 <td>
 <div class="form-group">
    <label>Nume</label>

    <input type="text" class="form-control" name="nume" 
     value="<?php echo $row['Nume'];?>" > 
  </div></td>

  <td>
  <div class="form-group">
    <label>Prenume</label>
    <input type="text" class="form-control" name="prenume"
    value="<?php echo $row['Prenume'];?>" >
  </div></td>

   <td>
  <div class="form-group">
    <label>Sex</label>
    <input type="text" class="form-control" name="sex"
    value="<?php echo $row['Sex'];?>" >
  </div></td>

    <td>
  <div class="form-group">
    <label>Varsta</label>
    <input type="text" class="form-control" name="varsta"
    value="<?php echo $row['varsta'];?>" >
  </div></td>

    <td>
  <div class="form-group">
    <label>Greutate</label>
    <input type="text" class="form-control" name="greutate" 
    value="<?php echo $row['Greutate'];?>" >
  </div></td>

  <td><button type="submit" class="btn btn-default">Trimite</button></td>

</form>
</tr></table></div>
</body>
</html>