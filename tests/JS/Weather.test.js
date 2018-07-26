import 'chai/register-should';
import { mount } from '@vue/test-utils'
import { createGeolocationMock, MockXHR } from './testutils';

import Weather from '../../resources/assets/js/components/Weather.vue';

describe("The Weather component", function() {

    // Vue-test-utils rendered component
    var wrapper;

    // mock out XHR so we control API calls
    before(function() {
        window.XMLHttpRequest = XMLHttpRequest = MockXHR;
    });

    describe("renders", function() {

        // mock out geolocation so component renders correctly (jsdom doesn't provide it)
        beforeEach(function(done) {
            window.navigator.geolocation = createGeolocationMock({ latitude: 38.0419443, longitude: -84.4927282 });
            window.XMLHttpRequest.finish = done;
            wrapper = mount(Weather);
        });

        it("latitude and longitude after retrieving current location", function(done) {
            wrapper.vm.$nextTick(function() {
                wrapper.html().should.contain("<strong>Latitude:</strong> 38");
                wrapper.html().should.contain("<strong>Longitude:</strong> -84.58");
                done();
            });
        });

        // TODO: write more tests for different things we expect in the rendered component
    });

    describe("API responses", function() {

        it("good API response", function(done) {
            window.navigator.geolocation = createGeolocationMock({ latitude: 38.0419443, longitude: -84.4927282 });
            window.XMLHttpRequest.finish = function() {
                wrapper.vm.$nextTick(function() {
                    wrapper.contains('.status-section').should.be.false;
                    wrapper.contains('.error-section').should.be.false;
                    wrapper.contains('.output-section').should.be.true;
                    done();
                });
            };
            wrapper = mount(Weather);
        });

        it("bad API response", function(done) {
            window.navigator.geolocation = createGeolocationMock({ latitude: "oreos", longitude: "milk" });
            window.XMLHttpRequest.finish = function() {
                wrapper.vm.$nextTick(function() {
                    wrapper.contains('.status-section').should.be.false;
                    wrapper.contains('.error-section').should.be.true;
                    wrapper.contains('.output-section').should.be.false;
                    done();
                });
            };
            wrapper = mount(Weather);
        });

        it("error from API response", function(done) {
            window.navigator.geolocation = createGeolocationMock({});
            window.XMLHttpRequest.finish = function() {
                wrapper.vm.$nextTick(function() {
                    wrapper.contains('.status-section').should.be.true;
                    wrapper.contains('.error-section').should.be.false;
                    wrapper.contains('.output-section').should.be.false;
                    done();
                });
            };
            wrapper = mount(Weather, {
                propsData: {
                  zipcode: "40513"
                }
            });
        });
    });
});
