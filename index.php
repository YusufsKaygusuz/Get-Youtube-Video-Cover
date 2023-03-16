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
  
  <script>
        const urlField = document.querySelector(".field input"),
        previewArea = document.querySelector(".preview-area"),
        imgTag = previewArea.querySelector(".thumbnail"),
        hiddenInput = document.querySelector(".hidden-input"),
        button = document.querySelector(".download-btn");

        urlField.onkeyup = ()=>{
          const imgUrl = urlField.value; // kullanıcı tarafından girilen değeri alma 
          previewArea.classList.add("active");
          button.style.pointerEvents = "auto";

    //https://www.youtube.com/watch?v=lqwdD2ivIbM example of video url --- lqwdD2ivIbM this is a video id and it's unique

    if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1){ // girilen değer YouTube videosunun url'si ise
       let vidId = imgUrl.split('v=')[1].substring(0, 11); // YouTube video url'sini v= olarak alıyoruz, böylece yalnızca video kimliğini almış oluyoruz
       let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`; // girilen url video kimliğini YouTube küçük resim url'sinin içine geçiriyoruz
       imgTag.src = ytImgUrl;
    }else if(imgUrl.indexOf("https://youtu.be/") != -1){ // video url'si şuna benziyorsa
       let vidId = imgUrl.split("be/")[1].substring(0, 11); // YouTube video url'sini be/ olarak alıyoruz, böylece yalnızca video kimliğini almış oluyoruz
       let ytThumnUrl = 'https://img.youtube.com/vi/${vidId}/maxresdefault.jpg'; // girilen url video kimliğini YouTube küçük resim url'sinin içine geçiriyoruz
       imgTag.src = ytThumnUrl;
    }else if(imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)){ // girilen değer başka bir resim dosyasının url'si ise
       imgTag.src = imgUrl;
    }else{
      imgTag.src = "";
        button.style.pointerEvents = "none";
        previewArea.classList.remove("active");
    }
    hiddenInput.value = imgTag.src; // img src'yi gizli giriş değerine geçirme
  }

</script>
  
</body>
</html>
