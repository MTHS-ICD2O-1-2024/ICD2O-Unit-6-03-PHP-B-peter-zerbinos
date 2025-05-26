<!DOCTYPE html>
<!-- ICS2O-Unit6-03-PHP -->
<html lang="en-ca">

<head>
  <meta charset="utf-8" />
  <meta name="description" content="Current Weather Web Page PHP" />
  <meta name="keywords" content="mths, icd2o" />
  <meta name="author" content="Peter Zerbinos" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.amber-orange.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png" />
  <link rel="manifest" href="./site.webmanifest" />
  <title>Current Weather Web Page PHP</title>
</head>

<body>
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Current Weather Web Page PHP</span>
      </div>
    </header>
    <main class="mdl-layout__content">
      <div class="page-content">Click the button to get the current weather.
        <br />
        <br />
        <form action="#">
          <!-- Accent-colored raised button with ripple -->
          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
            type="submit">
            Get Weather
          </button>
        </form>
      </div>
      <?php
      async () {
        try {
          $resultJSON = await fetch(
            "https://api.openweathermap.org/data/2.5/weather?lat=45.4211435&lon=-75.6900574&appid=fe1d80e1e103cff8c6afd190cad23fa5"
          )
          $jsonData = await resultJSON.json();
          console.log(jsonData);
          $weatherDescription = jsonData.weather[0].description;
          $weatherIconId = jsonData.weather[0].icon;
          $weatherIconUrl = "https://openweathermap.org/img/wn/" + weatherIconId + "@2x.png";
          $currentWeatherKelvin = jsonData.main.temp
          $currentWeatherCelcius = currentWeatherKelvin - 273.15;
      
          // output
          echo "<p> The current temperature is " + $currentWeatherCelcius.toFixed(0) + "°C. </p> </br> <p> The current weather is " +
            $weatherDescription + ". </br> <img src =" + $weatherIconUrl + " alt='Weather Icon'>"
        } catch (error) {
          // If an error has occured
          echo "Sorry, an error has occured. Please try again later."
        }
      }
      ?>
    </main>
  </div>
</body>

</html>
