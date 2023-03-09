<?php
	include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Contato</title>
	<head>
	<body>

		<form method="POST">
			Nome: <input type="text" name="nome" placeholder="Nome Completo" required></br></br>
			E-mail: <input type="email" name="email" placeholder="Seu melho e-mail" required></br></br>
			Assunto: <input type="text" name="assunto" placeholder="Assunto do contato" required></br></br>
			Mensagem: <textarea name="mensagem"></textarea></br></br>
			<input type="submit" value="Enviar">
		</form>

<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];

//$result_teste = "INSERT INTO formulario (empresa, cod_cliente, cliente_cpf_cnpj, cliente_nome, cliente_uf, cliente_municipio, cliente_endereco, cliente_bairro, cod_pedido, cod_item_pedido, contato_nome, contato_cargo, contato_email, contato_telefone, apontamento_tipo, apontamento_area, observacao) 

$resut_teste = "INSERT INTO 'teste' (nome, email, assunto, mensagem) VALUES ('$nome','$email','$assunto', '$mensagem')";

$resultado_teste= pg_query($conexao, $result_teste); 

?>

	</body>
</html>