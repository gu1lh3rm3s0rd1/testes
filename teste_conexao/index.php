<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
      <title>ORCL</title>
      <link rel="stylesheet" href="index.css">
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
<h2> VENDAS POR ANO </h2>
<HR> </HR>
        <div class="container" style="color: white; margin-top: 25px;">
            <canvas id="myChart" width="1265px" height="400px" padding="15px"></canvas>
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
                        label: '2021',
                        data: [<?php echo $ano21; ?>],
                        backgroundColor: '#313B6C', //AZUL
                        borderColor: 'black',
                        fontFamily: 'Arial Black',
                        borderWidth: 0.5
                    },
                    {
                        //segunda coluna e suas propriedades
                        label: '2022',
                        data: [<?php echo $ano22; ?>],
                        backgroundColor: '#F7D52A', //AMARELO
                        borderColor: 'black',
                        fontFamily: 'Arial Black',
                        borderWidth: 0.5
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
                                ctx.font = '7.5px Arial Black'  //Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
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
                            fontSize: 10
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
                                fontSize: 9
                            
                            },
                            //valores do eixo, no caso do nosso grafico, vai de 0 a 20
                            ticks: {
                                //funçao para formatar as leg do grafico para milhoes 
                                callback: function(value){
                                    let finalValue = value.toFixed(2)
                                    return 'R$ ' + finalValue.replace('.',',') + ' M'
                                },
                                fontColor: 'black',
                                fontFamily: 'Arial Black',
                                fontSize: 9
                            }
                        }],
                    }
                }
            });
        </script>
  <HR> </HR>
 <meta http-equiv="refresh" content="30;url=index.php">
</body>
</html>