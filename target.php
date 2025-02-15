<?php 

$exchange_rate = [
   "EUR" => 1,
   "AUD" => 1.57,
   "BRL" => 5.20,
   "CAD" => 1.45,
   "CNY" => 7.80,
   "DZD" => 150.00,
   "EGP" => 19.00,
   "GBP" => 0.85,
   "CHF" => 1.10,
   "ILS" => 4.00,
   "INR" => 88.00,
   "JPY" => 130.00,
   "KRW" => 1350.00,
   "MAD" => 10.50,
   "MXN" => 22.00,
   "RUB" => 90.00,
   "TND" => 3.20,
   "USD" => 1.10,
   "ZAR" => 18.00,
];

/* Fonction de conversion */
function convertCurrency($amount, $currency_from, $currency_to, $exchange_rate) {
   if (!isset($exchange_rate[$currency_from]) || !isset($exchange_rate[$currency_to])) {
      return "Unknown currency";
   } 

   $converted_amount = $amount * ($exchange_rate[$currency_to] / $exchange_rate[$currency_from]);
   
   return number_format($converted_amount, 2, ',', ' ') . " " . $currency_to;
}

/* Vérification des données */
if (!isset($_GET['currency_from'], $_GET['currency_to'], $_GET['amount']) || !is_numeric($_GET['amount'])) {
   die("<div class='error-message'>Error: Invalid or missing data.</div>");
}

$currency_from = strtoupper($_GET['currency_from']);
$currency_to = strtoupper($_GET['currency_to']);
$amount = floatval($_GET['amount']); //Conversion pour calcul
$conversion_result = convertCurrency($amount, $currency_from, $currency_to, $exchange_rate);
$formatted_amount = number_format($amount, 2, ',', ' '); //Conversion pour affichage
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Currency Conversion Result</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
<form>
<div class="container">
   <h1>💰 Currency Conversion 💰</h1>
   <div class="result-box">
      <p class="result-text">
         <?php echo "{$formatted_amount} {$currency_from} = <strong>{$conversion_result}</strong>"; ?>
      </p>
   </div>
   
   <a href="index.php" class="back-button">⬅ Back to Conversion</a>
</div>
</form>
</body>
</html>
