<?php

    # Substitua abaixo os dados, de acordo com o banco criado
    $user = "scada"; 
    $password = "scada"; 
    $database = "sgq_chi_reg"; 
    $hostname = "192.168.0.25"; 

    # Conecta com o servidor de banco de dados 
    $conexao = mysqli_connect(
        $hostname,
        $user,
        $password,
        $database
        // $port = null,
        // $socket = null
    );

    # fecha conexao
    //mysqli_close($conexao);

?>