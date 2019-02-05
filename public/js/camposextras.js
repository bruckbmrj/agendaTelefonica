

		function escondeTel(id){
		var campo = $(".imendawrapperTel");
		campo.hide(200);
		console.log(id);
		console.log(campo);				
		}	

		function escondeCel(id){
		var campo = $(".imendawrapperCel");
		campo.hide(200);
		console.log(id);
		console.log(campo);				
		}

		$( document ).ready(function() {
			$(".imendawrapperTel").css('display','none');
			$(".imendawrapperCel").css('display','none');

			//telefone2
			$("#btnAdicionatelefone2").click(function(e){
			e.preventDefault();
			var tipoCampo = "telefone2";
			$(".addtel").addClass("disabled");
			mostraCampoTel(tipoCampo);
			
			});

			function mostraCampoTel(tipo){
				var idCampo = tipo;
				var html = "";		
				$(".imendawrapperTel").show();
				$(".btnExcluirtelefone2").show();



				$(".btnExcluirtelefone2").click(function(){
					escondeTel(tipo);
				$(".addtel").removeClass("disabled");	
				$('#telefone2').val('');	
				});

			}

			$(".btnExcluirtelefone2").click(function(){
			console.log("clicou");
			$(this).slideUp(200);
			
			});

			//celular

			$("#btnAdicionacelular").click(function(e){
			e.preventDefault();
			var tipoCampo = "celular";
			$(".addcel").addClass("disabled");
			mostraCampoCel(tipoCampo);
			
			});

			function mostraCampoCel(tipo){
				var idCampo = tipo;
					
				$(".imendawrapperCel").show();
				$(".btnExcluircelular").show();



				$(".btnExcluircelular").click(function(){
					escondeCel(tipo);
				$(".addcel").removeClass("disabled");	
				$('#celular').val('');	
				});
			}

			$(".btnExcluircelular").click(function(){
			console.log("clicou");
			$(this).slideUp(200);
			
			});


		});


			
