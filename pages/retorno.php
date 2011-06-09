<?

$english_day = date("l");


switch($english_day)
{
	case "Monday":
		$portuguese_day = "Segunda-Feira";
		break;
	case "Tuesday":
		$portuguese_day = "Terça-Feira";
		break;
	case "Wednesday":
		$portuguese_day = "Quarta-Feira";
		break;
	case "Thursday":
		$portuguese_day = "Quinta-Feira";
		break;	
	case "Friday":
		$portuguese_day = "Sexta-Feira";
		break;
	case "Saturday":
		$portuguese_day = "Sábado";
		break;
	case "Sunday":
		$portuguese_day = "Domingo";
		break;
}

/*
**vê o mês em Inglês
*/

$english_month = date("n");

/*
**Acha o mês em português
*/

switch($english_month)
{
	case "1":
		$portuguese_month = "Janeiro";
		break;
	case "2":
		$portuguese_month = "Fevereiro";
		break;
	case "3":
		$portuguese_month = "Março";
		break;
	case "4":
		$portuguese_month = "Abril";
		break;
	case "5":
		$portuguese_month = "Maio";
		break;
	case "6":
		$portuguese_month = "Junho";
		break;
	case "7":
		$portuguese_month = "Julho";
		break;
	case "8":
		$portuguese_month = "Agosto";
		break;
	case "9":
		$portuguese_month = "Setembro";
		break;
	case "10":
		$portuguese_month = "Outubro";
		break;
	case "11":
		$portuguese_month = "Novembro";
		break;
	case "12":
		$portuguese_month = "Dezembro";
		break;
}

/*
**Mostrar a data em português
*/


?>
<?php
	
	require '../includes/include.php';
	
	
	
	
	// Resgata último pedido feito da SESSION
	$ultimoPedido = $_SESSION["pedidos"]->count();
	
	$ultimoPedido -= 1;
	
	$Pedido = new Pedido();
	$Pedido->FromString($_SESSION["pedidos"]->offsetGet($ultimoPedido));
	
	// Consulta situação da transação
	$objResposta = $Pedido->RequisicaoConsulta();
	
	// Atualiza status
	$Pedido->status = $objResposta->status;
	
	if($Pedido->status == '4' || $Pedido->status == '6')
		$finalizacao = true;
	else
		$finalizacao = false;
	
	// Atualiza Pedido da SESSION
	$StrPedido = $Pedido->ToString();
	$_SESSION["pedidos"]->offsetSet($ultimoPedido, $StrPedido);
?>
<html>
	<head>
    <style type="text/css">
	#confirmapg {
		margin:0 auto;
		width:300px;
		border:#093 solid 2px;
		text-align:center;
		-moz-border-radius:7px;
		color:#333;
	}
	#confirmapg input {
		border:#999 2px solid;
		-moz-border-radius:3px;
	}
	#enviar {
		float:right; 
		margin-right:5px; 
		margin-top:5px;
		background:#093;
		color:#333;
		border:none;
	}
	
	</style>
    
    <script LANGUAGE="JavaScript">
	<!--
	function Verifica_CPF(formulario) {
	var CPF = formulario.CPF.value;
	var nome = formulario.nome.value; // Recebe o valor digitado no campo
	
	// Verifica se o campo é nulo
	if (nome == '') {
	  alert('O campo Nome completo é de preenchimento obrigatório!');
	  return false;
	}
	
	if (CPF == '') {
	  alert('Este campo é de preenchimento obrigatório!');
	  return false;
	   }

	
	// Aqui começa a checagem do CPF
	var POSICAO, I, SOMA, DV, DV_INFORMADO;
	var DIGITO = new Array(10);
	DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado
	
	// Desemembra o número do CPF na array DIGITO
	for (I=0; I<=8; I++) {
	  DIGITO[I] = CPF.substr( I, 1);
	}
	
	// Calcula o valor do 10º dígito da verificação
	POSICAO = 10;
	SOMA = 0;
	   for (I=0; I<=8; I++) {
		  SOMA = SOMA + DIGITO[I] * POSICAO;
		  POSICAO = POSICAO - 1;
	   }
	DIGITO[9] = SOMA % 11;
	   if (DIGITO[9] < 2) {
			DIGITO[9] = 0;
	}
	   else{
		   DIGITO[9] = 11 - DIGITO[9];
	}
	
	// Calcula o valor do 11º dígito da verificação
	POSICAO = 11;
	SOMA = 0;
	   for (I=0; I<=9; I++) {
		  SOMA = SOMA + DIGITO[I] * POSICAO;
		  POSICAO = POSICAO - 1;
	   }
	DIGITO[10] = SOMA % 11;
	   if (DIGITO[10] < 2) {
			DIGITO[10] = 0;
	   }
	   else {
			DIGITO[10] = 11 - DIGITO[10];
	   }
	
	// Verifica se os valores dos dígitos verificadores conferem
	DV = DIGITO[9] * 10 + DIGITO[10];
	   if (DV != DV_INFORMADO) {
		  alert('CPF inválido');
		  formulario.CPF.value = '';
		  formulario.CPF.focus();
		  return false;
	   }
	}
	//-->
	</script>
    
		<title>Confirmar Pagamento</title>
	</head>
	<body>
	<center>
		<h3>Fechamento (
<? print($portuguese_day);
print(", ");
print(date("d"));
print(" de ");
print($portuguese_month);
print(" de ");
print(date("Y"));  ?> - <? echo date('H:i:s')  ?>)</h3>
		<table width="615" border="0">
			<tr bgcolor="#CCCCCC">
				<th width="152">Número pedido</th>
				<th width="206">Finalizado com sucesso?</th>
				<th width="102">Transação</th>
				<th width="137">Status transação</th>
			</tr>
			<tr bgcolor="#0099FF">
				<td align="center" bgcolor="#009933"><?php echo $Pedido->dadosPedidoNumero; ?></td>
				<td align="center" bgcolor="#009933"><?php echo $finalizacao ? "sim" : "não"; ?></td>
			  <td align="center" bgcolor="#009933"><?php echo $Pedido->tid; ?></td>
				<td align="center" bgcolor="#009933" style="color: red;"><?php echo $Pedido->getStatus(); ?></td>
			</tr>			
		</table>
       						

