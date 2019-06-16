<?php
$servername = 'localhost';
$usr = 'root';
$psw = '';
$dbname = 'radio';
 $conn = new mysqli($servername,$usr,$psw,$dbname);
$id=$_GET['id'];
if(isset($_GET['brisi'])){
 $sql = "DELETE FROM pesme WHERE Id_pesme='$id'";
 if ($conn->query($sql) === TRUE) {
    header("Location:login.php");
} else {
    echo "Greska: " . $conn->error;
}

$conn->close();

}
?>
