<html>
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<style>
input[type=submit] {
		background-color: green;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		border-radius: 4px;
		cursor: pointer;
}
input[type=text]{
 height:50px;
 font-size: 14pt;
}
input[type=email]{
 height:50px;
 font-size: 14pt;
}
input[type=password]{
 height:50px;
 font-size: 14pt;
}
form {
	 background-color: white;
	 border: 3px solid black;
	 margin: 0 auto;
	 width:240px;
	 display: inline-block;
	 position:fixed;
		top:20%;
		left:25%;
}
h1{
	background-color: white;
	border: 3px solid black;
	margin: 0 auto;
	height:50px;
	width:290px;
	display: inline-block;
	position:fixed;
	 top:5%;
	 left:25%;
}
</style>
<body>
	<center>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<br>
	<input type="text" name="username" placeholder="Username..."><br><br>
	<input type="password" name="password" placeholder="Šifra..."><br><br>
	<input type="text" name="pesma" placeholder="Trenutni naziv pesme..."><br><br>
	<input type="submit" name="lajkuj" value="Lajk"><br><br>
</form>
</center>
	<?php
    $servername="localhost";
  $usr="root";
  $pass="";
  $database="radio";
  if(isset($_POST['lajkuj'])){
   $user=$_POST['username'];
   $pesma=$_POST['pesma'];
	 $passw=$_POST['password'];

  $conn= new mysqli($servername,$usr,$pass,$database);

  $sql="SELECT Username,Sifra FROM radiologin";
   $result=$conn->query($sql);
   if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        if($user==$row["Username"] && $passw==$row["Sifra"]  ){
        	$sql1="INSERT INTO pesme (Username,Pesma) VALUES(?,?)";
  $statement=$conn->prepare($sql1);
  $statement->bind_param('ss',$user,$pesma);
  $statement->execute();
  echo "<script>window.close();</script>";

        }
				else{
					echo "<br>";
				  echo "<h1>Nepostojeći username.<br><br>Pokušajte ponovo</h1>";
				}

    }
}
}
	?>
</body>
</html>