<div style="margin-top:20px;">		
<table width="296" border="0">
  <tr>
    <td width="168"><p><a href="#" onClick="print()"><img border="none" src="img/btn_imprimir.jpg"></a></p></td>
    <td width="118"><p><a href="index.php"><img src="img/btn_inicio.jpg" border="none"></a></p></td>
  </tr>
</table>
</div>

<h4 style="color:#F00;">OBS: É recomendavel você imprimir ou guardar os dados do pagamento!</h4>
<h4 style="color:#F00;">Sua compra só será validade se você confirmar o pagamento!</h4>
</center>
<div id="confirmapg">	
        <h2>Confirmar Pagamento</h2>
        <form action="retorno.php?funcao=confirmar" method="post" name="Formulario" target="_parent" onSubmit="return Verifica_CPF(this)">
            <table width="252" height="108" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="102" height="35" align="right" style="padding-right:2px;">Nome completo</td>
            <td width="150" style="padding-right:2px;"><input type="text" size="20" name="nome"></td>
          </tr>
          <tr>
            <td align="right" style="padding-right:2px;"><span style="margin-bottom:12px; float:right;">CPF</span></td>
            <td>
            <input type="text" size="20" name="CPF"><br>
            <span style="font-size:11px; color:#333;">Ex: 8888888888 </span>
            
            </td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="confirmar" value="Confirmar" id="enviar"></td>
          </tr>
        </table>
        </form>	
        </div>
    

    
	
	
	
	
	
	
	<?
	$tx_nome = $_POST["nome"];
	$tx_cpf = $_POST["CPF"];
	
	if(isset($_GET["funcao"]) == "confirmar") {
			$npedido = $Pedido->dadosPedidoNumero;
			$nfinalizacao = $finalizacao ? "sim" : "não";
			$npedido2 = $Pedido->tid;
			$nstatus = $Pedido->getStatus();
			 
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: 'Formulário'\r\n";	
			
			$mens = "<font size=2 face=Verdana><p align=center>:: Sistema de formulário ::<br><br></p></font>";
			$mens .= "
			 <html>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
			</head>
			<body>
			
			<table width='969' border='1' cellpadding='5' cellspacing='0'>
			  <tr>
				<td width='200' bgcolor='#DADADA'>Nome:</td>
				<td width='865' bgcolor='#DADADA'>$tx_nome</td>
			  </tr>
			  <tr>
				<td width='200' bgcolor='#DADADA'>CPF:</td>
				<td width='865' bgcolor='#DADADA'>$tx_cpf</td>
			  </tr>
			  <tr>
				<td width='200' bgcolor='#DADADA'>Numero Pedido:</td>
				<td width='865' bgcolor='#DADADA'>$npedido</td>
			  </tr>
			  <tr>
				<td bgcolor='#DADADA'>Finalizado com sucesso ?:</td>
				<td bgcolor='#DADADA'>$nfinalizacao</td>
			  </tr>
			  <tr>
				<td bgcolor='#DADADA'>Transação:</td>
				<td bgcolor='#DADADA'>$npedido2</td>
			  </tr>
			  <tr>
				<td bgcolor='#DADADA'>Status transação:</td>
				<td bgcolor='#DADADA'>$nstatus</td>
			  </tr>
			</table>
			
			
			</body>
			<html>
			 ";
			mail("softdec@softdec.com","Formulário de Confirmação de pagamento","$mens", $headers);
			echo "<center><b>Operação Realizada com sucesso</b></center>";
	}
	else {
		echo "<center><b>Erro ao confirmar pagamento</b></center>";
	}
	?>
	</body>
</html>