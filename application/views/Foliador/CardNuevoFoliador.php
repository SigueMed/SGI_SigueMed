<form enctype="multipart/form-data" method="post"class="form-ajax" data-url="<?= site_url(); ?>/Foliador_Controller/AgregarNuevoFoliador"
	id="form_RegistrarFoliador">


	<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script-->

<div class="row">
  <!--COL 1-->
  <div class="col-md-12">
    <!--CARD PACIENTE-->
    <div class="card my-4 shadow">
      <!--CARD HEADER-->
      <div class="card-header">
          <h4 class="card-title" id="basic-layout-form">Nuevo Foliador</h4>
          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
          <div class="heading-elements">
                  <ul class="list-inline mb-0">
                          <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                          <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                          <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                          <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                  </ul>
          </div>


      </div>

      <div class="card-body">
        <div class="card-block">
            <!--FORM BODY-->

						<!--Nuevo FOrmato-->

						<!-- <form name="userData" enctype="multipart/form-data" method="post" action="#"> -->

								<div class="row">
									<div class="col-md-6">
										<fieldset class="form-group">
											<label for="txtDescripcionFoliador">Descripción de Foliador</label>
											<input type="text" class="form-control" id="txtDescripcionFoliador" name="DescripcionFoliador" placeholder="Descripción">
										</fieldset>
									</div>
									<div class="col-md-6">
										<fieldset class="form-group">
											<label for="txtValorFolio">Valor Folio</label>
											<input type="number" class="form-control" id="txtValorFolio" name="ValorFolio" placeholder="Valor(solo numeros)">

										</fieldset>
									</div>
								</div>
								<div class="row">

								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtResponsableFolio">Responsable de Folio</label>
													<input type="text" id="txtResponsableFolio" class="form-control" placeholder="Responsable de folio" name="ResponsableFolio" value=""/>
											</div>

									</div>
									<div class="col-md-6 col-xs-12">
										<fieldset class="form-group">
											<label for="txtDireccionFolio">Dirección de Folio</label>
											<input type="text" class="form-control" id="txtDireccionFolio" name="DireccionFolio" placeholder="Dirección de Folio">
										</fieldset>
									</div>

								</div>
								<div class="row">

								</div>

								<div class="row">

									<div class="col-md-1 col-xs-12">
										<fieldset class="form-group">
											<label for="txtManejoInventario">Manejo de Inventario</label>
											<input type="checkbox" class="form-control" name="ManejoInventario">
										</fieldset>
									</div>

								</div>

								 <div class="row">
									<div class="col-md-6 col-xs-12">
										<fieldset class="form-group">
											<label for="txtTituloTicket">Titulo Ticket</label>
											<input type="text" class="form-control" id="txtTituloTicket" name="TituloTicket" placeholder="Titulo del Ticket">
										</fieldset>
									</div>
									<div class="col-md-6 col-xs-12">
											<div class="form-group">
													<label for="ImgImagenTicket">Imagen Ticket</label>
													<input type="file" class="form-control" id="ImagenTicket" name="ImagenTicket" accept="image/*">
											</div>
									</div>



							</div>




          </form>

              </div>
            </div>
            <!--FORM ACTIONS-->
             <div class="form-actions" align="right">
              <button type="submit" class="btn btn-success" name="button"><i class="icon-check2"></i> Guardar</button>

            </div>

        </div>
      </div>
    </div>
  </body>





<script type="text/javascript">

