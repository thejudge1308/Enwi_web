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
                  '<input type="Text" class="form-control form-control-lg" placeholder="Ej. 1.111.111-1">'+
                '</div>'+
                '<div class="col-12 col-md-3">'+
                  '<button type="submit" class="btn btn-block btn-lg btn-primary">Consultar</button>'+
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
            '<form>'+
              '<div class="form-row">'+
                '<div class="col-12 col-md-9 mb-2 mb-md-0">'+
                  '<input type="Text" class="form-control form-control-lg" placeholder="Ej. El principito">'+
                '</div>'+
                '<div class="col-12 col-md-3">'+
                  '<button type="submit" class="btn btn-block btn-lg btn-primary">Consultar</button>'+
                '</div>'+
              '</div>'+
            '</form>'+
          '</div>'+
        '</div>'+
      '</div>"';
}