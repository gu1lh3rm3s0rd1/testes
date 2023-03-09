<?php include 'conexaofaturamentodiario.php' ?>
<?php include 'conexaosomaanual.php' ?>
<?php include 'conexaovendadiaria.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="60; url=index.php">
  <link rel="stylesheet" href="index.css">
  <title>Document</title>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
          [' ', 'VENDAS', 'FATURAMENTO'],

            //SELECIONA DADOS
            <?php
            include 'conexao.php';
              
                $consulta = oci_parse($conexao, "SELECT X2.MES AS MES, LPAD(TO_CHAR(X2.TOTAL, '999G999G999D99'), 7) AS TOTAL_FAT, LPAD(TO_CHAR(NVL(Y2.TOTAL, 0), '999G999G999D99'), 7) AS TOTAL_VEND
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
                ORDER BY X2.NUM_MES");

                oci_execute($consulta);         

                $mes = '';
                $total_v3nd4 = '';
                $total_f4t = '';

                while ($dados = oci_fetch_array($consulta)){
                $meses = $mes . '' . $dados['MES'] . '';
                $vend = $total_v3nd4 . '' . $dados['TOTAL_VEND'] . '';
                $fat = $total_f4t . '' . $dados['TOTAL_FAT'] . '';

            ?>

            ['<?php echo $meses ?>', <?php echo $vend ?>, <?php echo $fat ?>],

            <?php } ?>

            ]);

     var formatter = new google.visualization.NumberFormat({
              decimalSymbol: '.',
              groupingSymbol: '.',
              suffix: ' M',
              prefix: 'R$'
        });
            // Estou aplicando para as colunas 1 e 2
            formatter.format(data, 1);
            formatter.format(data, 2);       

     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation"
                        },
                       2, 
                       { calc: "stringify",
                         sourceColumn: 2,
                         type: "string",
                         role: "annotation"
                        }
                    ]);

         var options = {
                colors: ['#313B6C', '#F7D52A'],
                bar: {
                   groupWidth: "75%"
                },
                legend: {
                   position: 'top',
                   alignment: 'center',
                },
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 9.5,
                        color: 'black'
                       // auraColor: 'red'
                    }
                },
                chartArea: {
                    width: '87.5%', 
                    height: '400px'
                },
                //vAxis: {
                    //title: 'Price in Millions',
				//	textStyle : {
				//		fontSize : 14
				//	},
                series: {
                    2: {
                        targetAxisIndex:0
                    }
                },
                vAxis: {
                        ticks: [{v:4, f:'R$4 M'}, {v:8, f:'R$8 M'}, {v:12, f:'R$12 M'}, {v:16, f:'R$16 M'}, {v:20, f:'R$20 M'}],
                        textStyle: {
                        color: 'black'
                    }
                    }
            };

     var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }

    </script>
</head>
<body>
    <main>
            <div class="cards">
                <div class="cartao">
                <center> <h1>TOTAL VENDIDO DIARIO</h1> </center>
                    <center> <h2> <?php echo 'R$ ' . $totaldiariovenda ?> </h2> </center>
                </div>
                <div class="cartao">
                <center> <h1>TOTAL VENDIDO ANUAL</h1> </center>
                    <center> <h2> <?php echo 'R$ ' . $totalvenda ?> </h2> </center>
                </div>
                <div class="logo">
                <center><img src="imagem/LOGO SEM FUNDO.png" alt="logo"></center>
                </div>
                <div class="cartao">
                <center> <h1>TOTAL FATURADO DIARIO</h1> </center>
                    <center> <h2> <?php echo 'R$ ' . $totaldiariofat ?> </h2> </center>
                </div>
                <div class="cartao">
                <center> <h1>TOTAL FATURADO ANUAL</h1> </center>
                    <center> <h2> <?php echo 'R$ ' . $totalfat ?> </h2> </center>
                </div>
            </div>
                <div id="columnchart_values" style="width: 100%; min-width: 200px; max-width: 1080px; height: 400px;"></div>
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>