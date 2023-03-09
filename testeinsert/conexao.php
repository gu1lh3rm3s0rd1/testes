<?php
  #conexao com o banco de dados do postgresSQL

  # Substitua abaixo os dados, de acordo com o banco criado
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

?>