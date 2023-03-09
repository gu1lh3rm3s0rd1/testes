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
   min-width: 300px;
   max-width: 600px;
   margin: auto;
}

.cards{
   min-width: 300px;
   max-width: 600px;
   text-align: center;
   padding: 20px;
}

.services{
   display: flex;
   align-items: center;
   min-width: 300px;
   max-width: 600px;
}

.content{
   display: flex;
   flex-wrap: wrap;
   flex: 1;
   border: 1px solid black;
   border-radius: 4px;
   margin: 25px;
}

.content > *{
   flex: 1 1 100%;
}

.content h1{
   font-size: 10px;
   letter-spacing: 1px;
   text-transform: uppercase;
}

.content h2{
   font-size: 10px;
   letter-spacing: 1px;
   text-transform: uppercase;
}

@media (max-width: 600px) {
   .services{
      display: flex;
      flex-direction: column;
   }
}
      </style>
   </head>
   <body>
         <div class="cards">
            <div class="services">
                <img src="imagem/LOGO PRODUCAO.png" alt="">
                  <div class="content content-1">
                     <h1>
                        <CENTER>vazos produzidos hoje</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totalproduzidosD; ?> </CENter> </h2>
                  </div>
                  <div class="content content-1">
                     <h1>
                        <CENTER>PRODUZIDOS ULT. 7 DAIS</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totalproduzidosS; ?> </CENter> </h2>
                  </div>
               </div>
               <div class="services">  
                  <img src="imagem/LOGO TESTE ESTANQUIEDADE.png" alt="">
                  <div class="content content-2">
                     <h1>
                        <CENTER>testes estanqueidade hoje</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totaltesteED; ?> </CENter> </h2>
                  </div>
                  <div class="content content-2">
                     <h1>
                        <CENTER>TESTADOS ULT. 7 DAIS</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totaltesteES; ?> </CENter> </h2>
                  </div>
               </div>
               <div class="services">
                   <img src="imagem/LOGO TESTE HIDROSTATICO.png" alt="">
                  <div class="content content-3">
                     <h1>
                        <CENTER>testes hidrostaticos hoje</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totaltesteHD; ?> </CENter> </h2>
                  </div>
                  <div class="content content-3">
                     <h1>
                        <CENTER>TESTADOS ULT. 7 DAIS</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totaltesteHS; ?> </CENter> </h2>
                  </div>
               </div>
               <div class="services">
                   <img src="imagem/LOGO TESTE PRESSURIZACAO.png" alt="">
                  <div class="content content-4">
                     <h1>
                        <CENTER>testes pressurização hoje</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totaltestePD; ?> </CENter> </h2>
                  </div>
                  <div class="content content-4">
                     <h1>
                        <CENTER>TESTADOS ULT. 7 DAIS</CENTER>
                     </h1>
                     <h2> <CENter> <?php echo $totaltestePS; ?> </CENter> </h2>
                  </div>
            </div>
         </div> 
   </body>
</html>