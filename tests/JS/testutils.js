
export function MockXHR() {
    this.onload = null;
    this.onerror = null;
};

MockXHR.prototype.open = function(method, url, sync) {
    // no-op
};

MockXHR.prototype.send = function() {
    setTimeout(() => {
        this.statusText = "OK";
        this.responseText = '{"coord":{"lon":-84.58,"lat":38},"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01d"}],"base":"stations","main":{"temp":298.77,"pressure":1018,"humidity":57,"temp_min":298.15,"temp_max":300.15},"visibility":16093,"wind":{"speed":2.6,"deg":270},"clouds":{"all":1},"dt":1532615700,"sys":{"type":1,"id":1129,"message":0.0038,"country":"US","sunrise":1532601411,"sunset":1532652741},"id":420013437,"name":"Lexington","cod":200}';
        if (this.onload) {
            this.onload();
        }

        if (MockXHR.finish) {
            MockXHR.finish();
        }
    });
};

export const mockGeolocation = {
    getCurrentPosition: function(onAble, onDenied) {
        setTimeout(function() {
            onAble({ coords: { latitude: 38.0419443, longitude: -84.4927282 } });
        });
    }
};
