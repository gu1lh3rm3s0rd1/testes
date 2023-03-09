<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>

<form method="POST">
			Nome: <input type="text" name="nome" placeholder="Nome Completo" required></br></br>
			E-mail: <input type="email" name="email" placeholder="Seu melho e-mail" required></br></br>
			Assunto: <input type="text" name="assunto" placeholder="Assunto do contato" required></br></br>
			Mensagem: <textarea name="mensagem"></textarea></br></br>
			<input type="submit" value="Enviar">
		</form>

</body>
</html>


<?php

    $servidor = "192.168.0.4";
    $porta = 5432;
    $banco = "POS_VENDA";
    $usuario = "postgres";
    $senha = "Dwf6127d4l5k6@";

    # Conecta com o servidor de banco de dados
    $conexao = pg_connect("host=$servidor
                          port=$porta
                          dbname=$banco
                          user=$usuario
                          password=$senha")

    or die ("Não foi possível conectar ao servidor PostGreSQL");

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $result = pg_query($conexao, "INSERT INTO teste (nome, email, assunto, mensagem) VALUES ('$nome', '$email', '$assunto', '$mensagem')");

    if (!$result){
      echo "You have a problem";
      exit;
    };

?>