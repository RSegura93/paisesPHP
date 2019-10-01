<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var paises = <?php 
			echo (json_encode($paises) );
		?>;
		var basepath = ('<?php
					// echo str_replace("\\", "/",BASEPATH);
					echo $this->config->base_url();
				?>');
		function fillTable(paises){
			var table = $("#listado_paises");
			var tbody = table.find("tbody");
			for (var i = 0; i < paises.length; i++) {
				var pais = paises[i];
				var stringnuevaFila =
					"<tr class='" + pais.id + "'>"+
					"<td colspan='1'>" + pais.id + "</td>"+
					"<td colspan='4'>" + pais.name + "</td>"+
					"<td colspan='1'>" + ((pais.checked == 1) ? "Sí": "No") + "</td>"+
					"<td colspan='2'></td>"+
				"</tr>";
				var nuevafila = $(stringnuevaFila);
				tbody.append(nuevafila);
				var botonEditar = $("<button  type='button' class='editar btn btn-warning' code='" + pais.id + "'>Editar</button>");
				var botonEliminar = $("<button  type='button'  class='eliminar btn btn-danger' code='" + pais.id + "'>Eliminar</button>");
				nuevafila.find("td:last-child").append(botonEditar);
				nuevafila.find("td:last-child").append(botonEliminar);
			}
		}
		function createCountry(){
			var formAgregar = $(".formAgregar");
			$("button#createCountry").click(function(){
				var formData = {
					'name': formAgregar.find("input[name='name']").val(),
					'checked': ( formAgregar.find("input[name='checked']").is(':checked') ) ? 1 : 0
				}
				// console.log(formData);
				$.ajax({
				    url : basepath+"index.php/Home/createCountry",
				    type: "POST",
				    data : formData,
				    // dataType: "json",
				    success: function(data, textStatus, jqXHR)
				    {
						location.reload();
				    },
				    error: function (jqXHR, textStatus, errorThrown)
				    {
				 
				    }
				});
			});
		}
		function eventHandlerDelete(){
			var formEditar = $(".formEditar");
			var formAgregar = $(".formAgregar");
			$("button.editar").click(function(){
				var self = $(this);
				var id = self.attr("code");
				var pais = paises.find((o) => { return o.id === id });
				formAgregar.addClass("hidden");
				formEditar.find("input[name='name']").val(pais.name);
				formEditar.find("input[name='cheked']").val(pais.checked);
				formEditar.removeClass("hidden");
				formEditar.attr("idModifying",id);
			});
			$("#undo").click(function (argument) {
				formAgregar.addClass("hidden");
				formEditar.find("input[name='name']").val();
				formEditar.find("input[name='cheked']").val();
				formEditar.addClass("hidden");
				formEditar.attr("idModifying","");
				formAgregar.removeClass("hidden");

			});
			$("#saveModifications").click(function (argument) {
				var formData = {
					'id': formEditar.attr("idModifying"),
					'name': formEditar.find("input[name='name']").val(),
					'checked': ( formEditar.find("input[name='checked']").is(':checked') ) ? 1 : 0
				};
				console.log(formData);
				$.ajax({
				// console.log(formData);
					   url : basepath+"index.php/Home/updateCountry",
					   type: "POST",
					   data : formData,
					   success: function(data, textStatus, jqXHR)
					   {
							location.reload();
					   },
					   error: function (jqXHR, textStatus, errorThrown)
					   {
					
					   }
				});	
			});	

			$("button.eliminar").click(function(){
				var self = $(this);
				var id = self.attr("code");
				var formData = paises.find((o) => { return o.id === id });
				// console.log(formData);
				$.ajax({
				    url : basepath+"index.php/Home/deleteCountry",
				    type: "POST",
				    data : formData,
				    success: function(data, textStatus, jqXHR)
				    {
				        self.parent().parent().remove();
				    },
				    error: function (jqXHR, textStatus, errorThrown)
				    {
				 
				    }
				});
			})
		}
		window.onload=function(){
			fillTable(paises);
			eventHandlerDelete();
			createCountry();
		}
	</script>
	<style type="text/css">
		*{
			color: #1C6EA4;
		}
		button.btn + button.btn{
			margin-left:15px;
		}
		button.btn {
			font-size: 18px;
			font-weight: bold;
		}
		table.blueTable {
		  border: 1px solid #1C6EA4;
		  background-color: #EEEEEE;
		  width: auto;
		  max-width: 600px;
		  text-align: left;
		  border-collapse: collapse;
		}
		table.blueTable td, table.blueTable th {
		  border: 1px solid #AAAAAA;
		  padding: 3px 2px;
		}
		table.blueTable tbody td {
		  font-size: 18px;
		  font-weight: 600;
		}
		table.blueTable tbody td, 
		table.blueTable thead th {
			padding-left: 10px;
			padding-right: 10px;
			padding-top:3px;
			padding-bottom:3px;
		}

		table.blueTable tr:nth-child(even) {
		  background: #D0E4F5;
		}
		table.blueTable thead {
		  background: #1C6EA4;
		  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
		  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
		  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
		  border-bottom: 2px solid #444444;
		}
		table.blueTable thead th {
		  font-size: 15px;
		  font-weight: bold;
		  color: #FFFFFF;
		  border-left: 2px solid #D0E4F5;
		}
		table.blueTable thead th:first-child {
		  border-left: none;
		}

		table.blueTable tfoot {
		  font-size: 14px;
		  font-weight: bold;
		  color: #FFFFFF;
		  background: #D0E4F5;
		  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
		  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
		  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
		  border-top: 2px solid #444444;
		}
		table.blueTable tfoot td {
		  font-size: 14px;
		}
		table.blueTable tfoot .links {
		  text-align: right;
		}
		table.blueTable tfoot .links a{
		  display: inline-block;
		  background: #1C6EA4;
		  color: #FFFFFF;
		  padding: 2px 8px;
		  border-radius: 5px;
		}
		.hidden {
			display: none;
		}
	</style>
</head>
<body>
	<div>
		Los archivos se encuentran en:
		<ul>
			<li><a href="<?php echo $this->config->base_url()."application/views/listado_paises.php";?>">View o Vista</a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
		</ul>
	</div>
	<div id="container">
		<section class="formAgregar">
			<h2>Agregar país</h2>
			<p>Nombre País:
			<input name="name" size=35 placeholder="Ingrese el nombre del País"/></p>
			<p>Interesado:
			<input type="checkbox" name="checked" checked></p>
			<button type="button" class="btn btn-primary" id="createCountry" >Agregar País</button>
		</section>

		<section class="formEditar hidden">
			<h2>Edición de país</h2>
			<p>Nombre País:
			<input name="name" size=35 placeholder="Ingrese el nombre del País"/></p>
			<p>Interesado:
			<input type="checkbox" name="checked" checked></p>
			<button type="button" class="btn btn-warning"id="saveModifications" >Guardar Modificación</button>
			<button type="button" class="btn btn-light" id="undo" >No guardar</button>
		</section>
		<hr>
		<h2>Listado de paises</h2>
		<table id="listado_paises" class="blueTable">
			<thead>
				<th colspan='1'>Id</th>
				<th colspan='4'>Name</th>
				<th colspan='1'>Interesado</th>
				<th colspan='2'>Acciones</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</body>
</html>
