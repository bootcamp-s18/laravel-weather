
export function MockXHR() {
    this.onload = null;
    this.onerror = null;
};

MockXHR.prototype.open = function(method, url, sync) {
    this.method = method;
    this.url = url;
};

MockXHR.prototype.send = function() {
    setTimeout(() => {
        if (this.url.match(/\?lat=[\d\.-]+&lon=[\d\.-]+/)) {
            this.statusText = "OK";
            this.responseText = '{"coord":{"lon":-84.58,"lat":38},"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01d"}],"base":"stations","main":{"temp":298.77,"pressure":1018,"humidity":57,"temp_min":298.15,"temp_max":300.15},"visibility":16093,"wind":{"speed":2.6,"deg":270},"clouds":{"all":1},"dt":1532615700,"sys":{"type":1,"id":1129,"message":0.0038,"country":"US","sunrise":1532601411,"sunset":1532652741},"id":420013437,"name":"Lexington","cod":200}';
            if (this.onload) {
                this.onload();
            }
        } else if (this.url.match(/\?lat=[\w\.-]+&lon=[\w\.-]+/)) {
            this.statusText = "NOT FOUND";
            this.responseText = '{"cod":"404","message":"city not found"}';
            if (this.onload) {
                this.onload();
            }
        } else {
            this.statusText = "";
            this.responseText = "";
            if (this.onerror) {
                this.onerror();
            }
        }

        if (MockXHR.finish) {
            MockXHR.finish();
        }
    });
};

// pass in an object with properties "latitude" and "longitude"
export function createGeolocationMock(location, deny) {
    var response = { coords: location };
    return {
        getCurrentPosition: function(onAble, onDenied) {
            setTimeout(function() {
                if (deny) {
                    onDenied();
                } else {
                    onAble(response);
                }
            });
        }
    };
}
