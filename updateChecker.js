fetch("https://currency-converter-at78.onrender.com/version.json")
   .then(response => response.json())
   .then(data => {
      const currentVersion = localStorage.getItem("app_version");
      if (currentVersion && currentVersion !== data.version) {
         alert("Une nouvelle version de l'application est disponible !");
      }
      localStorage.setItem("app_version", data.version);
   });