var factor_recuperacion = $('#fact_recup').val();
var porosidad = $('#porosidad').val();
var sw = $('#sw').val(); // Saturacio
var bg = $('#bg').val();  // Beta sub G
var h = $('#h').val(); // Espesor entre capa y capa
var suma_total = 0.0;

var bg_formula = $('#bg_formula').val(); // (ft3/scf) = 0   OR    (scf/ft3) = 1

var acres = [81.92, 67.50, 54.88, 43.94, 34.56, 26.62, 20.00, 14.58, 10.24, 6.86, 4.32, 2.50, 1.28, 0.54, 0.16, 0.02, 0.02];
var acres2 = [80, 90.50, 50.88, 45.94, 30.56, 20.62, 28.00, 14.58, 12.24, 6.86, 7.32, 2.50, 1.28, 0.54, 0.16, 0.02, 0.00];

var cont = 1;
var capas = [];
//var acres = [];
var areas = [];
var volumenBruto = [];


function cargardatos() {
  capas = [];
  suma_total = 0.0;
  areas = [];
  volumenBruto = [];
  factor_recuperacion = $('#fact_recup').val();
  porosidad = $('#porosidad').val();
  sw = $('#sw').val(); // Saturacio
  bg = $('#bg').val();  // Beta sub G
  h = $('#h').val();
  $('#_TABLA_R').html('');
  $('#_TABLA_R').html('<tr><th>Capa</th><th>Acres</th><th>Areas</th><th>Volumen Bruto</th></tr>');
  calcularRelacionDeAreas();
  calcularVolumenBrutoLista();
  sumaVolumenBruto();
  reservaGas();

  for (var i = 0; i < acres.length; i++) {
    capas.push(i + 1);
    if (i > 0) {
      $('#_TABLA_R').append('<tr><td>'+ (i + 1) +'</td><td>'+ acres[i] +'</td><td>'+ areas[i] +'</td><td>'+ volumenBruto[i - 1] + '</td></tr>');
    } else {
      $('#_TABLA_R').append('<tr><td>'+ (i + 1) +'</td><td>'+ acres[i] +'</td><td>'+ 0 +'</td><td>0</td></tr>');
    }
  }

}

function nuevoAcres() {

  n = $('#_acres').val();
  acres.push(n);
  calcular();
}

function reservaNeta(r) {
  $('#_neto').html('Reserva de Gas NETO ' + (r * factor_recuperacion));
}

function reservaGas() {
  switch (bg_formula) {
    case '0':
      formulaEstandar();
      break;
    case '1':
      formulaInversa();
      break;
    default:
      break;
  }

}

function formulaEstandar() {
  var r = 43560 * suma_total * porosidad * (1 - sw) * bg;
  $('#_suma').html('Reserva de Gas ' + r);
  reservaNeta(r);
}

function formulaInversa() {
  var r = (43560 * suma_total * porosidad * (1 - sw)) / bg;
  $('#_suma').html('Reserva de Gas ' + r);
  reservaNeta(r);
}

function calcularRelacionDeAreas() { // superior sobre inferior, capa 2 / capa 1
  areas[0] = 0;
  for (var i = 0; i < acres.length - 1; i++) {
    areas.push((acres[i + 1] / acres[i]).toFixed(2));
  }
}


function calcularVolumenBrutoLista(){
  for (var i = 0; i < acres.length - 1; i++) {
    if ((acres[i + 1] / acres[i]).toFixed(2) > 0.5) {
      trapesoidad(acres[i], acres[i + 1]);
    } else {
      piramidal(acres[i], acres[i + 1]);
    }
  }
}

function sumaVolumenBruto() {
  var suma = 0.0;
  for (var i = 0; i < volumenBruto.length; i++) {
    suma = suma + parseFloat(volumenBruto[i]);
  }
  suma_total = suma;
  $('#_suma_volumenB').html('Suma Volumen Bruto:' + suma_total);
}

function trapesoidad(a, b) { // Se aplica cuando es > que 0.5
  volumenBruto.push(((h/2) * (a + b)).toFixed(2));
}

function piramidal(a, b) { // Se aplica cuando es <= que 0.5
  volumenBruto.push(((h/3) * (a + b + Math.sqrt(a * b)).toFixed(2)));
}

function mostrar() {
  for (var i = 0; i < areas.length; i++) {
    document.writeln(areas[i] + '<br />')
  }
  document.writeln('<br />');
  document.writeln('<br />');

  for (var i = 0; i < volumenBruto.length; i++) {
    document.writeln(volumenBruto[i] + '<br />')
  }
  document.writeln('<br />');
  document.writeln('<br />');

}
