
var server = "./";
function  fechahoy() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = "0" + dd;
    }
    if (mm < 10) {
        mm = "0" + mm;
    }
    let  fecha = yyyy + '-' + mm + '-' + dd;

    let h = today.getHours();
    let m = today.getMinutes();
    if (h < 10) {
        h = "0" + h;
    }
    if (m < 10) {
        m = "0" + m;
    }
    let hora = h + ':' + m;

    return fecha + "*" + hora;

}
function generarNumero(numero) {
    return (Math.random() * numero).toFixed(0);
}

function colorRGB(i) {
    var coolor = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + "," + i + ")";
    return "rgba" + coolor;
}