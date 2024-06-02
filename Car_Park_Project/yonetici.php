<?php
include_once "baglanti.php";


if (isset($_POST['giris'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $query = "SELECT * FROM yoneticiler WHERE yonetici_adi = '$username' AND yonetici_şifre ='$password'";
    $calistir = mysqli_query($baglanti,$query);
  
    $numrow = mysqli_num_rows($calistir);
  
    if ($numrow > 0 ) {
      session_start();
      $_SESSION["yonetici_adi"] = $username;
      header("location:araçlar.php");
  
    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">Kullanıcı Bulunamadı.</div>';
    }
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yonetici</title>
    <link rel="stylesheet" href="style/yonetici.css">
</head>
<body style="background-image: url('gorseller/yoneticibackground.jpg'); background-repeat: no-repeat; background-size: cover;
    background-position: center;  height: 90vh;">
<div class="container">
<form action="yonetici.php"method="POST">
<label for="username">kullanıcı adı</label>
        <input type="text" name="username" autocomplete ="off" required></input><br>
        <label for="password">şifre</label>
        <input type="password" id="password" name="password" required><br>
        <button name="giris">Giriş Yap</button>
        
        <button name="login" onclick="window.location.href='login.php'">Çıkış </button><br>
             
</form>
 
 
</div>





     


</body>
</html>