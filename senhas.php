<?php
require 'vendor/autoload.php';
require 'controllers\LoteController.php';
use Dompdf\Dompdf;

$lote = new LoteController();
$i = 0;
foreach($lote->emitirSenhas() as $senhas){
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    $dompdf = new Dompdf();
    $dompdf->loadHtml("<html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Login</title>
        <style>
          body{
            font-family: Arial;
            font-weight: bold;
          }
          .eventoName{
            color:#fff;
            margin: 0;
            position:relative;
            bottom:290px;
            left:20px;
            font-size: 32pt;
          }
          .eventoNameRot{
            color: #fff;
            position: relative;
            bottom: 260px;
            left:-170px;
            font-size: 24px;
          }
          .artistas{
            color:#f12b76;
            margin: 0;
            position:relative;
            bottom:290px;
            left:20px;
            font-size: 24pt;
          }
          .artistasRot{
            color:#f12b76;
            margin: 0;
            position:relative;
            bottom:300px;
            left:-170px;
            font-size: 16pt;
          }
          .data{
            color:#fff;
            margin: 0;
            position:relative;
            bottom:240px;
            left:20px;
            font-size: 24pt;
          }
          .dataRot{
            color:#fff;
            margin: 0;
            position:relative;
            bottom:210px;
            left:-170px;
            font-size: 16pt;
          }
          .local{
            color:#f12b76;
            margin: 0;
            position:relative;
            bottom:240px;
            left:20px;
            font-size: 24pt;
          }
          .localRot{
            color:#f12b76;
            margin: 0;
            position:relative;
            bottom:210px;
            left:-170px;
            font-size: 16pt;
          }
          .cod-barras{
            color:#fff;
            margin: 0;
            position:relative;
            bottom:225px;
            left:40px;
            font-size: 24pt;
          }
          .canhoto{
            transform: rotate(-270deg);
          }
        </style>
    </head>
    <body>
      <img src=\"assets/img/bilhete.png\" width='750px' alt='Sample image'>
      <h4 class='eventoName'>".$senhas[12]."</h4>
      <h4 class='artistas'>".$senhas[13]."</h4>
      <h4 class='data'>".date('d/m/Y', strtotime($senhas[10]))."</h4>
      <h4 class='local'>Nome</h4>
      <h4 class='cod-barras'>".$generator->getBarcode($senhas[2], $generator::TYPE_EAN_13)."</h4>
    
      <div class='canhoto'>
          <h4 class='eventoNameRot'>".$senhas[12]."</h4>
          <h4 class='artistasRot'>".$senhas[13]."</h4>
          <h4 class='dataRot'>".date('d/m/Y', strtotime($senhas[10]))."</h4>
          <h4 class='localRot'>Hello</h4>
      </div>
    </body>
    </html>");

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();
}

// Output the generated PDF to Browser
$dompdf->stream();