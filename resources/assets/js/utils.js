
module.exports.convertKtoF = function convertKtoF(kelvin) {
    var fahr = kelvin * (9/5) - 459.67;
    return Math.round(fahr);
}

module.exports.convertKtoC = function convertKtoC(kelvin) {
    var cel = kelvin - 273.15;
    return Math.round(cel);
}
