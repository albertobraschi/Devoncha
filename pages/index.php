<?php 
	require "../includes/include.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Associe-se agora</title>


<script type="text/javascript"> 
	// Função única que fará a transação
	function getEndereco() {
			// Se o campo CEP não estiver vazio
			if($.trim($("#cep").val()) != ""){
				/* 
					Para conectar no serviço e executar o json, precisamos usar a função
					getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
					dataTypes não possibilitam esta interação entre domínios diferentes
					Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
					http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
				*/
				$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
					// o getScript dá um eval no script, então é só ler!
					//Se o resultado for igual a 1
			  		if(resultadoCEP["resultado"]){
						// troca o valor dos elementos
						$("#rua").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
						$("#bairro").val(unescape(resultadoCEP["bairro"]));
						$("#cidade").val(unescape(resultadoCEP["cidade"]));
						$("#estado").val(unescape(resultadoCEP["uf"]));
					}else{
						alert("Endereço não encontrado");
					}
				});				
			}			
	}
</script>



<link type="text/css" rel="stylesheet" href="css/style.css" />
 


  
<script src="js/jquery-1.5.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="js/meus-metodos.js"></script>



<script type="text/javascript">
$(document).ready( function() {
	$("#formularioContato").validate({
		// Define as regras
		rules:{
			estado: {
				required: true
			},
			nome:{
				// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 4
			},
         	cpf: {
				cpf: true, required: true
			},
			qtd: {
                number: true,
                required: true
            },
			email:{
				// campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
				required: true, email: true
			},
			//qtd:{
				// campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
				//required: true, minlength: 1
			//},
			rua:{
				// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 5
			},
			bairro:{
				// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 5
			},
			numero:{
				// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
				number: true,
				required: true, minlength: 1
			},
			cep:{
				// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 8
			},
			cidade:{
				// campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 2
			}
		},
		// Define as mensagens de erro para cada regra
		messages:{
			estado: {
				required: 'Seleção obrigatória'
			},
			nome:{
				required: "Campo obrigatório",
				minlength: "O seu nome deve conter, no mínimo, 4 caracteres"
			},
			email:{
				required: "Campo obrigatório",
				email: "Digite um e-mail válido"
			},
			//qtd:{
				//required: "Campo obrigatório",
				//minlength: "Este campo deve conter, no mínimo, 1 caracterer"
			//},
			rua:{
				required: "Campo obrigatório",
				minlength: "O seu endereço deve conter, no mínimo, 5 caracteres"
			},
			bairro:{
				required: "Campo obrigatório",
				minlength: "O seu bairro deve conter, no mínimo, 5 caracteres"
			},
			numero:{
				required: "Campo obrigatório",
				minlength: "O seu numero deve conter, no mínimo, 1 caracteres"
			},
			cep:{
				required: "Campo obrigatório",
				minlength: "O seu CEP deve conter, no mínimo, 9 caracteres"
			},
			cpf: {
				cpf: 'Informe um CPF válido'
			},
			cidade:{
				required: "Campo obrigatório",
				minlength: "A sua Cidade deve conter, no mínimo, 9 caracteres"
			}
		}
	});
});

</script>


<script type="text/javascript">

function MM_formtCep(e,src,mask) {
        if(window.event) { _TXT = e.keyCode; } 
        else if(e.which) { _TXT = e.which; }
        if(_TXT > 47 && _TXT < 58) { 
  var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i)
  if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); } 
     return true; } else { if (_TXT != 8) { return false; } 
  else { return true; }
        }
}


</script>

<script type="text/javascript">
			function FormataCpf(campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(campo.value);
				vr = vr.replace(".", "");
				vr = vr.replace("/", "");
				vr = vr.replace("-", "");
				tam = vr.length + 1;
				if (tecla != 14)
				{
					if (tam == 4)
						campo.value = vr.substr(0, 3) + '.';
					if (tam == 7)
						campo.value = vr.substr(0, 3) + '.' + vr.substr(3, 6) + '.';
					if (tam == 11)
						campo.value = vr.substr(0, 3) + '.' + vr.substr(3, 3) + '.' + vr.substr(7, 3) + '-' + vr.substr(11, 2);
				}
			}
</script>



</head>

<body>
<div id="tudo">
	<div id="contact_form">
    	<div id="associe">Associe-se agora:</div>
        
        <div id="camposobrig">(* campos obrigatórios)</div>
    
    	<form id="formularioContato" method="post" name="contact" action="novoPedidoAguarde.php">
                <input type="hidden" name="post" value="Send" />
                    <div id="estado">
                    <span>
<label for="nome" style="font-size:16px;">Produto: </label>
                    </span> <span id="kit">Produto Teste - R$ 1,00</span>
					</div>
                    <div id="estado">
                    <span>
                    <label for="empresa">Opção Pagamento *</label></span>
                    <span id="select">
         			<select name="codigoBandeira">  
                      <option value="visa" >Visa</option>
                      <option value="mastercard" >Mastercard</option>
  					</select>
                    </span>
                    </div>
                    
                    <div id="estado">
                    <span id="pagamento">
                    <label for="empresa">Pagamento *</label></span> 
                   <span id="radio"><input type="radio" id="feme" name="formaPagamento" checked="checked" value="A" class="gender" />Débito
                   <input type="radio" id="feme" name="formaPagamento" value="1" class="gender" />Crédito a Vista<br />
                   <input type="radio" id="feme" name="formaPagamento" value="2" class="gender" />2x
                   <input type="radio" id="feme" name="formaPagamento" value="3" class="gender" />3x
                   <input type="radio" id="feme" name="formaPagamento" value="4" class="gender" />4x
                   <input type="radio" id="feme" name="formaPagamento" value="5" class="gender" />5x
                   <input type="radio" id="feme" name="formaPagamento" value="6" class="gender" />6x
                   </span>
                   </div>
          <div class="cleaner h10">
</div>
                    
                    <input type="submit" class="submit_btn float_l" name="submit" id="submit" value="Enviar" onClick="vista.validate()" />
    </form>
    
    
    				
    
    </div>
</div>

</body>
</html>