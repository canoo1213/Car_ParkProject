


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/araclar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Yönetici</title>
   
</head>
<body>
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

     
} else {
    // Eğer sorgu başarısızsa hata mesajı yazdır
    echo "Veritabanından veri alınamadı: " . mysqli_error($baglanti);
}
  
    }

 // Veritabanından verileri almak için SQL sorgusunu hazırla
 $sorgu = "SELECT * FROM araclar";

 // Sorguyu veritabanında çalıştır
 $cikti = mysqli_query($baglanti, $sorgu);
   
 // Eğer sorgu başarılıysa
 if ($cikti) {
     // Verileri HTML tablosu içinde yazdır
     echo "<table border='1'>
             <tr>
                 <th>Araç Plakası</th>
                 <th>Araç Giriş</th>
                 <th>Araç Çıkış</th>
                 <th>İşlemler</th>
             </tr>";
     while ($satir = mysqli_fetch_assoc($cikti)) {
         echo "<tr>";
         echo "<td>" . $satir['aracPlaka'] . "</td>";
         echo "<td>" . $satir['aracGiris'] . "</td>";
         echo "<td>" . $satir['aracCikis'] . "</td>";
         echo "<td>
                <form action='araçlar.php' method='post'>
                    <input type='hidden' name='arac_id' value='" . $satir['arac_id'] . "'>
                    <button type='submit' class='silButton' name='silButton' align=center ><i class='bx bxs-trash-alt'></i> 
                    SİL    
                    </button>
                </form>
            </td>";
              
     }
     echo "</table>";
     
    }

//    Silme işlemis
 include_once "baglanti.php";
if(isset($_POST['silButton'])) {
    $aracId = $_POST['arac_id'];
    $silSorgusu = "DELETE FROM araclar WHERE arac_id = $aracId"; 
    if(mysqli_query($baglanti, $silSorgusu)) {
        echo "<script>alert('Araba başarıyla silindi.');</script>";
        //Sayfayı yenilemek için yönlendirme yapabilirsiniz
        header("refresh:0");
    } else {
        echo "Araba silinirken bir hata oluştu: " . mysqli_error($baglanti);
    }
}  

?>


<form action="login.php" method="post"  >

        <button type="submit" name="login" id="cikis">Çıkış</button>


    </form>

</body>
</html>