<html>
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<body >
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
  </style>
<?php
   if(isset($_POST['signin'])){
    echo "<center>";
    echo  "<form method='post' action='logovanje2.php' >";
    echo "<br>";
    echo "<input type='text' name='usrname' placeholder='Korisničko ime...' ></br><br>";
    echo "<input type='password' name='psw' placeholder='Šifra... '></br><br>";
    echo "<input type='submit' name='salji1' value='Uloguj se'>";
    echo "</center>";
   }

   if(isset($_POST['signup'])){
     echo "<center>";
     echo  "<form method='post' action='logovanje2.php' >";
     echo "<br>";
     echo "<input type='text' name='ime' placeholder='Ime...' height='100'></br><br>";
     echo "<input type='text' name='prezime'placeholder='Prezime...'></br><br>";
     echo "<input type='text' name='usrname' placeholder='Korisničko ime...'></br><br>";
     echo "<input type='email' name='email' placeholder='E-mail...'></br><br>";
     echo "<input type='password' name='psw' placeholder='Šifra...'></br><br>";
     echo "<input type='submit' name='salji2' value='Registruj se'>";
     echo "</center>";
   }
?>
</body>
</html>
