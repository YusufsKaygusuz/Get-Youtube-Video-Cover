    
    const urlField = document.querySelector(".field input"); // URL giriş alanını seç
    const previewArea = document.querySelector(".preview-area"); // Önizleme alanını seç
    const imgTag = previewArea.querySelector(".thumbnail"); // Önizleme alanındaki resim etiketini seç
    const hiddenInput = document.querySelector(".hidden-input"); // Gizli giriş alanını seç
    const button = document.querySelector(".download-btn"); // İndirme butonunu seç

    const isYouTubeUrl = (url) => { // URL'nin YouTube URL'si olup olmadığını kontrol etmek için bir fonksiyon oluştur
      const youtubeUrlRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\//i; // YouTube URL'leri için bir regex kullan
      return youtubeUrlRegex.test(url); // URL'nin YouTube URL'si olup olmadığını döndür
    }

    const isImageFileUrl = (url) => { // URL'nin resim dosyası URL'si olup olmadığını kontrol etmek için bir fonksiyon oluştur
      const imageFileUrlRegex = /\.(jpe?g|png|gif|bmp|webp)$/i;  // Resim dosyaları için bir regex kullan
      return imageFileUrlRegex.test(url); // URL'nin resim dosyası URL'si olup olmadığını döndür
    }

    const getImageUrl = (url) => { // Verilen URL'den resim URL'si almak için bir fonksiyon oluştur
      if (!url.startsWith("http://") && !url.startsWith("https://")) { // URL "http://" veya "https://" ile başlamıyorsa
        return ""; // boş bir dize döndür
      }
      let imgUrl = "";
      if (isYouTubeUrl(url)) { // Eğer URL YouTube URL'si ise
        const videoId = url.match(/(?:v=|youtu\.be\/)(.{11})/)[1]; // YouTube video kimliğini al
        imgUrl = `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`; // YouTube önizleme resmi için URL oluştur
      } else if (isImageFileUrl(url)) { // Eğer URL resim dosyası URL'si ise
        imgUrl = url; // URL'yi resim URL'si olarak ayarla
      }
      return imgUrl; // Resim URL'sini döndür
    }

    urlField.addEventListener("input", () => { // URL giriş alanındaki değişiklikleri dinle
      const imgUrl = urlField.value.trim(); // Giriş alanındaki URL'yi al ve baştaki ve sondaki boşlukları temizle
      if (imgUrl) { // Eğer URL mevcutsa
        const imageUrl = getImageUrl(imgUrl); // URL'den resim URL'sini al
        if (imageUrl) { // Eğer resim URL'si mevcutsa
          imgTag.src = imageUrl; // Resim etiketinin "src" özelliğini resim URL'siyle güncelle
          previewArea.classList.add("active"); // Önizleme alanına "active" sınıfını ekle
          button.style.pointerEvents = "auto"; // Butonun etkinliğini açmak için pointer-events stil özelliğini "auto" olarak ayarla
          hiddenInput.value = imageUrl; // Gizli giriş alanının değerini resim URL'siyle güncelle
        } else {
          imgTag.src = ""; // Resim etiketinin "src" özelliğini boş hale getir
          previewArea.classList.remove("active");  // Önizleme alanından "active" sınıfını kaldır
          button.style.pointerEvents = "none"; // Butonun etkinliğini kapatmak için pointer-events stil özelliğini "none" olarak ayarla
          hiddenInput.value = ""; // Gizli giriş alanının değerini boş hale getir
        }
      } else {
        imgTag.src = ""; // Resim etiketinin "src" özelliğini boş hale getir
        previewArea.classList.remove("active"); // Önizleme alanından "active" sınıfını kaldır
        button.style.pointerEvents = "none"; // Butonun etkinliğini kapatmak için pointer-events stil özelliğini "none" olarak ayarla
        hiddenInput.value = ""; // Gizli giriş alanının değerini boş hale getir
      }
    });
