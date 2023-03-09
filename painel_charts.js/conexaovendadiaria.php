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
    SELECT TO_CHAR(SUM(Y.TOTAL), '999G999G999D99') AS TOTAL
    FROM
    (
    SELECT C6_VALOR AS TOTAL, TO_DATE(C5_EMISSAO,'YYYYMMDD') AS DIA , TO_DATE(TO_CHAR(CURRENT_DATE,'YYYYMMDD'),'YYYYMMDD') AS HOJE
    FROM SC6010 
    INNER JOIN SC5010 ON C6_FILIAL = C5_FILIAL AND C6_NUM = C5_NUM AND SC5010.D_E_L_E_T_ = ' ' AND SC6010.D_E_L_E_T_ = ' '
    INNER JOIN SF4010 ON F4_CODIGO = C6_TES AND SF4010.D_E_L_E_T_ = ' '
    WHERE C5_FILIAL = '01' AND F4_DUPLIC = 'S' AND C5_TIPO = 'N' AND C6_BLQ <> 'R'
    ) Y
	WHERE Y.DIA = Y.HOJE";

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
        $totaldiariovenda = trim($totaldiario);
    }

    //echo $mes;
    //echo $total21;
    //echo $total22;

    //libera os dados associados as declaraçoes do BD
    oci_free_statement($consulta);

    //fecha conexao com BD
    //oci_close($conexao);

?>