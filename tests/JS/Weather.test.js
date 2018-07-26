import 'chai/register-should';
import { mount } from '@vue/test-utils'
import { mockGeolocation, MockXHR } from './testutils';

import Weather from '../../resources/assets/js/components/Weather.vue';

describe("The Weather component", function() {

    var wrapper;

    before(function() {
        window.navigator.geolocation = mockGeolocation;
        window.XMLHttpRequest = XMLHttpRequest = MockXHR;
    });

    beforeEach(function(done) {
        window.XMLHttpRequest.finish = done;
        wrapper = mount(Weather);
    });

    it("Renders latitude and longitude after retrieving current location", function(done) {
        wrapper.vm.$nextTick(function() {
            wrapper.html().should.contain("<strong>Latitude:</strong> 38");
            wrapper.html().should.contain("<strong>Longitude:</strong> -84.58");
            done();
        });
    });
});
