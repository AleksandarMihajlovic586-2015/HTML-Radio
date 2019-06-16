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
form{
  position:fixed;
   top:30%;
   left:20%;
   width:250px;
}
</style>
<?php
  $servername="localhost";
  $usr="root";
  $pass="";
  $database="radio";

  $conn= new mysqli($servername,$usr,$pass,$database);

  if(isset($_POST['salji2'])) { //Registracija
    $username=$_POST['usrname'];
    $password=$_POST['psw'];
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $email=$_POST['email'];
  $sql="INSERT INTO radiologin (Ime,Prezime,Username,Email,Sifra) VALUES(?,?,?,?,?)";
  $statement=$conn->prepare($sql);
  $statement->bind_param('sssss',$ime,$prezime,$username,$email,$password);
  $statement->execute();
  echo "<form method='Post' action='login.php'>";
  echo "<b>USPEŠNO STE SE REGISTROVALI</b> <br>";
  echo "<input type='submit' name='salji3' value='Nazad'>";
  echo "</form>";

}
if(isset($_POST['salji1'])){
    $username = $_POST['usrname'];
    $psw = $_POST['psw'];

    $g=0;
    $sql1 = "SELECT Username, Sifra FROM radiologin";
    $rez1 = $conn->query($sql1);
    if($rez1->num_rows > 0){
      while($red1 = $rez1->fetch_array()){
        $user1 = $red1[0];
        $sifra1 = $red1[1];
        if($username === $user1 && $psw === $sifra1){
          $g=1;
           $sql = "SELECT Id_pesme,Pesma FROM pesme WHERE Username='$username'";
           $rez = $conn->query($sql);
           echo "<form  action='brisi.php' method='get' style='color:white;font-size:20;position: fixed;top: 10%;left:25%;margin-top: 10px;margin-left: -400px;background-color:black;width:400px;height:700px;border:1px solid black;padding:1px;margin:-60px;'>";
           echo "<center><b>LISTA VAŠIH OMILJENIH PESAMA:</b><center><br><br>";

           if($rez->num_rows > 0){

            echo "<ul>";
            while($red = $rez->fetch_array()){
              $id=$red[0];
              echo "<li>".$red[1]."
              <input type='hidden' value='".$id."' name='id'>
             <input type='submit' value='X' name='brisi'>
              </li>";
              echo "<br>";

            }
            echo "</ul>";
              echo "</form>";
           }
           break;
        }
        else{
          echo "<form method='post' action='login.php'>";
        echo "<b>NEUSPEŠAN LOGIN</b><br>";
        echo "<input type='submit'value='Nazad'>";
        echo "</form>";
        }

      }
    }
  }
?>
</body>
</html>
