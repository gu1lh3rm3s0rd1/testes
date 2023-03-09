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
        <center> <h1> DESENVOLVIMENTO WEB COM PHP </h1> </center>
        <h2> CHIAPERINI INDUSTRIAL LTDA </h2> 
            <div>
                    Atualizar Dashboard: <input type="button" value="Atualizar" onclick="window.location.reload()">
            </div>
            <HR> </HR>
        <div class="container" style="color: white; margin-top: 20px;">
            <canvas id="myChart" width="1265px" height="400px" padding="30px"></canvas>
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
                        //primeira coluna
                        label: '2021',
                        data: [<?php echo $ano21; ?>],
                        backgroundColor: 'rgba(0, 0, 255)',
                        borderColor: 'black',
                        borderWidth: 1
                    },
                    {
                        //segunda coluna
                        label: '2022',
                        data: [<?php echo $ano22; ?>],
                        backgroundColor: 'rgba(255, 255, 0)',
                        borderColor: 'black',
                        borderWidth: 1
                    }]
                },
                //configuramos as info da forma desejada, responsavel pela estilizaçao
                options: {
                    //legendas das colunas 
                    legend: {
                        labels: {
                            fontColor: "black",
                            fontSize: 18
                        }
                    },
                    scales: {
                        //eixo x
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                labelString: '',
                                fontColor: 'black',
                                fontSize: 14
                            },
                            //valores do eixo, no caso do nosso grafico, JAN/FEV/MAR...
                            ticks: {
                                fontColor: "black",
                                fontSize: 14
                            }
                        }],
                        //eixo y 
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'MILHÃO(R$)',
                                fontColor: 'black',
                                fontSize: 16
                            },
                            //valores do eixo, no caso do nosso grafico, vai de 0 a 20M
                            ticks: {
                                fontColor: "black",
                                fontSize: 14
                            }
                        }],
                    }
                }
            });
        </script>
        <HR> </HR>
</body>
</html>