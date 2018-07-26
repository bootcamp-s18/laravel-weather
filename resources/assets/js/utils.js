
module.exports.convertKtoF = function convertKtoF(kelvin) {
    if (typeof kelvin == "undefined" || kelvin === null) {
        throw new TypeError("argument must be a number");
    }
    var fahr = kelvin * (9/5) - 459.67;
    return Math.round(fahr);
}

module.exports.convertKtoC = function convertKtoC(kelvin) {
    if (typeof kelvin == "undefined" || kelvin === null) {
        throw new TypeError("argument must be a number");
    }
    var cel = kelvin - 273.15;
    return Math.round(cel);
}
