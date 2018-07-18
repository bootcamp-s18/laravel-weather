<template>

    <div class="container">

        <div class="text-center" v-if="showStatus">
            <span v-html="status"></span>
        </div>

        <div v-if="showError">
            <div class="card mb-3 border-dark">
                <div class="card-header bg-danger text-center font-weight-bold border-dark">Error</div>
                <div class="card-body"><span v-html="error"></span></div>
            </div>
        </div>

        <div v-if="showOutput">

            <div class="row">

                <div class="col" style="min-width: 300px;">

                    <div class="card mb-3 border-dark">
                        <div class="card-header bg-warning text-center font-weight-bold border-dark">Location</div>
                        <div class="card-body">
                            <h3 v-if="zipcode"><strong>Zipcode:</strong> {{ zipcode }}</h3>
                            <div><strong>Latitude:</strong> {{ lat }}</div>
                            <div><strong>Longitude:</strong> {{ lon }}</div>
                            <div><strong>City Name:</strong> {{ cityName }}</div>
                        </div>
                    </div>
                    <div class="card mb-3 border-dark">
                        <div class="card-header bg-warning text-center font-weight-bold border-dark">Temperature</div>
                        <div class="card-body">
                            <div class="row align-items-center justify-content-center no-gutters">
                                <div class="border border-secondary col text-center pt-3 pb-3">{{ tempK }}</div>
                                <div class="border border-secondary col text-center pt-3 pb-3"><span v-html="tempF"></span></div>
                                <div class="border border-secondary col text-center pt-3 pb-3"><span v-html="tempC"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 border-dark">
                        <div class="card-header bg-warning text-center font-weight-bold border-dark">Condition</div>
                        <div class="card-body text-center">{{ condition }}</div>
                    </div>
                        
                </div>

                <div class="col">

                    <div class="card mb-3 border-dark">
                        <div class="card-header bg-warning text-center font-weight-bold border-dark">How does it look outside?</div>
                        <div class="card-body text-center">
                            <img alt='' :src="weatherImage" width='300'>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>
    export default {

        mounted() {

            if ("geolocation" in navigator) {
                /* geolocation is available */

                navigator.geolocation.getCurrentPosition(this.getWeather, this.locationDenied);

            } else {
              /* geolocation IS NOT available */
              alert("Geolocation is NOT available!");
            }

        },

        props: ['zipcode'],

        data: function() {

            return {

                showOutput: false,
                lat: '',
                lon: '',
                cityName: '',
                tempK: '',
                tempF: '',
                tempC: '',
                condition: '',
                weatherImage: '',
                
                showError: false,
                error: '',

                showStatus: true,
                status: '<h1>Fetching current weather for you...</h1>',
                
                apiRequest: null,
                appId: "ef6a94dab254dc386b931af4d5ca58c7"

            }

        },

        methods: {

            locationDenied: function() {

                this.status = "<p>'Weather' is an application that helps you view current conditions for places you choose.</><p>Login or Register using the links in the upper right, then save zip codes to quickly access weather for the locations you care about.</p>";

            },

            getWeather: function(position) {

                // Set up url for fetching weather data.
                var url = "http://api.openweathermap.org/data/2.5/weather?zip=<zipCode>&us&appid=<appId>";
                if (!this.zipcode) {
                    url = "https://api.openweathermap.org/data/2.5/weather?lat=<lat>&lon=<lon>&appid=<appId>&us";
                    url = url.replace("<lat>", position.coords.latitude);
                    url = url.replace("<lon>", position.coords.longitude);
                }
                else {
                    url = url.replace("<zipCode>", this.zipcode);
                }
                url = url.replace("<appId>", this.appId);

                // Code that fetches data from the API URL and stores it in results.
                this.apiRequest = new XMLHttpRequest();
                this.apiRequest.onload = this.catchResponse;
                this.apiRequest.onerror = this.httpRequestOnError;
                this.apiRequest.open('get', url, true);
                this.apiRequest.send();
            },

            httpRequestOnError: function() {

                this.locationDenied();

            },

            catchResponse: function() {

                if (this.apiRequest.statusText === "OK") {

                    var response = JSON.parse(this.apiRequest.responseText);

                    console.log(response);

                    this.showError = false;
                    this.showStatus = false;
                    this.cityName = response.name;
                    this.lat = response.coord.lat;
                    this.lon = response.coord.lon;
                    this.tempK = Math.round(response.main.temp) + ' K';
                    this.tempF = this.convertKtoF(response.main.temp) + '&deg; F';
                    this.tempC = this.convertKtoC(response.main.temp) + '&deg; C';
                    this.condition = response.weather[0].description;
                    this.displayImage(this.convertKtoF(response.main.temp));
                    this.showOutput = true;

                }
                else {
                    this.showError = true;
                    this.showStatus = false;
                    this.showOutput = false;
                    this.error = '<h3 v-if="zipcode"><strong>Zipcode:</strong> ' + this.zipcode + '</h3>' + this.apiRequest.statusText;
                }

            },

            convertKtoF: function(kelvin) {
                var fahr = kelvin * (9/5) - 459.67; 
                return Math.round(fahr);
            },

            convertKtoC: function(kelvin) {
                var cel = kelvin - 273.15;
                return Math.round(cel);
            },

            displayImage: function(tempF) {

                if (tempF > 85) {
                    this.weatherImage = 'https://goo.gl/c8VxVr';
                }
                else if (tempF > 65) {
                    this.weatherImage = 'https://goo.gl/WNV85G';
                }
                else if (tempF > 32) {
                    this.weatherImage = 'https://goo.gl/KAbVwR';
                }
                else {
                    this.weatherImage = 'https://goo.gl/a4mnmd';
                }

            }

        }

    }
</script>