//src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">

 $(document).ready(function() {



  $(document).on('submit', '.form-ajax', function(e){
        e.preventDefault();
				//"ImagenTicket" = $_FILES(["ImagenTicket"]["name"]);

				// $uploadedFile = '';
				//     if(!empty($_FILES["ImagenTicket"]["type"])){
				//         $ImagenTicket = time().'_'.$_FILES['ImagenTicket']['name'];
				//         $valid_extensions = array("jpeg", "jpg", "png");
				//         $temporary = explode(".", $_FILES["ImagenTicket"]["name"]);
				//         $file_extension = end($temporary);
				//         if((($_FILES["hard_file"]["type"] == "image/png") || ($_FILES["ImagenTicket"]["type"] == "image/jpg") || ($_FILES["ImagenTicket"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
				//             $sourcePath = $_FILES['file']['tmp_name'];
				//             $targetPath = "uploads/".$fileName;
				//             if(move_uploaded_file($sourcePath,$targetPath)){
				//                 $uploadedFile = $ImagenTicket;
				//             }
				//         }
				//       }


				//
				// if ($_FILES["ImagenTicket"]["error"]>0) {
	      //   echo "Error al cargar achivo";
	      //   // code...
	      // }
	      // else {
	      //   $permitidos = array("image/png","image/jpg");
	      //   $limite_kb = 200;
	      //   if(in_array($_FILES["ImagenTicket"]["type"], $permitidos) && $_FILES["ImagenTicket"]["size"] <=  $limite_kb * 1024){
	      //         $Ruta = 'files/Foliadores/'.$IdNuevoFoliador;
	      //         $Archivo = $Ruta.$_FILES["ImagenTicket"]["name"];
	      //         if(!file_exists($Ruta)){
	      //           mkdir($Ruta);
	      //         }
	      //         if(!file_exists($Archivo)){
	      //           $resultado = @move_uploaded_file($_FILES["ImagenTicket"]["tmp_name"],
	      //           $Archivo);
				//
	      //           if ($resultado) {
	      //             echo "Archivo Guardado";
	      //             // code...
	      //           }
	      //           else {
	      //             echo "Error al Guardar el Archivo";
	      //             // code...
	      //           }
				//
	      //         }
	      //         else {
	      //           echo "El achivo ya existe";
	      //           // code...
	      //         }
	      //   }
	      //   else {
	      //     echo "Archivo no permitido o exceso el tamano";
	      //     // code...
	      //   }
	      //   // code...
	      // }



				//


				// Los posible valores que puedes obtener de la imagen son:

// echo "<BR>".$_FILES["ImagenTicket"]["name"];      //nombre del archivo
//
// echo "<BR>".$_FILES["ImagenTicket"]["type"];      //tipo
//
// echo "<BR>".$_FILES["ImagenTicket"]["tmp_name"];  //nombre del archivo de la imagen temporal
//
// echo "<BR>".$_FILES["ImagenTicket"]["size"];      //tamaño
//
//
//
// # Comprobamos que se haya subido un fichero
//
// if (is_uploaded_file($_FILES["ImagenTicket"]["tmp_name"]))
//
// {
//
//     # verificamos el formato de la imagen
//
//     if ($_FILES["ImagenTicket"]["type"]=="image/jpeg" || $_FILES["userfile"]["type"]=="image/pjpeg" || $_FILES["userfile"]["type"]=="image/gif" || $_FILES["userfile"]["type"]=="image/bmp" || $_FILES["userfile"]["type"]=="image/png")
//
//     {
//
//         # Cogemos la anchura y altura de la imagen
//
//         $info=getimagesize($_FILES["userfile"]["tmp_name"]);
//
//         //echo "<BR>".$info[0]; //anchura
//
//         //echo "<BR>".$info[1]; //altura
//
//         //echo "<BR>".$info[2]; //1-GIF, 2-JPG, 3-PNG
//
//         //echo "<BR>".$info[3]; //cadena de texto para el tag <img
//
//
//
//         # Escapa caracteres especiales
//
//         $imagenEscapes=$mysqli->real_escape_string(file_get_contents($_FILES["userfile"]["tmp_name"]));
//
//     }
//
// }
				//"ImagenTicket" = .$_FILES['ImagenTicket']['name'];

        var $this = $(this);

        var data = $this.serialize();

        var action = document.activeElement.getAttribute('value');

        var url = $this.data('url');



          $.post(url, data).then(function(res){
            var a = JSON.parse(res);

              if (a.error) {
                  Swal.fire('Error', a.message, 'error');
              } else {
                  Swal.fire('Éxito', a.message, 'success');
										$(".form-ajax")[0].reset();
              }
          }).fail(function(){
              Swal.fire('Error', 'Error al conectarse con el servidor', 'error');
          });



        e.preventDefault();

    });

});

//file type validation


    $("#ImagenTicket").change(function() {
        var file = this.files[0];
				//var namefile = file.tmp_name;
				//echo namefile;
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Por favor selecione una imagen valida (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });


</script>
