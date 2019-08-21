<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="bootstrap/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="maskmoney/dist/jquery.maskMoney.js"></script>
	<script type="text/javascript" src="datatable/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="datatable/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="datatable/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="datatable/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
		@font-face{
			font-family: GothamBook;
			src: url(bootstrap/css/GothamBook.ttf);
		}
		*{
			box-sizing: border-box;
			outline: 0!important;
			font-family: GothamBook;
			padding-left: 10px;
			padding-right: 10px;
			color: #565656;
		}
		.tamanio_card{
			width: 360px;
			margin: auto;
			margin-top: 40px; 
		}
		.titulo{
			text-align: center;						
			font-weight: 100;
			font-size: 26px;
			display: block;
		    margin-block-start: 1.33em;
		    margin-inline-start: 0px;
		    margin-inline-end: 0px;
		}
		p{
			display: block;
		    text-align: justify;
		    font-size: 14px;
		    margin-top: 16px;
		    margin-bottom: 16px;
		    padding: 0;
		    line-height: 1;
		}
		.input-form{
			border-style: solid;
			border-color: #c1c1c1;
			border-width: 1px;
			margin-top: 5px;
			margin-bottom: 5px;
			
		}
		.input-border{
			border: 0;
			width: 100%;
			padding: 0;
			margin: 0;
			text-align: right;
		}
		.label-form{
			border: 0;
			margin: 0;
			padding: 0;
			font-size: 13px;
		}
		button{
			margin-right: 14px !important;
			margin-left: 14px;
			width: 91%;
			background-color: #ea5a0b !important;
			border-color: #ea5a0b !important;
			margin-top: 10px;
		}
		select{
			border: 0;
			display: block;
			margin: 0;
			padding: 0;
			width: 100%;
			float: right !important;
			text-align-last: right;		
		}
		.aviso_error{
			padding: 0;
			font-size: 12px;
			text-align: left;
			color: #b94a4a;
			display: none;
		}
		.tablecri{
			margin-top: 50px;
		}
		.tablecri tr:not(:first-of-type):hover{
			color: #212529;
  			background-color: rgba(0, 0, 0, 0.075);
		}
		.tablecri thead>tr{
		 	background-color: #676767;
		 	border-color: #676767;
		 	font-size: .9em;
		}
		.tablecri thead>tr>th{
		 	font-size: .9em;
		}
		.tablecri thead>tr>th{
			color: #FFFFFF !important;
		}
		.tablecri tr>td{
			font-size: .8em;
		}
		.tablecri tr:nth-child(even) {
		  background-color: #f2f2f2;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="card tamanio_card">
		  <div class="card-body">
		    <h4 class="titulo">Calcula tu crédito hipotecario</h4>
		    <p>Ingresa los datos del inmueble que estás buscando</p>
		    <form id="formulario_calculadora">
		    	<div style=";margin: 0;" class="custom-control custom-radio custom-control-inline">
				  <input value="soles" type="radio" id="customRadioInline1" name="moneda" class="custom-control-input">
				  <label style="padding: 0;" class="custom-control-label" for="customRadioInline1">S/ Soles</label>
				</div>
				<div style="float: right;margin: 0;padding: 0;" class="custom-control custom-radio custom-control-inline">
				  <input value="dolares" checked="checked" type="radio" id="customRadioInline2" name="moneda" class="custom-control-input">
				  <label style="padding: 0;" class="custom-control-label" for="customRadioInline2">US$ Dólares</label>
				</div>
				<div class="input-form">
					<label class="label-form">Valor del inmueble</label>
					<input id="valor_inmueble" class="input-border" type="" name="" data-thousands="." data-prefix="$" data-precision="0">
					<div id="show_valor_inmueble" class="aviso_error">Campo requerido</div>
				</div>
				<div class="input-form">
					<label class="label-form">Cuota Inicial</label>
					<input id="cuota_inicial" class="input-border" type="" name="" data-thousands="." data-prefix="$" data-precision="0">
					<div id="show_cuota_inicial" class="aviso_error">Campo requerido</div>
				</div>
				<div style="padding-bottom: 20px;" class="input-form">
					<label class="label-form" for="exampleFormControlSelect1">Cantidad de años a pagar</label>
				    <select id="select_anios">
				      <option value="10">10 años</option>
				      <option value="15">15 años</option>
				      <option value="20">20 años</option>
				      <option value="25">25 años</option>
				      <option value="30">30 años</option>
				    </select>
				</div>
				<div class="input-form">
					<label class="label-form">Tasa de interés anual</label>
					<input id="tasa_anual" class="input-border" type="" name="">
					<div id="show_tasa_interes" class="aviso_error">Campo requerido</div>
				</div>
		    </form>
			<button id="calcular" class="btn btn-primary">Calcular</button>
			<p style="text-align: center">El resultado es solo a fines referenciales y puede no coincidir con la realidad.</p>
		  </div>
		</div>

		

		<div id="tabla_datos">
			
		</div>
	</div>

	 <script> 
	 $(document).ready(function(){  
	 	var e = new Date();
	 	var mes = e.getMonth();

	 	var a = new Date();
	 	var anio = a.getFullYear();

	 	var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

	  	$('#example').DataTable();  	
	    $("#valor_inmueble").maskMoney();
	    $("#cuota_inicial").maskMoney(); 
	    $("#tasa_anual").maskMoney({thousands:'', decimal:'.', allowZero:true, suffix: ' %', precision:'0'});

	    $('input[type=radio][name=moneda]').change(function() {
		    if (this.value == 'soles') {
		        alert("Soles");
		    }
		    else if (this.value == 'dolares') {
		        alert("Dolares");
		    }
		});

	    $("#calcular").click(function(){
            $("#example").remove();

	    	var tipo_moneda = $('input:radio[name=moneda]:checked').val();
	    	var valor_inmueble = $('#valor_inmueble').val().replace("$", "");
	    	valor_inmueble = valor_inmueble.split(".").join("");
	    	var cuota_inicial = $('#cuota_inicial').val().replace("$", "");
	    	cuota_inicial = cuota_inicial.split(".").join("");
	    	//var anio_pagar = $('#select_anios').val();
	    	 var anio_pagar = $("#select_anios option:selected").val();
	    	 var tasa_anual = $("#tasa_anual").val().replace(" %", "");
	    	 tasa_anual = tasa_anual.replace(".", "");
	    	//console.log(tipo_moneda + " " + valor_inmueble + " " + cuota_inicial + " " + anio_pagar+ " " + tasa_anual);
	    	if (valor_inmueble == "") {	    			
			$("#show_valor_inmueble").show();
	    	}
	    	if (cuota_inicial == "") {
	    	$("#show_cuota_inicial").show();
	    	}
	    	if (tasa_anual == "") {
	    	$("#show_tasa_interes").show();
	    	}
	    	//console.log(cuota_inicial+ "Hola");
	    	if (valor_inmueble != "" & cuota_inicial != "" & tasa_anual != "") {
	    		
	    		if (tasa_anual != 0) {
	    			if (parseInt(cuota_inicial) < parseInt(valor_inmueble)) {
	    				if (tasa_anual >= 5 & tasa_anual <= 20) {
	    					//console.log("Validado todoooo" );
	    					$("#show_cuota_inicial").hide();

	    					var altoDocumento = $(document).height();
	    					//var anchoPantalla = $(window).height();

	    					console.log("Alto Documento" + altoDocumento);

	    					 $("html, body").animate({ scrollTop: $(document).height() }, 1000);

	    					//$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
	    					//
	    					//Restar La Cuota Inicial
	    					valor_inmueble = valor_inmueble - cuota_inicial;

	    					//Operaciones Matematicas
	    					tasa_anual = (tasa_anual/100)/12;

	    					var m = (valor_inmueble * tasa_anual * (Math.pow((1 + tasa_anual),(anio_pagar * 12))))/((Math.pow((1 + tasa_anual),(anio_pagar * 12))) -1);
	    					//hayar_coma_valor_inmueble = m.indexOf(".");
	    					m = m.toFixed(2);

	    					var totalint = totalint + (valor_inmueble * tasa_anual);
                            

                            var tabla = $("<table></table>");
                                tabla.attr({
                                    id: 'example'
                                });
                            tabla.addClass('table table-striped tablecri');
                            //
                            //var th = "<thead><tr><th>Name</th><th>Position</th><th>Office</th><th>Age</th><th>Start date</th><th>Salary</th></tr></thead>";

                            var th = "<thead><tr><th>Cuota</th><th>Año</th><th>Mes</th><th>Saldo</th><th>Interés</th><th>Amortización</th><th>Monto cuota</th></tr></thead>"

                            tabla.append(th);

	    					for (var i = 1; i <= anio_pagar * 12; i++) {
	    						//valor_inmueblen = valor_inmueble;
	    						var val = valor_inmueble * tasa_anual;

	    						valor_inmueble = valor_inmueble - (m-(valor_inmueble * tasa_anual));

	    						var amor = m - (valor_inmueble * tasa_anual);

	    						if (valor_inmueble.toFixed(0) <= 0) {
	    							valor_inmueble = 0;
	    						}
	    						else{
	    							valor_inmueble = valor_inmueble;
	    						}
	    						e.setMonth(mes + i);
			
								//console.log(e.getMonth() + " Año " + anio);

								

                                var td = "<tr><td>"+i+"</td><td>"+anio+"</td><td>"+meses[e.getMonth()]+"</td><td>"+new Intl.NumberFormat("de-DE").format(valor_inmueble.toFixed(2))+"</td><td>"+ val.toFixed(2) +"</td><td>"+ amor.toFixed(2) +"</td><td>" + new Intl.NumberFormat("de-DE").format(m) +"</td></tr>"

                                tabla.append(td);

                                $('#example').DataTable();

                                if (e.getMonth() == 11) {
									a.setFullYear(anio++);
									//console.log(a.getFullYear());
								}
	    					}

                            $("#tabla_datos").append(tabla);

	    					console.log(m);
	    				}
		    			else{
		    				$("#show_tasa_interes").text('Sólo permitido de 5 a 20%');
		    				$("#show_tasa_interes").show();
		    			}
		    		}
		    		else{
		    			$("#show_cuota_inicial").text('No puede ser mayor al valor del inmueble');
		    			$("#show_cuota_inicial").show();
		    			console.log("No puede ser mayor al valor del inmueble /Cuota inicial " + cuota_inicial + " /Valor inmueble " + valor_inmueble);
		    		}
	    		}
	    		else{
	    			console.log("Cero encontrado");
	    		}
	    	}
	    	else{
	    		console.log("Completar todos los campos");
	    	}

	    	//var str = "Visit Microsoft!";
			//var res = valor_inmueble.replace("$", ""); 
			//res = res.replace(".", "");  
			//console.log(res);
			

	    })



	    $(valor_inmueble).keyup(function() {
		  var valor_inmueble = $(this).val();
		  //console.log(valor_inmueble);
		  if (valor_inmueble == "$0") {
		  	$("#show_valor_inmueble").show();
		  }
		  else{
		  	$("#show_valor_inmueble").hide();
		  }
		});
		$(cuota_inicial).keyup(function() {
		  var valor_cuota_inicial = $(this).val();
		  //console.log(valor_cuota_inicial);
		  if (valor_cuota_inicial == "$0") {
		  	$("#show_cuota_inicial").show();
		  }
		  else{
		  	$("#show_cuota_inicial").hide();
		  }
		});
		$(tasa_anual).keyup(function() {
		  var valor_tasa_anual = $(this).val();
		  //console.log(valor_tasa_anual);
		  if (valor_tasa_anual == "0 %") {
		  	$("#show_tasa_interes").show();
		  }
		  else{
		  	$("#show_tasa_interes").hide();
		  }
		});

	});
	</script>
</body>
</html>