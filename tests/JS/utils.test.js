var chai = require('chai');

var utils = require('../../resources/assets/js/utils.js');
var convertKtoF = utils.convertKtoF;
var convertKtoC = utils.convertKtoC;

chai.should();

describe("convertKtoF function", function() {

    describe("converts from kelvin to fahrenheit", function() {

        it ("the lowest temperature recorded on earth", function() {
            convertKtoF(184).should.equal(-128);
        });

        it ("the freezing point of water", function() {
            convertKtoF(273.15).should.equal(32);
        });

        it ("the average surface temperature on earth", function() {
            convertKtoF(288).should.equal(59);
        });

        it ("the highest temperature recorded on earth", function() {
            convertKtoF(331).should.equal(136);
        });
    });

    it ("throws TypeError when passed null or undefined", function() {
        (function() { convertKtoF(null); }).should.throw(TypeError);
        (function() { convertKtoF(); }).should.throw(TypeError);
    });

    it ("converts string arguments to numbers", function() {
        convertKtoF("184").should.equal(-128);
    });
});

describe("convertKtoC function", function() {

    describe("converts from kelvin to celsius", function() {

        it ("the lowest temperature recorded on earth", function() {
            convertKtoC(184).should.equal(-89);
        });

        it ("the freezing point of water", function() {
            convertKtoC(273.15).should.equal(0);
        });

        it ("the average surface temperature on earth", function() {
            convertKtoC(288).should.equal(15);
        });

        it ("the highest temperature recorded on earth", function() {
            convertKtoC(331).should.equal(58);
        });
    });

    it ("throws TypeError when passed null or undefined", function() {
        (function() { convertKtoC(null); }).should.throw(TypeError);
        (function() { convertKtoC(); }).should.throw(TypeError);
    });

    it ("converts string arguments to numbers", function() {
        convertKtoC("184").should.equal(-89);
    });
});
