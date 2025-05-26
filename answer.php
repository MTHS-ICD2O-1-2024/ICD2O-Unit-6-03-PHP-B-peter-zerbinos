<!DOCTYPE html>
<html lang="en-ca">

<head>
  <meta charset="utf-8" />
  <meta name="description" content="Current Weather Results Web Page PHP" />
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
  <title>Current Weather Results PHP</title>
</head>

<body>
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Current Weather Results PHP</span>
      </div>
    </header>
    <main class="mdl-layout__content">
      <div class="page-content">
        <h4>Current Weather for Ottawa:</h4>
        <?php
        // Check if the 'get_weather' parameter is set (meaning the form was submitted)
        if (isset($_GET['get_weather'])) {
          $apiKey = "fe1d80e1e103cff8c6afd190cad23fa5"; // Your OpenWeatherMap API key
          $latitude = "45.4211435";
          $longitude = "-75.6900574";
          $apiUrl = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&appid={$apiKey}";

          // Attempt to get the JSON data from the API
          $jsonResult = @file_get_contents($apiUrl);

          if ($jsonResult === FALSE) {
            // Handle error if the API call fails
            echo "<p>Sorry, an error has occurred. Please try again later. (API call failed)</p>";
          } else {
            // Decode the JSON response
            $jsonData = json_decode($jsonResult);

            if ($jsonData === NULL) {
              // Handle error if JSON decoding fails
              echo "<p>Sorry, an error has occurred. Please try again later. (Invalid JSON response)</p>";
            } else {
              // Check if required weather data exists
              if (isset($jsonData->weather[0]) && isset($jsonData->main->temp)) {
                $weatherDescription = $jsonData->weather[0]->description;
                $weatherIconId = $jsonData->weather[0]->icon;
                $weatherIconUrl = "https://openweathermap.org/img/wn/" . $weatherIconId . "@2x.png";
                $currentWeatherKelvin = $jsonData->main->temp;
                $currentWeatherCelsius = $currentWeatherKelvin - 273.15;

                // Output the weather information
                echo "<p> The current temperature is " . round($currentWeatherCelsius) . "°C. </p>";
                echo "<p> The current weather is " . $weatherDescription . ". </p>";
                echo "<img src='" . $weatherIconUrl . "' alt='Weather Icon'>";
              } else {
                // Handle case where specific weather data is missing
                echo "<p>Sorry, an error has occurred. Please try again later. (Missing weather data)</p>";
              }
            }
          }
        } else {
          // If the page was accessed directly without form submission
          echo "<p>Please go back to the <a href='index.php'>main page</a> and click 'Get Weather' to see the current conditions.</p>";
        }
        ?>
        <br />
        <a href="index.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
          Go Back
        </a>
      </div>
    </main>
  </div>
</body>

</html>
