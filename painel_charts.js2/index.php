<?php include 'conexao.php' ?>
<?php include 'conexaofaturamentodiario.php' ?>
<?php include 'conexaosomaanual.php' ?>
<?php include 'conexaovendadiaria.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="index.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <title>Document</title>
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
        <div class="grafico">
            <canvas id="myChart" height="100%"></canvas>
        </div>
        <script type="text/javascript">
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        //caixa 'data' é responsavel por trazer nossos dados para a tela
                        data: {
                            labels: [<?php echo $meses ?>],
                            //onde trazemos os dados, se quisessemos uma terceira coluna, basta copiar um datasset, separa-lo po 'virgula' e cola-lo
                            datasets: 
                            [{
                                //primeira coluna e suas propriedades
                                label: 'VENDAS',
                                data: [<?php echo $ano22; ?>],
                                backgroundColor: '#313B6C', //AZUL
                                //borderColor: 'black',
                                fontFamily: 'Arial Black',
                                
                            },
                            {
                                //segunda coluna e suas propriedades
                                label: 'FATURAMENTO',
                                data: [<?php echo $ano21; ?>],
                                backgroundColor: '#F7D52A', //AMARELO
                                //borderColor: 'black',
                                fontFamily: 'Arial Black',
                                
                            }]
                        },
                        //configuramos as info da forma desejada, responsavel pela estilizaçao
                        options: {
                            //mostra valor sobre as colunas
                            animation: {
                                duration: 1000,
                                    onComplete: function() {
                                        var chartInstance = this.chart,
                                        ctx = chartInstance.ctx;
                                        ctx.font = '12px Arial Black'  //Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                        ctx.textAlign = 'center';
                                        ctx.textBaseline = 'bottom';
                                        ctx.fillStyle = 'black';
                                        this.data.datasets.forEach(function(dataset, i) {
                                            var meta = chartInstance.controller.getDatasetMeta(i);
                                            meta.data.forEach(function(bar, index) {
                                                var data = dataset.data[index];
                                                ctx.fillText(data + " M ", bar._model.x, bar._model.y - 1) ;
                                            });
                                        });
                                    }
                            },
                            //legendas das colunas 
                            legend: {
                                //display: true,
                                //position: 'bottom',
                                labels: {
                                    fontColor: 'black',
                                    fontFamily: 'Arial Black',
                                    fontSize: 18
                                }
                            },
                            scales: {
                                //eixo x
                                xAxes: [{
                                    //stacked: true, //empliha uma coluna sobre outra
                                    scaleLabel: {
                                        labelString: '',
                                        fontColor: 'black',
                                        fontSize: 10
                                    },
                                    //valores do eixo, no caso do nosso grafico, JAN/FEV/MAR...
                                    ticks: {
                                        fontColor: 'black',
                                        fontSize: 10,
                                        fontFamily: 'Arial Black',
                                    }
                                }],
                                //eixo y 
                                yAxes: [{
                                    //stacked: true,
                                    scaleLabel: {
                                        labelString: '',
                                        fontColor: 'black',
                                        fontSize: 10
                                    
                                    },
                                    //valores do eixo, no caso do nosso grafico, vai de 0 a 20
                                    ticks: {
                                        //funçao para formatar as legendas do grafico para milhoes 
                                        callback: function(value){
                                            let finalValue = value.toFixed(2)
                                            return 'R$ ' + finalValue.replace('.',',') + ' M'
                                        },
                                        fontColor: 'black',
                                        fontFamily: 'Arial Black',
                                        fontSize: 12
                                    }
                                }],
                            }
                        }
                    });
                </script>
            <meta http-equiv="refresh" content="60; url=index.php">
    </main>
</body>
</html>