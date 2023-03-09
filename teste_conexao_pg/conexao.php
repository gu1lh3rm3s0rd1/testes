<?php

  $servidor = "192.168.0.4";
  $porta = 5432;
  $banco = "STAGE";
  $usuario = "postgres";
  $senha = "Dwf6127d4l5k6@";

  $conexao = pg_connect("host=$servidor
                         port=$porta
                         dbname=$banco
                         user=$usuario
                         password=$senha")

  or die ("Não foi possível conectar ao servidor PostGreSQL");

  //caso a conexão seja efetuada com sucesso, exibe uma mensagem ao usuário
  echo "Conexão efetuada com sucesso!!";

  $sql = "
  SELECT count(distinct(C2_NUM)) AS ID
  FROM ordem_producao
  WHERE CAST(C2_EMISSAO AS DATE) = current_date";

  $result=pg_query($conexao, $sql);
    if (!$result) {
      echo "Um erro ororreu.\n";
      exit;
    }
    
    $arr = pg_fetch_array($result, 0, PGSQL_NUM);
    echo $arr[0] . "\n";

?>