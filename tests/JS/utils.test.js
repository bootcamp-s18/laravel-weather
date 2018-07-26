var assert = require('assert');
var utils = require('../../resources/assets/js/utils.js');
var convertKtoF = utils.convertKtoF;
var convertKtoC = utils.convertKtoC;

describe("convertKtoF function", function() {

    describe("converts from kelvin to fahrenheit", function() {

        it ("the lowest temperature recorded on earth", function() {
            assert.equal(convertKtoF(184), -128);
        });

        it ("the freezing point of water", function() {
            assert.equal(convertKtoF(273.15), 32);
        });

        it ("the average surface temperature on earth", function() {
            assert.equal(convertKtoF(288), 59);
        });

        it ("the highest temperature recorded on earth", function() {
            assert.equal(convertKtoF(331), 136);
        });
    });
});

describe("convertKtoC function", function() {

    describe("converts from kelvin to celsius", function() {

        it ("the lowest temperature recorded on earth", function() {
            assert.equal(convertKtoC(184), -89);
        });

        it ("the freezing point of water", function() {
            assert.equal(convertKtoC(273.15), 0);
        });

        it ("the average surface temperature on earth", function() {
            assert.equal(convertKtoC(288), 15);
        });

        it ("the highest temperature recorded on earth", function() {
            assert.equal(convertKtoC(331), 58);
        });
    });
});
