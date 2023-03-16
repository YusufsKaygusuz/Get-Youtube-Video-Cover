<?php
  if(isset($_POST['download'])){ // indirme btn'a tıklandıysa 
    $imgUrl = $_POST['imgurl']; // gizli girişten img url'si alma
    $ch = curl_init($imgUrl); // 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // verileri doğrudan çıktısını almak yerine curl_ecex'in dönüş değeri olarak aktarılır
    $download = curl_exec($ch);
    curl_close($ch);
    header('Content-type: image/jpg');
    header('Content-Disposition: attachment; filename="thumbnail.jpg"'); 
    echo $download; 
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube videolarındaki küçük resimleri indirin</title>
    <link rel="stylesheet" href="style.css">
    <!-- Yazı tipleri için link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <header>Küçük Resimleri İndirin</header>
        <div class="url-input">
            <span class="title">Video URL yapıştırınız:</span>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com/watch?v=lqwdD2ivIbM" required>
                <input class="hidden-input" type="hidden" name="imgurl">
                <div class="bottom-line"></div>
            </div>
        </div>
        <div class="preview-area">
            <img class="thumbnail" src="" alt="thumbnail">
            <i class="icon fas fa-cloud-download-alt"></i>
            <span>Önizlemeyi görmek için videoyu yapıştırınız</span>
        </div>
        <button class="download-btn" type="submit" name="download" >Resmi İndiriniz</button>
     </form>
  
<script src="script.js"></script>
  
</body>
</html>
