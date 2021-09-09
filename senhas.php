<?php
require 'vendor/autoload.php';
require 'controllers\LoteController.php';
use Dompdf\Dompdf;

$lote = new LoteController();
$html = "<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Login</title>
    <style>
      body{
        font-family: Arial;
        font-weight: bold;
        margin: 0;
        position:absolute;
      }
      .eventoName{
        color:#fff;
        margin: 0;
        position:relative;
        bottom:290px;
        left:20px;
        font-size: 32pt;
        font-size: 6vw
      }
      .eventoNameRot{
        color: #fff;
        position: relative;
        bottom: 280px;
        left:-220px;
        font-size: 24px;
        font-size: 3.5vw;
      }
      .artistasRot{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:300px;
        left:-220px;
        font-size: 16pt;
        font-size: 2.0vw;
      }
      .data{
        color:#fff;
        margin: 0;
        position:relative;
        bottom:260px;
        left:20px;
        font-size: 20pt;
      }
      .dataRot{
        color:#ffffff;
        margin: 0;
        position:relative;
        bottom:250px;
        left:-220px;
        font-size: 16pt;
      }
      .local{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:250px;
        left:20px;
        font-size: 20pt;
      }
      .localRot{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:250px;
        left:-220px;
        font-size: 16pt;
      }
      .cod-barras{
        margin: 0;
        position:relative;
        bottom:240px;
        left:40px;
        font-size: 24pt;
      }
      .canhoto{
        transform: rotate(-270deg);
        margin: 0;
      }
      .titleArtista{
        margin:0;
        position:relative;
        bottom:280px;
        left: 25px;
        color:#000;
        background-color: #000;
      }
      .titleHora{
        margin:0;
        position:relative;
        bottom:265px;
        left: 25px;
        color:#000;
        background-color: #000;
      }
      .titleLocal{
        margin:0;
        position:relative;
        bottom:250px;
        left: 25px;
        color:#000;
        background-color: #000;
      }
      .artistas{
        color:#f12b76;
        margin: 0;
        position:relative;
        bottom:280px;
        left:20px;
        font-size: 16pt;
        font-size: 3vw;
      }
      .cod-bilhete{
        color: #fff;
        position:relative;
        bottom: 430px;
        left: 590px;
        font-size: 11pt;
        font-weight: bold;
      }
    </style>
</head>
<body>";
$i = 0;
foreach($lote->emitirSenhas($_SESSION['loteId']) as $senhas){
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    $i++;
    $html .= "<img src='./assets/img/bilhete.png' width='730px' alt='Sample image'>
      <h4 class='eventoName'>".$senhas[10]."</h4>
      <small class='titleArtista'>ATRAÇÕES</small>
      <pre class='artistas'>".$senhas[11]."</pre>
      <small class='titleHora'>HORÁRIO</small>
      <h4 class='data'>".date('d/m/Y', strtotime($senhas[12]))." ".$senhas[13]."</h4>
      <small class='titleLocal'>LOCAL</small>
      <h4 class='local'>".$senhas[14]."</h4>
      <h4 class='cod-barras'>".$generator->getBarcode(str_pad($senhas[2] , 12 , '0' , STR_PAD_LEFT), $generator::TYPE_EAN_13)."</h4>
    
      <div class='canhoto'>
          <h4 class='eventoNameRot'>".$senhas[10]."</h4>
          <pre class='artistasRot'>".$senhas[11]."</pre>
          <h4 class='dataRot'>".date('d/m/Y', strtotime($senhas[12]))." ".$senhas[13]."</h4>
          <h4 class='localRot'>".$senhas[14]."</h4> 
          </div>
          <h4 class='cod-bilhete'>".str_pad($senhas[2] , 12 , '0' , STR_PAD_LEFT)."</h4>";
}

$html .= "</body></html>";
unset($_SESSION['loteId']);
echo $html;
echo "<script>window.print();</script>";