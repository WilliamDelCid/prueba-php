function crearReloj(){
    var ahora = new Date();
    var h = ahora.getHours();
    var m = ahora.getMinutes();
    var s = ahora.getSeconds();
    var ampm = '';

    if (h >= 12) {
        h = h - 12;
        ampm = 'PM';
    } else {
        ampm = 'AM';
    }


    m=corregirHora(m);
    s=corregirHora(s);
    document.getElementById('reloj').innerHTML = h + ":" + m + ":" + s + "  " + ampm + " ";
    var t= setTimeout(function () { crearReloj() }, 1000);
}

function corregirHora(i){
    if (i < 10) {
        i = "0" + i
    };
    return i;
}