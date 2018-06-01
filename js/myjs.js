$( document ).ready(function() {
    $("#inicio_button").click();
   //alert("Estamos aprendiendo");
});

$("#inicio_button").on( "click", function() {
  $("#principal_page").empty();
  $("#principal_page").append(view_buscaRut());

});


$("#buscar_button" ).on( "click", function() {
  $("#principal_page").empty();
  $("#principal_page").append(view_buscaLibro());

});


$("#principal_page").on('click', '#buscarLibro', function (){
    var titulo = $("#tituloLibro").val();
    mostrarLibros(titulo);
});


$("#principal_page").on('click', '#buscarPrestamos', function (){
    var rut = $("#rutUsuario").val();
    rut = format(rut);

    if(validate(rut) == true)
    {
        mostrarPrestamos(rut);
    }
    else
    {
        alert("El rut ingresado no es válido");
        $("#rutUsuario").val(rut);
        //$("#inicio_button").click();
    }
    
});



function mostrarLibros(t)
{
  console.log(t);
	$("#principal_page").empty();
 	$("#principal_page").append(view_mostrarLibros());

  var data = {
    titulo : t
  };

  /*
  $.ajax({
        type: "POST",
        url: "../php/libro/librosDisponibles.php",
        dataType: "json",
        data,
        success : function(data){
          console.log(data);
            for (var i in data) {
            //console.log(data[i].rut);
            linea=linea.concat('<tr>'+
                        '<td>'+data[i].titulo+'</td>'+
                        '<td>'+data[i].autor+'</td>'+
                        '<td>'+data[i].edicion+'</td>'+
                        '<td>'+data[i].anio+'</td>'+
              '</tr>');
            }
            $("table#librosTable tbody").append(linea).closest("table#librosTable");
        }
  });
*/

/*
 	$.post("../php/libro/librosDisponibles.php", data, function(json) {

 		var linea="";

	    for (var i in json) {
	  		//console.log(data[i].rut);
	  		linea=linea.concat('<tr>'+
	                  '<td>'+json[i].titulo+'</td>'+
	                  '<td>'+json[i].autor+'</td>'+
	                  '<td>'+json[i].edicion+'</td>'+
	                  '<td>'+json[i].anio+'</td>'+
					'</tr>');
	  	}
	  	$("table#librosTable tbody").append(linea).closest("table#librosTable");
	}, "json");
*/
  $.post("php/libro/librosDisponibles.php",data )
    .done(function(msg){  
      var linea="";
      
      console.log(msg.mensaje);
      if(msg.mensaje=="true")
      {
          for (var i in msg.datos) {
            console.log(i);
          //console.log(data[i].rut);
          linea=linea.concat('<tr>'+
                      '<td>'+msg.datos[i].titulo+'</td>'+
                      '<td>'+msg.datos[i].autor+'</td>'+
                      '<td>'+msg.datos[i].edicion+'</td>'+
                      '<td>'+msg.datos[i].anio+'</td>'+
                      '<td>'+msg.datos[i].numeroCopias+'</td>'+
            '</tr>');
            
        }
        $("table#librosTable tbody").append(linea).closest("table#librosTable");
      }
      else
      {
          alert("El libro no esta disponible");
          $("#buscar_button").click();
      }
      
    })
    .fail(function(xhr, status, error) {
        console.log(status + error);
    });
}

function mostrarPrestamos(t)
{
    $("#principal_page").empty();
    $("#principal_page").append(view_mostrarPrestamos());

    var data = {
      rut : t
    };

    $.post("php/prestamos/prestamosActivos.php",data )
    .done(function(msg){  
      var linea="";
      
      console.log(msg.mensaje);
      if(msg.mensaje=="true")
      {
          for (var i in msg.datos) {
            console.log(i);
          //console.log(data[i].rut);
          linea=linea.concat('<tr>'+
                      '<td>'+msg.datos[i].codigoPrestamo+'</td>'+
                      '<td>'+msg.datos[i].fechaPrestamo+'</td>'+
                      '<td>'+msg.datos[i].fechaDevolucion+'</td>'+
                      '<td>'+msg.datos[i].tituloLibro+'</td>'+
                      '<td>'+msg.datos[i].codigoCopia+'</td>'+
                      '<td>'+msg.datos[i].estadoPrestamo+'</td>'+
            '</tr>');
            
        }
        $("table#prestamosTable tbody").append(linea).closest("table#prestamosTable");
      }
      else
      {
          alert("No tienes prestamos activos");
          $("#inicio_button").click();
      }
      
    })
    .fail(function(xhr, status, error) {
        console.log(status + error);
    });
}


