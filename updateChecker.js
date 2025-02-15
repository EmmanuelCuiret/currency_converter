// Charger la bibliothèque SweetAlert2 si elle n'est pas déjà incluse
if (!window.Swal) {
   const script = document.createElement("script");
   script.src = "https://cdn.jsdelivr.net/npm/sweetalert2@11";
   script.onload = checkVersion; // Appeler la fonction une fois le script chargé
   document.head.appendChild(script);
} else {
   checkVersion(); // Si déjà présent, on exécute directement
}

function checkVersion() {
   fetch("https://currency-converter-at78.onrender.com/version.json")
      .then(response => response.json())
      .then(data => {
         const currentVersion = localStorage.getItem("app_version");
         if (currentVersion && currentVersion !== data.version) {
            Swal.fire({
               title: "Mise à jour disponible 🚀",
               text: `Une nouvelle version (${data.version}) est disponible !`,
               icon: "info",
               confirmButtonText: "Mettre à jour",
               confirmButtonColor: "#3085d6",
               showCancelButton: true,
               cancelButtonText: "Plus tard",
               allowOutsideClick: false
            }).then((result) => {
               if (result.isConfirmed) {
                  location.reload(); // Recharge la page pour charger la nouvelle version
               }
            });
         }
         localStorage.setItem("app_version", data.version);
      })
      .catch(error => console.error("Erreur lors de la récupération de la version :", error));
}
