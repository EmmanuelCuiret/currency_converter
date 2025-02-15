
<?php
$currencies = [
   ["code" => "AUD", "name" => "Australian Dollar", "flag" => "🇦🇺"],
   ["code" => "BRL", "name" => "Brazilian Real", "flag" => "🇧🇷"],
   ["code" => "CAD", "name" => "Canadian Dollar", "flag" => "🇨🇦"],
   ["code" => "CNY", "name" => "Chinese Yuan", "flag" => "🇨🇳"],
   ["code" => "DZD", "name" => "Algerian Dinar", "flag" => "🇩🇿"],
   ["code" => "EGP", "name" => "Egyptian Pound", "flag" => "🇪🇬"],
   ["code" => "EUR", "name" => "Euro", "flag" => "🇪🇺"],
   ["code" => "GBP", "name" => "British Pound", "flag" => "🇬🇧"],
   ["code" => "CHF", "name" => "Swiss Franc", "flag" => "🇨🇭"],
   ["code" => "ILS", "name" => "Israeli Shekel", "flag" => "🇮🇱"],
   ["code" => "INR", "name" => "Indian Rupee", "flag" => "🇮🇳"],
   ["code" => "JPY", "name" => "Japanese Yen", "flag" => "🇯🇵"],
   ["code" => "KRW", "name" => "South Korean Won", "flag" => "🇰🇷"],
   ["code" => "MAD", "name" => "Moroccan Dirham", "flag" => "🇲🇦"],
   ["code" => "MXN", "name" => "Mexican Peso", "flag" => "🇲🇽"],
   ["code" => "RUB", "name" => "Russian Ruble", "flag" => "🇷🇺"],
   ["code" => "TND", "name" => "Tunisian Dinar", "flag" => "🇹🇳"],
   ["code" => "USD", "name" => "US Dollar", "flag" => "🇺🇸"],
   ["code" => "ZAR", "name" => "South African Rand", "flag" => "🇿🇦"],
];

// Tri des monnaies par nom
usort($currencies, function ($a, $b) {
   return strcmp($a["name"], $b["name"]);
});

?>

<script>
function swapCurrencies() {
      let fromCurrency = document.getElementById("currency_from");
      let toCurrency = document.getElementById("currency_to");

      // Ajout de la classe d'animation
      fromCurrency.classList.add("swapping");
      toCurrency.classList.add("swapping");

      // Après 500ms (durée de l'animation), on swap et on enlève l'effet
      setTimeout(() => {
         let tempValue = fromCurrency.value;
         fromCurrency.value = toCurrency.value;
         toCurrency.value = tempValue;

         // Suppression de la classe pour réinitialiser l'effet
         fromCurrency.classList.remove("swapping");
         toCurrency.classList.remove("swapping");
      }, 400);
   }

   function validateForm() {
      let amount = document.getElementById("amount").value;

      if (
         amount === "" || 
         isNaN(amount) || 
         parseFloat(amount) <= 0 || 
         !/^\d+(\.\d{1,2})?$/.test(amount) || 
         amount.includes("-") // Empêche les nombres négatifs
      ) {
         Swal.fire({
         icon: "warning",
         title: "Invalid Amount",
         text: "Please enter a valid positive amount with at most 2 decimal places.",
         confirmButtonColor: "#3085d6",
         confirmButtonText: "OK",
         backdrop: true,
         scrollbarPadding: false, // Désactive le recalcul du padding
         customClass: {
            title: "swal-title",
            popup: "swal-popup",
            confirmButton: "swal-button"
         }
         });
         return false; // Empêche l’envoi du formulaire
         }
      return true; // Formulaire valide
   }

</script>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">   <title>Document</title>
   <link rel="stylesheet" href="style.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Icônes pour Mobiles -->
   <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon_32x32.png">
   <link rel="apple-touch-icon" sizes="32x32" href="/images/favicon_32x32.png">
   <link rel="manifest" href="site.webmanifest">
</head>

<body>
<form method="get" action="target.php" onsubmit="return validateForm()" novalidate>
   <h1 class="flame-text">Pick your currency!</h1>

   <label for="currency_from">From currency:</label>
      <select name="currency_from" id="currency_from">
         <?php foreach ($currencies as $currency) { ?>
            <option value="<?php echo $currency['code']; ?>"
            <?php echo ($currency['code'] === 'EUR') ? 'selected' : ''; ?>>
            <?php echo $currency["flag"] . " " . $currency["name"]; ?>
            </option>
         <?php } ?>      
       </select>

   <button type="button" class="swap-button" onclick="swapCurrencies()">🔄 Swap</button>

   <label for="currency_to">To currency:</label>
      <select name="currency_to" id="currency_to">
         <?php foreach ($currencies as $currency) { ?>
            <option value="<?php echo $currency['code']; ?>"><?php echo $currency["flag"] . " " . $currency["name"]; ?></option>
         <?php } ?>      
       </select>

   <label for="amount">Enter amount in local currency:</label>
   <input type="number" name="amount" id="amount">
   <button type="submit">Submit</button>
   <p>Exchange rate of february 14, 2025</p>
</form>

<script>
 
</script>

</body>
</html>