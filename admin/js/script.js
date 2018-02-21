$(document).ready(function(){

    //Usuarios
	
	$(document).on("click", "#agregar-usuario", function(e){
        e.preventDefault();//Previene que no se abra el link dentro del href

        $("#form-agregar-usuario").modal("show");
    });   
		
	$(document).on("click", "#guardar-usuario", function(e){

        e.preventDefault();

        var nombre = $("#nombre-usuario").val();
        var email = $("#email-usuario").val();
		var password = $("#password-usuario").val();		

		// Check if there is an entered value
		if(!$("#nombre-usuario").val()) {
		  // Add errors highlight
		    $("#nombre-usuario").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el nombre');
			$("#nombre-usuario").focus();
		    return false;
		} else {
		  // Remove the errors highlight
		    $("#nombre-usuario").closest('.form-group').removeClass('has-error').addClass('has-success');
		}
		
		// Check if there is an entered value
		if(!$("#email-usuario").val()) {
		  // Add errors highlight
		    $("#email-usuario").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el email');
			$("#email-usuario").focus();
		    return false;
		} else {
			
			var rex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		    if(!rex.test(email)){
			  alert('Por favor introduzca un email válido.');
			  return false;
		    }		
			
		  // Remove the errors highlight
		    $("#email-usuario").closest('.form-group').removeClass('has-error').addClass('has-success');
		}
		
		// Check if there is an entered value
		if(!$("#password-usuario").val()) {
		  // Add errors highlight
		    $("#password-usuario").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el password');
			$("#password-usuario").focus();
		    return false;
		} else {			
			
		    // Remove the errors highlight
		    $("#password-usuario").closest('.form-group').removeClass('has-error').addClass('has-success');
		}				

        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "nombre="+nombre+"&email="+email+"&password="+password+"&op=1",
            success: function(data) {
                $("#form-agregar-usuario").modal("hide")
                $(".tabla-usuarios").html(data);
                $("#form-agregar-usuario form")[0].reset();
            },
            error: function(err){
                console.log(err);
            }
        });
    });
   
		$(document).on("click", "#editar-usuario", function(e){

        e.preventDefault();

        var nombre = $("#form-editar-usuario #nombre-usuario").val();
        var email = $("#form-editar-usuario #email-usuario").val();
		var password = $("#form-editar-usuario #password-usuario").val();		
        var codigo = $("#form-editar-usuario #codigo-usuario").val();
		
		// Check if there is an entered value
		if(!$("#form-editar-usuario #nombre-usuario").val()) {
		  // Add errors highlight
		    $("#form-editar-usuario #nombre-usuario").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el nombre');
			$("#form-editar-usuario #nombre-usuario").focus();
		    return false;
		} else {
		  // Remove the errors highlight
		    $("#form-editar-usuario #nombre-usuario").closest('.form-group').removeClass('has-error').addClass('has-success');
		}
		
		// Check if there is an entered value
		if(!$("#form-editar-usuario #email-usuario").val()) {
		  // Add errors highlight
		    $("#form-editar-usuario #email-usuario").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el email');
			$("#form-editar-usuario #email-usuario").focus();
		    return false;
		} else {
			
		   var rex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		    if(!rex.test(email)){
			  alert('Por favor introduzca un email válido.');
			  return false;
		    }			
			
		  // Remove the errors highlight
		    $("#form-editar-usuario #email-usuario").closest('.form-group').removeClass('has-error').addClass('has-success');
		}
		
		// Check if there is an entered value
		if(!$("#form-editar-usuario #password-usuario").val()) {
		  // Add errors highlight
		    $("#form-editar-usuario #password-usuario").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el password');
			$("#form-editar-usuario #password-usuario").focus();
		    return false;
		} else {
		  // Remove the errors highlight
		    $("#form-editar-usuario #password-usuario").closest('.form-group').removeClass('has-error').addClass('has-success');
		}		

        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "nombre="+nombre+"&email="+email+"&password="+password+"&codigo="+codigo+"&op=3",
            success: function(data) {
                $("#form-editar-usuario").modal("hide")
                $(".tabla-usuarios").html(data);

            },
            error: function(err){
                console.log(err);
            }
        });
    });

     $(document).on("click", ".editar-usuario", function(e){

        e.preventDefault();       
        console.log($(this).data("id"));

        var codigo = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "id="+codigo+"&op=2",
            success: function(data) {              

               var arrDatos = jQuery.parseJSON(data);

               $("#form-editar-usuario #nombre-usuario").val(arrDatos.nombre);
               $("#form-editar-usuario #email-usuario").val(arrDatos.email);
			   $("#form-editar-usuario #password-usuario").val(arrDatos.password);
               $("#form-editar-usuario #codigo-usuario").val(arrDatos.id);
               $("#form-editar-usuario").modal("show");
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on("click", ".eliminar-usuario", function(e){

        e.preventDefault();       
        console.log($(this).data("id"));

        var codigo = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "id="+codigo+"&op=4",
            success: function(data) {
               $(".tabla-usuarios").html(data);
            },
            error: function(err){
                console.log(err);
            }
        });
    });	
		
	
	//Productos
	
	$(document).on("click", "#agregar-producto", function(e){
        e.preventDefault();//Previene que no se abra el link dentro del href

        $("#form-agregar-producto").modal("show");
    });   
		
	$(document).on("click", "#guardar-producto", function(e){

        e.preventDefault();

        var nombre = $("#nombre-producto").val();
		var precio = $("#precio-producto").val();         		

		// Check if there is an entered value
		if(!$("#nombre-producto").val()) {
		  // Add errors highlight
		    $("#nombre-producto").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el nombre');
			$("#nombre-producto").focus();
		    return false;
		} else {
		  // Remove the errors highlight
		    $("#nombre-producto").closest('.form-group').removeClass('has-error').addClass('has-success');
		}		
		
		// Check if there is an entered value
		if(!$("#precio-producto").val()) {
		  // Add errors highlight
		    $("#precio-producto").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el precio');
			$("#precio-producto").focus();
		    return false;
		} else {		
		    
			if(isNaN(precio)){
			  alert('Por favor introduzca un número válido.');
			  return false;
		    }
			
			if(precio < 0){
			  alert('Por favor introduzca un precio mayor a 0.');
			  return false;
		    }
			
			if(precio == 0.00){
			  alert('Por favor introduzca un precio mayor a 0.');
			  return false;
		    }			
			
		  // Remove the errors highlight
		    $("#precio-producto").closest('.form-group').removeClass('has-error').addClass('has-success');
		}	
						

        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "nombre="+nombre+"&precio="+precio+"&op=5",
            success: function(data) {
                $("#form-agregar-producto").modal("hide")
                $(".tabla-productos").html(data);
                $("#form-agregar-producto form")[0].reset();
            },
            error: function(err){
                console.log(err);
            }
        });
    });
   
		$(document).on("click", "#editar-producto", function(e){

        e.preventDefault();

        var nombre = $("#form-editar-producto #nombre-producto").val();
		var precio = $("#form-editar-producto #precio-producto").val();        	
        var codigo = $("#form-editar-producto #codigo-producto").val();
		
		// Check if there is an entered value
		if(!$("#form-editar-producto #nombre-producto").val()) {
		  // Add errors highlight
		    $("#form-editar-producto #nombre-producto").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el nombre');
			$("#form-editar-producto #nombre-producto").focus();
		    return false;
		} else {
		  // Remove the errors highlight
		    $("#form-editar-producto #nombre-producto").closest('.form-group').removeClass('has-error').addClass('has-success');
		}		
		
		// Check if there is an entered value
		if(!$("#form-editar-producto #precio-producto").val()) {
		  // Add errors highlight
		    $("#form-editar-producto #precio-producto").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el precio');
			$("#form-editar-producto #precio-producto").focus();
		    return false;
		} else {			
			
		    if(isNaN(precio)){
			  alert('Por favor introduzca un número válido.');
			  return false;
		    }
			
			if(precio < 0){
			  alert('Por favor introduzca un precio mayor a 0.');
			  return false;
		    }
			
			if(precio == 0.00){
			  alert('Por favor introduzca un precio mayor a 0.');
			  return false;
		    }		
			
		  // Remove the errors highlight
		    $("#form-editar-producto #precio-producto").closest('.form-group').removeClass('has-error').addClass('has-success');
		}			

        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "nombre="+nombre+"&precio="+precio+"&codigo="+codigo+"&op=6",
            success: function(data) {
                $("#form-editar-producto").modal("hide")
                $(".tabla-productos").html(data);

            },
            error: function(err){
                console.log(err);
            }
        });
    });

     $(document).on("click", ".editar-producto", function(e){

        e.preventDefault();       
        console.log($(this).data("id"));

        var codigo = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "id="+codigo+"&op=7",
            success: function(data) {              

               var arrDatos = jQuery.parseJSON(data);

               $("#form-editar-producto #nombre-producto").val(arrDatos.nombre);
			   $("#form-editar-producto #precio-producto").val(arrDatos.precio);              
               $("#form-editar-producto #codigo-producto").val(arrDatos.id);
               $("#form-editar-producto").modal("show");
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on("click", ".eliminar-producto", function(e){

        e.preventDefault();       
        console.log($(this).data("id"));

        var codigo = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "includes/libreria.php",
            data: "id="+codigo+"&op=8",
            success: function(data) {
               $(".tabla-productos").html(data);
            },
            error: function(err){
                console.log(err);
            }
        });
    });	
	
	
	$(document).on("click", "#mostrar-compra", function(e){
		
        e.preventDefault();//Previene que no se abra el link dentro del href

        $("#form-comprar").modal("show");   		
		
    }); 
	
	
	$(document).on("click", "#comprar", function(e){
		
         e.preventDefault();//Previene que no se abra el link dentro del href      
		
		 var nombre = $("#nombre").val();
         var email  = $("#email").val();		

		// Check if there is an entered value
		if(!$("#nombre").val()) {
		  // Add errors highlight
		    $("#nombre").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el nombre');
			$("#nombre").focus();
		    return false;
		} else {
		  // Remove the errors highlight
		    $("#nombre").closest('.form-group').removeClass('has-error').addClass('has-success');
		}
		
		// Check if there is an entered value
		if(!$("#email").val()) {
		  // Add errors highlight
		    $("#email").closest('.form-group').removeClass('has-success').addClass('has-error');
	        e.preventDefault();
			alert('Introduzca el email');
			$("#email").focus();
		    return false;
		} else {
			
			var rex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		    if(!rex.test(email)){
			  alert('Por favor introduzca un email válido.');
			  return false;
		    }		
			
		    // Remove the errors highlight
		    $("#email").closest('.form-group').removeClass('has-error').addClass('has-success');
		}				

        $.ajax({
            type: "POST",
            url: "procesar-compra.php",
            data: "nombre="+nombre+"&email="+email,
            success: function(data) {
                $("#form-comprar").modal("hide");
				$("#form-comprar form")[0].reset();
				$("#compra-realizada").modal("show");               
            },
            error: function(err){
                console.log(err);
            }
        });		
		
    }); 
	

});