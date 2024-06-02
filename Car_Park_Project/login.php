<?php 

    include_once "baglanti.php";

    if(isset($_POST["kayit"])){
        $girisTarihi = new Datetime();
        $girisTarihiString = $girisTarihi->format('Y-m-d H:i:s');
        $aracPlaka = $_POST['aracPlaka'];

        $aracKayit = "INSERT INTO araclar (aracPlaka,aracGiris) VALUES ('$aracPlaka','$girisTarihiString')";
        $query_run = mysqli_query($baglanti,$aracKayit);
    }

    if(isset($_POST['cikis'])){
        $cikisTarihi = new Datetime();
        $cikisTarihiString = $cikisTarihi->format('Y-m-d H:i:s');

        $aracPlaka = $_POST['aracPlaka'];

        $arabaKontrol = "SELECT aracPlaka FROM araclar WHERE aracPlaka = '$aracPlaka'";
        $arabaKontrolQuery = mysqli_query($baglanti,$arabaKontrol);
        $arabaKontrolSayisi = mysqli_num_rows($arabaKontrolQuery);

        if($arabaKontrolSayisi > 0) {
            $aracCikis = "UPDATE araclar SET aracCikis ='$cikisTarihiString' WHERE aracPlaka = '$aracPlaka'";
            $aracCikisQuery = mysqli_query($baglanti,$aracCikis);
            header("location:login.php");

        }
        else {
            $message  = "Otoparkımızda Böyle Bir Araç Bulunmamaktadır!";
            echo "<p class='hatamesaji'>$message</p>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arac Kayıt</title>
    <link rel="stylesheet" href="style/login.css">



</head>
<body style="background-image: url('gorseller/loginbackground.jpg'); background-repeat: no-repeat; background-size: cover;
    background-position: center;  height: 90vh;">
    <form action="login.php" method="POST">
        <label for="aracPlaka">Araç Plakası</label>
        <input type="text" name="aracPlaka" required autocomplete="off"> </input>
        <br>
        <button name="kayit">Kayıt Et</button>
        <button name="cikis">Araç Çıkışı</button>
    </form>
    
    <h2 id="baslik" style=" color: white; text-align:center">AKHİSAR MYO OTOPARK</h2>
    <form action="yonetici.php"method="POST">
        <button name="yonetici">Yönetici Giriş</button>
    </form>
   
  
 
</body>
</html>