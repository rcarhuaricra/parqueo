$(document).ready(function () {
    $("select").select2();
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



$('#table').DataTable({
    "paging": true,
    "ordering": true,
    "order": [[3, "desc"]],
    "info": true,
    "searching": true,
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
    //"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]

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