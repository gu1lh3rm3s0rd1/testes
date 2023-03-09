<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="index.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.DataTable([
          ['', 'Sales', 'Expenses'],
          //2021
          <?php 
          include 'conexao.php';
          $sql= oci_parse ($conexao," SELECT X2.MES AS MES, X2.TOTAL AS TOTAL_21
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
          ) X2");

          oci_execute($sql);

          while ($dados = oci_fetch_array($sql)){
           $mesf = $dados ['MES'];  
              //$dados = str_replace(",",".", $total);//formatacao ex: 12345,67 para 12345.67
                if ($mesf == 1) {
                $totalf1 = str_replace(",",".",$dados ['TOTAL_21']);
                }elseif ($mesf == 2){
                $totalf2 = str_replace(",",".",$dados ['TOTAL_21']);       
                }elseif ($mesf == 3){
                $totalf3 = str_replace(",",".",$dados ['TOTAL_21']);
                }elseif ($mesf == 4){
                $totalf4 = str_replace(",",".",$dados ['TOTAL_21']);       
                }elseif ($mesf == 5){
                $totalf5 = str_replace(",",".",$dados ['TOTAL_21']);
                }elseif ($mesf == 6){
                $totalf6 = str_replace(",",".",$dados ['TOTAL_21']); 
                }elseif ($mesf == 7){
                $totalf7 = str_replace(",",".",$dados ['TOTAL_21']); 
                }elseif ($mesf == 8){
                $totalf8 = str_replace(",",".",$dados ['TOTAL_21']); 
                }elseif ($mesf == 9){
                $totalf9 = str_replace(",",".",$dados ['TOTAL_21']); 
                }elseif ($mesf == 10){
                $totalf10 = str_replace(",",".",$dados ['TOTAL_21']); 
                }elseif ($mesf == 11){
                $totalf11 = str_replace(",",".",$dados ['TOTAL_21']); 
                }elseif ($mesf == 12){
                $totalf12 = str_replace(",",".",$dados ['TOTAL_21']);       
            }
            ?>
            
          <?php } ?>

          <?php
          //2022
          include 'conexao.php';
          $sql = oci_parse ($conexao,"SELECT Y2.MES AS MES, Y2.TOTAL AS TOTAL_22
          FROM
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
          ) Y2 ");
        
          oci_execute($sql);
        
          while ($dados = oci_fetch_array($sql)){    
            $mesv = $dados ['MES'];
                if ($mesv == 1){
                $totalv1 = str_replace(",",".",$dados ['TOTAL_22']);
                }elseif ($mesv == 2){
                $totalv2 = str_replace(",",".",$dados ['TOTAL_22']);       
                }elseif ($mesv == 3){
                $totalv3 = str_replace(",",".",$dados ['TOTAL_22']);
                }elseif ($mesv == 4){
                $totalv4 = str_replace(",",".",$dados ['TOTAL_22']);       
                }elseif ($mesv == 5){
                $totalv5 = str_replace(",",".",$dados ['TOTAL_22']);
                }elseif ($mesv == 6){
                $totalv6 = str_replace(",",".",$dados ['TOTAL_22']);  
                }elseif ($mesv == 7){
                $totalv7 = str_replace(",",".",$dados ['TOTAL_22']);    
                }elseif ($mesv == 8){
                $totalv8 = str_replace(",",".",$dados ['TOTAL_22']);    
                }elseif ($mesv == 9){
                $totalv9 = str_replace(",",".",$dados ['TOTAL_22']);    
                }elseif ($mesv == 10){
                $totalv10 = str_replace(",",".",$dados['TOTAL_22']);    
                }elseif ($mesv == 11){
                $totalv11 = str_replace(",",".",$dados['TOTAL_22']);    
                }elseif ($mesv == 12){
                $totalv12= str_replace(",",".",$dados ['TOTAL_22']);            
                }
                ?>
  <?php } ?>

          ['JAN',<?php echo $totalv1?>,<?php echo $totalf1?>],
          ['FEV',<?php echo $totalv2?>,<?php echo $totalf2?>],
          ['MAR',<?php echo $totalv3?>,<?php echo $totalf3?>],
          ['ABR',<?php echo $totalv4?>,<?php echo $totalf4?>],
          ['MAI',<?php echo $totalv5?>,<?php echo $totalf5?>],
          ['JUN',<?php echo $totalv6?>,<?php echo $totalf6?>],
          ['JUL',<?php echo $totalv7?>,<?php echo $totalf7?>],
          ['AGO',<?php echo $totalv8?>,<?php echo $totalf8?>],
          ['SET',<?php echo $totalv9?>,<?php echo $totalf9?>],
          ['SET',<?php echo $totalv10?>,<?php echo $totalf10?>],
          ['SET',<?php echo $totalv11?>,<?php echo $totalf11?>],
          ['SET',<?php echo $totalv12?>,<?php echo $totalf12?>]

        ]);

        var options = {
          backgroundColor: '#ffffff',
          chartArea: {
          backgroundColor: '#ffffff',
          //fillOpacity: 0.1      
        },
          chart: {
            //title: 'Company Performance',
            //subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
  <center> <h1> DESENVOLVIMENTO WEB COM PHP </h1> </center>
        <h2> CHIAPERINI INDUSTRIAL LTDA </h2> 
            <div>Atualizar Dashboard: <input type="button" value="Atualizar" onclick="window.location.reload()"></div>
            <HR> </HR>
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
  </body>
</html>