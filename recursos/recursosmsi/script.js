$(document).ready(function () {
    $(".selectBuscar").select2();
});

/* VALIDAR SOLO NUMEROS  */
$('.solo-numero').keyup(function () {
    this.value = (this.value + '').replace(/[^0-9]/g, '');
});
/* VALIDAR SOLO TEXTO */
$('.solo-texto').keyup(function () {
    this.value = (this.value + '').replace(/[^ a-záéíóúüñ]+/ig, '');
});
/* VALIDAR TEXTO SIN CARACTERES DESCOCNOCIDOS */
$('.texto-limpio').keyup(function () {
    this.value = (this.value + '').replace(/[^ a-z0-9áéíóúüñ#º()]+/ig, '');
});

/* VALIDAR TEXTO SIN CARACTERES DESCOCNOCIDOS */
$('.texto-placa').keyup(function () {
    this.value = (this.value + '').replace(/[^a-z0-9-]+/ig, '');
});





$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    language: 'es',
    startDate: '1d'
}).datepicker("setDate", new Date());


function newUser(nombre, apellido) {
    var nom = nombre.split(" ");
    var res = nom[0].concat(apellido);
    return res;
}


function limpiaCadena(cadena) {
    // Definimos los caracteres que queremos eliminar
    var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";

    // Los eliminamos todos
    for (var i = 0; i < specialChars.length; i++) {
        cadena = cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
    }

    // Lo queremos devolver limpio en minusculas
    cadena = cadena.toLowerCase();

    // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
    cadena = cadena.replace(/ /g, "_");

    // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
    cadena = cadena.replace(/á/gi, "a");
    cadena = cadena.replace(/é/gi, "e");
    cadena = cadena.replace(/í/gi, "i");
    cadena = cadena.replace(/ó/gi, "o");
    cadena = cadena.replace(/ú/gi, "u");
    cadena = cadena.replace(/ñ/gi, "n");
    return cadena;
}

function ok() {
    alert('se creo');
}