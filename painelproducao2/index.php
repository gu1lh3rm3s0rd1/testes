<?php include 'testeestanquiedadeD.php' ?>
<?php include 'testeestanquiedadeS.php' ?>
<?php include 'testehidrostaticoD.php' ?>
<?php include 'testehidrostaticoS.php' ?>
<?php include 'testepressurizacaoD.php' ?>
<?php include 'testepressurizacaoS.php' ?>
<?php include 'vazosproduzidosD.php' ?>
<?php include 'vazosproduzidosS.php' ?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Responsive Cards</title> 
      <!--meta http-equiv="refresh" content="60; url=index.php"-->
      <!--link rel="stylesheet" href="index.css"--> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
   *{
    font-family: 'Arial Black';
  }

  body{
    padding: 4px;
    width: 100%;
    min-width: 200px;
    max-width: 800px;
    margin: auto;
  }

  .cards{
    display: flex;
    min-width: 200px;
    max-width: 800px;
    text-align: center;
    padding: 20px;
  }

  .content{
    display: flex;
    flex-wrap: wrap;
    flex: 1;
    width: 150px;
    height: 80px;
    border: 1px solid black;
    border-radius: 4px;
    margin: 25px;
    text-align: center;
  }

  .content > * {
    flex: 1 1 100%;
  }

  .content h1 {
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  .content h2 {
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  .caixaum {
      border: 1px solid blue;

   width: 35%;
  }

  .caixadois {
      border: 1px solid blue;

   width: 100%;
  }

  .caixadois h1 {
    font-size: 14px;
    text-align: center;
    position: relative;
    bottom: -5px;
  }

  .services {
      border: 1px solid blue;
      width: 185px;
      text-align: center;

  }

  .logo {
        border: 1px solid blue;
    display: flex;
    margin: 5px;
    width: auto;
    position: relative;
    bottom: -7.5px;
  }

  @media (max-width: 800px) {
    .services {
      display: flex;
      flex-direction: column;
    }
  }
      </style>
   </head>
   <body>
      <div class="cards">
         <div class="services">
            <div class="logo">
                  <div class="caixaum"><img src="imagem/LOGO PRODUCAO.png" alt=""></div>
                  <div class="caixadois"><h1><CENTER>PRODUCAO</CENTER></h1></div>
            </div>
            <div class="content content-1">
                  <h1><CENTER>vazos produzidos hoje</CENTER></h1>
                  <h2><CENter> <?php echo $totalproduzidosD; ?></CENter> </h2>
            </div>
            <div class="content content-1">
                  <h1><CENTER>PRODUZIDOS ULT. 7 dias</CENTER></h1>
                  <h2> <CENter> <?php echo $totalproduzidosS; ?> </CENter> </h2>
            </div>
         </div>
         <div class="services">
            <div class="logo">
                  <div class="caixaum"><img src="imagem/LOGO TESTE ESTANQUIEDADE.png" alt=""></div>
                  <div class="caixadois"><h1><CENTER>ESTANQUIEDADE</CENTER></h1></div>
            </div>
            <div class="content content-1">
                  <h1><CENTER>testes estanquIEdade hoje</CENTER></h1>
                  <h2><CENter> <?php echo $totaltesteED; ?></CENter> </h2>
            </div>
            <div class="content content-1">
                  <h1><CENTER>testados ULT. 7 dias</CENTER></h1>
                  <h2> <CENter> <?php echo $totaltesteES; ?> </CENter> </h2>
            </div>
         </div>
         <div class="services">
            <div class="logo">
                  <div class="caixaum"><img src="imagem/LOGO TESTE HIDROSTATICO.png" alt=""></div>
                  <div class="caixadois"><h1><CENTER>HIDROSTATICO</CENTER></h1></div>
            </div>
            <div class="content content-1">
                  <h1><CENTER>testes hidrostaticos hoje</CENTER></h1>
                  <h2><CENter> <?php echo $totaltesteHD; ?> </CENter> </h2>
            </div>
            <div class="content content-1">
                  <h1><CENTER>TESTADOS ULT. 7 dias</CENTER></h1>
                  <h2> <CENter> <?php echo $totaltesteHS; ?> </CENter> </h2>
            </div>
         </div>
         <div class="services">
            <div class="logo">
                  <div class="caixaum"><img src="imagem/LOGO TESTE PRESSURIZACAO.png" alt=""></div>
                  <div class="caixadois"><h1><CENTER>PRESSURIZACAO</CENTER></h1></div>
            </div>
            <div class="content content-1">
                  <h1><CENTER>testes PRESSURIZACAO hoje</CENTER></h1>
                  <h2><CENter> <?php echo $totaltestePD; ?></CENter> </h2>
            </div>
            <div class="content content-1">
                  <h1><CENTER>testados ULT. 7 dias</CENTER></h1>
                  <h2><CENter> <?php echo $totaltestePS; ?></CENter> </h2>
            </div>
         </div>
      </div>
   </body>
</html>