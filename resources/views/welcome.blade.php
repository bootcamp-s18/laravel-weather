<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #error {
                display: none;
            }

            #output {
                display: none;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div id="content" class="content">
                <div class="title m-b-md">
                    Weather
                </div>
                <div class="links">Fetching current weather for you...</div>
            </div>

            <div id="error">
                <div class="card mb-3 border-dark">
                    <div class="card-header bg-danger text-center font-weight-bold border-dark">Error</div>
                    <div id="errorMessage" class="card-body"></div>
                </div>
            </div>

            <div id="output">


<div class="row">

    <div class="col" style="min-width: 300px;">

                <div class="card mb-3 border-dark">
                    <div class="card-header bg-warning text-center font-weight-bold border-dark">City</div>
                    <div id="cityOutput" class="card-body text-center"></div>
                </div>
                <div class="card mb-3 border-dark">
                    <div class="card-header bg-warning text-center font-weight-bold border-dark">Temperature</div>
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center no-gutters">
                            <div id='temperatureOutputK' class="border border-secondary col text-center pt-3 pb-3"></div>
                            <div id='temperatureOutputF' class="border border-secondary col text-center pt-3 pb-3"></div>
                            <div id='temperatureOutputC' class="border border-secondary col text-center pt-3 pb-3"></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 border-dark">
                    <div class="card-header bg-warning text-center font-weight-bold border-dark">Condition</div>
                    <div id="condition" class="card-body text-center"></div>
                </div>
            
    </div>

    <div class="col">

                <div class="card mb-3 border-dark">
                    <div class="card-header bg-warning text-center font-weight-bold border-dark">How does it look outside?</div>
                    <div class="card-body">
                        <img alt='' src='' id='weatherImage' width='300'>
                    </div>
                </div>

    </div>

</div>



            </div>

        </div>

        <script>

            // Output variables
            var output = document.getElementById('output');
            var cityOutput = document.getElementById('cityOutput');
            var tempK = document.getElementById('temperatureOutputK');
            var tempF = document.getElementById('temperatureOutputF');
            var tempC = document.getElementById('temperatureOutputC');
            var condition = document.getElementById('condition');
            var weatherImage = document.getElementById('weatherImage');

            // Error variables
            var error = document.getElementById("error");
            var errorMessage = document.getElementById('errorMessage');

            // The welcome message
            var content = document.getElementById("content");

            // Other
            var apiRequest;
            var appId = "ef6a94dab254dc386b931af4d5ca58c7";

            document.onreadystatechange = function() {
                if (document.readyState == "interactive") {
                    // Initialize your application or run some code.

                    if ("geolocation" in navigator) {
                        /* geolocation is available */

                        navigator.geolocation.getCurrentPosition(function(position) {
                            getWeather(position.coords.latitude, position.coords.longitude);
                        });

                    } else {
                      /* geolocation IS NOT available */
                      alert("Geolocation is NOT available!");
                    }

                }
            };

            function getWeather(lat, lon) {

                // Set up url for fetching weather data.
                var url = "http://api.openweathermap.org/data/2.5/weather?lat=<lat>&lon=<lon>&appid=<appId>&us";
                url = url.replace("<lat>", lat);
                url = url.replace("<lon>", lon);
                url = url.replace("<appId>", appId);

                var content = document.getElementById('content');
                // content.innerHTML = '<a href="' + url + '">Get weather for my location</a>';

                // Code that fetches data from the API URL and stores it in results.
                apiRequest = new XMLHttpRequest();
                apiRequest.onload = catchResponse;
                apiRequest.onerror = httpRequestOnError;
                apiRequest.open('get', url, true);
                apiRequest.send();
            };

            function httpRequestOnError() {

                // TODO: What's reasonable error handling if the request for current weather data at my location fails?

                // output.style.display = 'none';
                // errorMessage.innerHTML = 'There was a problem reaching the weather API. Try again later.'
                // error.style.display = 'block';
            }

            function catchResponse() {

                if (apiRequest.statusText === "OK") {

                    var response = JSON.parse(apiRequest.responseText);

                    error.style.display = 'none';
                    content.style.display = 'none';
                    cityOutput.innerHTML = response.name;
                    tempK.innerHTML = Math.round(response.main.temp) + ' K';
                    tempF.innerHTML = convertKtoF(response.main.temp) + '&deg; F';
                    tempC.innerHTML = convertKtoC(response.main.temp) + '&deg; C';
                    condition.innerHTML = response.weather[0].description;
                    displayImage(convertKtoF(response.main.temp));
                    output.style.display = 'block';

                }
                else {
                    error.style.display = 'block';
                    content.style.display = 'none';
                    errorMessage.innerHTML = apiRequest.statusText;
                }

            }

            function convertKtoF(kelvin) {
                var fahr = kelvin * (9/5) - 459.67; 
                return Math.round(fahr);
            }

            function convertKtoC(kelvin) {
                var cel = kelvin - 273.15;
                return Math.round(cel);
            }

            function displayImage(tempF) {

                if (tempF > 85) {
                    weatherImage.src = 'https://goo.gl/c8VxVr';
                }
                else if (tempF > 65) {
                    weatherImage.src = 'https://goo.gl/WNV85G';
                }
                else if (tempF > 32) {
                    weatherImage.src = 'https://goo.gl/KAbVwR';
                }
                else {
                    weatherImage.src = 'https://goo.gl/a4mnmd';
                }

            }

        </script>


    </body>
</html>
