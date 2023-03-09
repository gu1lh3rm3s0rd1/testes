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
    SELECT X2.MES AS MES, LPAD(TO_CHAR(X2.TOTAL, '999G999G999D99'), 7) AS TOTAL_FAT, LPAD(TO_CHAR(NVL(Y2.TOTAL, 0), '999G999G999D99'), 7) AS TOTAL_VEND
    FROM
    (
    SELECT X.ANO, X.MES, SUM(X.TOTAL) AS TOTAL, X.NUM_MES
    FROM
    (
    SELECT EXTRACT(YEAR FROM TO_DATE(F2_EMISSAO,'YYYYMMDD'))AS ANO, 
           TO_CHAR(TO_DATE(F2_EMISSAO,'YYYYMMDD'),'MM') AS NUM_MES, 
           TO_CHAR(TO_DATE(F2_EMISSAO,'YYYYMMDD'),'MON') AS MES,
           F2_VALFAT AS TOTAL
    FROM SF2010
    WHERE SF2010.D_E_L_E_T_ = ' '
    ) X
    WHERE X.ANO = EXTRACT(YEAR FROM SYSDATE)
    GROUP BY X.ANO, X.MES, X.NUM_MES
    ORDER BY X.NUM_MES
    ) X2
    INNER JOIN
    (
    SELECT Y.ANO, Y.MES, SUM(Y.TOTAL) AS TOTAL, Y.NUM_MES
    FROM
    (
    SELECT EXTRACT(YEAR FROM TO_DATE(C5_EMISSAO,'YYYYMMDD')) AS ANO, 
           TO_CHAR(TO_DATE(C5_EMISSAO,'YYYYMMDD'),'MM') AS NUM_MES, 
           TO_CHAR(TO_DATE(C5_EMISSAO,'YYYYMMDD'),'MON') AS MES,
         C6_VALOR AS TOTAL 
    FROM SC6010 
    INNER JOIN SC5010 ON C6_FILIAL = C5_FILIAL AND C6_NUM = C5_NUM AND SC5010.D_E_L_E_T_ = ' ' AND SC6010.D_E_L_E_T_ = ' '
    INNER JOIN SF4010 ON F4_CODIGO = C6_TES AND SF4010.D_E_L_E_T_ = ' '
    WHERE C5_FILIAL = '01' AND F4_DUPLIC = 'S' AND C5_TIPO = 'N' AND C6_BLQ <> 'R' AND EXTRACT(YEAR FROM TO_DATE(C5_EMISSAO,'YYYYMMDD')) = EXTRACT(YEAR FROM SYSDATE)
    ) Y
    WHERE Y.ANO = EXTRACT(YEAR FROM SYSDATE)
    GROUP BY Y.ANO, Y.MES, Y.NUM_MES
    ORDER BY Y.NUM_MES
    ) Y2 
    ON X2.NUM_MES = Y2.NUM_MES
    ORDER BY X2.NUM_MES";

    //variavel de consulta com o BD
    $consulta = oci_parse($conexao, $sql);

    //execucao da consulta
    oci_execute($consulta);

    //preparando valores
    $mes = '';
    $total21 = '';
    $total22 = '';

    //funcao de repeticao para trazer os dados desejados
    while ($dados = oci_fetch_array($consulta)) {
        $mes = $mes . '"' . $dados['MES'] . '",';
        $total21 = $total21 . '"' . $dados['TOTAL_FAT'] . '",';
        $total22 = $total22 . '"' . $dados['TOTAL_VEND'] . '",';

        //limpa espaços da variavel
        $meses = trim($mes);
        $ano21 = trim($total21);
        $ano22 = trim($total22);
    }

    //echo $mes;
    //echo $total21;
    //echo $total22;

    //libera os dados associados as declaraçoes do BD
    oci_free_statement($consulta);

    //fecha conexao com BD
    //oci_close($conexao);
           
    //$n =  43951789;
    //printf("R$%01.2f'\n", $n); // floating point representation

?>