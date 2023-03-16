    
    const urlField = document.querySelector(".field input");
    const previewArea = document.querySelector(".preview-area");
    const imgTag = previewArea.querySelector(".thumbnail");
    const hiddenInput = document.querySelector(".hidden-input");
    const button = document.querySelector(".download-btn");

    const isYouTubeUrl = (url) => {
      const youtubeUrlRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\//i;
      return youtubeUrlRegex.test(url);
    }

    const isImageFileUrl = (url) => {
      const imageFileUrlRegex = /\.(jpe?g|png|gif|bmp|webp)$/i;
      return imageFileUrlRegex.test(url);
    }

    const getImageUrl = (url) => {
      if (!url.startsWith("http://") && !url.startsWith("https://")) {
        return "";
      }
      let imgUrl = "";
      if (isYouTubeUrl(url)) {
        const videoId = url.match(/(?:v=|youtu\.be\/)(.{11})/)[1];
        imgUrl = `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`;
      } else if (isImageFileUrl(url)) {
        imgUrl = url;
      }
      return imgUrl;
    }

    urlField.addEventListener("input", () => {
      const imgUrl = urlField.value.trim();
      if (imgUrl) {
        const imageUrl = getImageUrl(imgUrl);
        if (imageUrl) {
          imgTag.src = imageUrl;
          previewArea.classList.add("active");
          button.style.pointerEvents = "auto";
          hiddenInput.value = imageUrl;
        } else {
          imgTag.src = "";
          previewArea.classList.remove("active");
          button.style.pointerEvents = "none";
          hiddenInput.value = "";
        }
      } else {
        imgTag.src = "";
        previewArea.classList.remove("active");
        button.style.pointerEvents = "none";
        hiddenInput.value = "";
      }
    });
