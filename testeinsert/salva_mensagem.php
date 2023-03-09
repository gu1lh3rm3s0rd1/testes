<?php
	include 'conexao.php';

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$assunto = $_POST['assunto'];
	$mensagem = $_POST['mensagem'];
	
	//$result_teste = "INSERT INTO formulario (empresa, cod_cliente, cliente_cpf_cnpj, cliente_nome, cliente_uf, cliente_municipio, cliente_endereco, cliente_bairro, cod_pedido, cod_item_pedido, contato_nome, contato_cargo, contato_email, contato_telefone, apontamento_tipo, apontamento_area, observacao) 

	$resut_teste = "INSERT INTO 'teste' (nome, email, assunto, mensagem) VALUES ('".$nome."','".$email."','".$assunto."', '".$mensagem."')";

	$resultado_teste= pg_query($conexao, $result_teste);
?>