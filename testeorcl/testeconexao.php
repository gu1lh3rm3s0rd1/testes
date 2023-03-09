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

  $sql = "
  SELECT X2.MES AS MES, CAST(TO_NUMBER(X2.TOTAL) AS INTEGER) AS TOTAL_21, CAST(TO_NUMBER(NVL(Y2.TOTAL, 0)) AS INTEGER) AS TOTAL_22
  FROM
  (
  SELECT X.NUM_MES AS NUM_MES, X.MES AS MES, SUM(X.C6_VALOR) AS TOTAL
  FROM
  ( 
  SELECT C6_VALOR AS C6_VALOR, EXTRACT(YEAR FROM TO_DATE(C5_EMISSAO,'YYYYMMDD'))AS ANO, TO_CHAR(TO_DATE(C5_EMISSAO,'YYYYMMDD'),'MM') AS NUM_MES, TO_CHAR(TO_DATE(C5_EMISSAO,'YYYYMMDD'),'MON') AS MES
  FROM SC6010 
  INNER JOIN SC5010 ON C6_FILIAL = C5_FILIAL AND C6_NUM = C5_NUM AND SC5010.D_E_L_E_T_ = ' ' AND SC6010.D_E_L_E_T_ = ' '
  INNER JOIN SF4010 ON F4_CODIGO = C6_TES AND SF4010.D_E_L_E_T_ = ' '
  WHERE C5_FILIAL = '01' AND F4_DUPLIC = 'S' AND C5_TIPO = 'N' AND C6_BLQ <> 'R' AND EXTRACT(YEAR FROM TO_DATE(C5_EMISSAO,'YYYYMMDD')) = 2021
  ) X
  GROUP BY X.NUM_MES, X.MES
  ) X2
  LEFT OUTER JOIN 
  (
  SELECT Y.NUM_MES AS NUM_MES, Y.MES AS MES, SUM(Y.C6_VALOR) AS TOTAL
  FROM
  ( 
  SELECT C6_VALOR AS C6_VALOR, EXTRACT(YEAR FROM TO_DATE(C5_EMISSAO,'YYYYMMDD'))AS ANO, TO_CHAR(TO_DATE(C5_EMISSAO,'YYYYMMDD'),'MM') AS NUM_MES, TO_CHAR(TO_DATE(C5_EMISSAO,'YYYYMMDD'),'MON') AS MES
  FROM SC6010 
  INNER JOIN SC5010 ON C6_FILIAL = C5_FILIAL AND C6_NUM = C5_NUM AND SC5010.D_E_L_E_T_ = ' ' AND SC6010.D_E_L_E_T_ = ' '
  INNER JOIN SF4010 ON F4_CODIGO = C6_TES AND SF4010.D_E_L_E_T_ = ' '
  WHERE C5_FILIAL = '01' AND F4_DUPLIC = 'S' AND C5_TIPO = 'N' AND C6_BLQ <> 'R' AND EXTRACT(YEAR FROM TO_DATE(C5_EMISSAO,'YYYYMMDD')) = 2022
  ) Y
  GROUP BY Y.NUM_MES, Y.MES
  ) Y2 
  ON X2.NUM_MES = Y2.NUM_MES
  ORDER BY X2.NUM_MES";

  $stid = oci_parse($conexao, $sql);
  oci_execute($stid);

  while ($dados = oci_fetch($stid)) {
     echo oci_result($stid, 'MES') . "\n";
     echo oci_result($stid, 'TOTAL_21') . "\n";
     echo oci_result($stid, 'TOTAL_22') . "\n";
  }

  oci_free_statement($stid);
  
  $dados = array('nome' =>'Mateus');
  echo $dados['nome']; //Resultado: Mateus
  //echo $dados->nome; //Resultado: Erro
   
  $dados = (object) $dados; //É aqui que tudo funciona...
  echo $dados->nome; //Resultado: Mateus

?>