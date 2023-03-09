<?php include 'conexao.php' ?>

<?php

  # Substitua abaixo os dados, de acordo com o banco criado
  $user = "scada"; 
  $password = "scada"; 
  $database = "sgq_chi_reg"; 

  # O hostname deve ser sempre localhost ou IP do servidor 
  $hostname = "192.168.0.25"; 

  # Conecta com o servidor de banco de dados 
  $conexao = mysqli_connect( $hostname, $user, $password, $database ) or die( ' Erro na conexão ' ); 

  # Executa a query desejada 
  // total produzido do dia
  $sql = "
    SELECT count(num) as num
    FROM sgq_chi_reg.rg_th 
    WHERE cast(dt_hora as DATE) >= curdate()-7;"; 

  $consulta = mysqli_query( $conexao, $sql ) or die(' Erro na query:'); 

  #prapara array
  $total = '';

  # Exibe os registros na tela 
  while ($dados = mysqli_fetch_array( $consulta )) { 
    $totaltestePS = $total . '' . $dados['num'] . '';
  }

?>