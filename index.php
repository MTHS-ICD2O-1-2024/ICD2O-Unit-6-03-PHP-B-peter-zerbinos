<!DOCTYPE html>
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
  <title>Current Weather Web Page</title>
</head>

<body>
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Current Weather Web Page</span>
      </div>
    </header>
    <main class="mdl-layout__content">
      <div class="page-content">Click the button to get the current weather.
        <br />
        <br />
        <button id="getWeatherButton"
          class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
          Get Weather
        </button>
        <div id="weatherResult">
        </div>
      </div>
    </main>
  </div>

  <script>
    document.getElementById('getWeatherButton').addEventListener('click', async () => {
      const apiKey = "fe1d80e1e103cff8c6afd190cad23fa5"; // Your OpenWeatherMap API key
      const latitude = "45.4211435";
      const longitude = "-75.6900574";
      const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${apiKey}`;
      const weatherResultDiv = document.getElementById('weatherResult');

      weatherResultDiv.innerHTML = 'Loading weather...'; // Show a loading message

      try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const jsonData = await response.json();

        const weatherDescription = jsonData.weather[0].description;
        const weatherIconId = jsonData.weather[0].icon;
        const weatherIconUrl = `https://openweathermap.org/img/wn/${weatherIconId}@2x.png`;
        const currentWeatherKelvin = jsonData.main.temp;
        const currentWeatherCelsius = currentWeatherKelvin - 273.15;

        // Output
        weatherResultDiv.innerHTML = `
          <p> The current temperature is ${currentWeatherCelsius.toFixed(0)}°C. </p>
          <p> The current weather is ${weatherDescription}. </p>
          <img src="${weatherIconUrl}" alt="Weather Icon">
        `;
      } catch (error) {
        console.error("Error fetching weather:", error);
        weatherResultDiv.innerHTML = "Sorry, an error has occurred. Please try again later.";
      }
    });
  </script>
</body>

</html>
