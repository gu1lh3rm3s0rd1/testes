<?php

    //conexao
    //$db = " (DESCRIPTION =
    //(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.0.12)(PORT = 1521))
    //(CONNECT_DATA = (SID = orcl))
    //)";
    $conexao = oci_connect('P11PROD', 'P11PROD', '192.168.0.12/orcl');
    if (!$conexao) { 
    $erro = oci_error();
    trigger_error(htmlentities($erro['message'], ENT_QUOTES), E_USER_ERROR);
    exit;
    }

    //query da consulta do BD
    $sql = "
    SELECT TO_CHAR(SUM(X.TOTAL), '999G999G999D99') AS TOTAL
    FROM
    (
    SELECT F2_VALFAT AS TOTAL, TO_DATE(F2_EMISSAO,'YYYYMMDD') AS DIA , TO_DATE(TO_CHAR(CURRENT_DATE,'YYYYMMDD'),'YYYYMMDD') AS HOJE
    FROM SF2010
    WHERE SF2010.D_E_L_E_T_ = ' '
    ) X
	  WHERE X.DIA = X.HOJE";

    //variavel de consulta com o BD
    $consulta = oci_parse($conexao, $sql);

    //execucao da consulta
    oci_execute($consulta);

    //preparando valores
    $total = '';

    //funcao de repeticao para trazer os dados desejados
    while ($dados = oci_fetch_array($consulta)) {
        $totaldiario = $total . '' . $dados['TOTAL'] . '';

        //limpa espaços da variavel
        $totaldiariofat = trim($totaldiario);
    }

    //echo $mes;
    //echo $total21;
    //echo $total22;

    //libera os dados associados as declaraçoes do BD
    oci_free_statement($consulta);

    //fecha conexao com BD
    //oci_close($conexao);

?>