$( "#principal_page" ).on( "click", "", function() {
  $( this ).toggleClass( "chosen" );
});

function view_buscaRut() {
	return '<div class="overlay"></div>'+
      '<div class="container">'+
        '<div class="row">'+
          '<div class="col-xl-9 mx-auto">'+
            '<h1 class="mb-5">Ingresa tu rut para saber tu estado!</h1>'+
          '</div>'+
          '<div class="col-md-10 col-lg-8 col-xl-7 mx-auto">'+
            '<form>'+
              '<div class="form-row">'+
                '<div class="col-12 col-md-9 mb-2 mb-md-0">'+
                  '<input type="Text" id="rutUsuario"class="form-control form-control-lg" placeholder="Ej. 11.111.111-1">'+
                '</div>'+
                '<div class="col-12 col-md-3">'+
                  '<button type="button" id="buscarPrestamos" class="btn btn-block btn-lg btn-primary">Consultar</button>'+
                '</div>'+
              '</div>'+
            '</form>'+
          '</div>'+
        '</div>'+
      '</div>"';
}


function view_buscaLibro() {
	return '<div class="overlay"></div>'+
      '<div class="container">'+
        '<div class="row">'+
          '<div class="col-xl-9 mx-auto">'+
            '<h1 class="mb-5">Ingresa el nombre de tu libro aqui!</h1>'+
          '</div>'+
          '<div class="col-md-10 col-lg-8 col-xl-7 mx-auto">'+
            '<form id="busquedaLibro">'+
              '<div class="form-row">'+
                '<div class="col-12 col-md-9 mb-2 mb-md-0">'+
                  '<input type="text" class="form-control form-control-lg" id="tituloLibro" placeholder="Ej. El principito">'+
                '</div>'+
                '<div class="col-12 col-md-3">'+
                  '<button type="button" id="buscarLibro" class="btn btn-block btn-lg btn-primary">Consultar</button>'+
                '</div>'+
              '</div>'+
            '</form>'+
          '</div>'+
        '</div>'+
      '</div>"';
}

function view_mostrarLibros()
{
	return '<div class="overlay"></div>'+
      '<div class="container">'+
        '<div class="card mb-3">'+
        '<div class="card-header">'+
          '<i class="fa fa-table"></i><p class="text-success">Libros disponibles</p></div>'+
        '<div class="card-body">'+
          '<div class="table-responsive">'+
            '<table class="table table-bordered table-dark" id="librosTable" width="100%" cellspacing="1">'+
              '<thead>'+
               ' <tr>'+
                  '<th>Titulo</th>'+
                  '<th>Autor</th>'+
                  '<th>Edicion</th>'+
                  '<th>Año</th>'+
                  '<th>Copias Disponibles</th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>'+
              '</tbody>'+
            '</table>'+
          '</div>'+
        '</div>'+
        '<div class="card-footer small text-muted"></div>'+
      '</div>'+
      '</div>';
}

function view_mostrarPrestamos()
{
    return '<div class="overlay"></div>'+
      '<div class="container">'+
        '<div class="card mb-3">'+
        '<div class="card-header">'+
          '<i class="fa fa-table"></i><p class="text-success">Prestamos Activos</p></div>'+
        '<div class="card-body">'+
          '<div class="table-responsive">'+
            '<table class="table table-bordered table-dark" id="prestamosTable" width="100%" cellspacing="1">'+
              '<thead>'+
               ' <tr>'+
                  '<th>Codigo Prestamo</th>'+
                  '<th>Fecha Prestamo</th>'+
                  '<th>Fecha Vencimiento</th>'+
                  '<th>Titulo Libro</th>'+
                  '<th>Codigo copia</th>'+
                  '<th>Estado Prestamo</th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>'+
              '</tbody>'+
            '</table>'+
          '</div>'+
        '</div>'+
        '<div class="card-footer small text-muted"></div>'+
      '</div>'+
      '</div>';
}